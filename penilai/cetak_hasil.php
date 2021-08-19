<?php 
include '../koneksi.php';
//ob_start();
session_start();

// jadikan matrik
require('../koneksi.php');
$sql = "SELECT * FROM subkriteria";
$result = $koneksi->query($sql);
$query = "";
while ($row=$result->fetch_assoc()) {
  $query .= "MAX(CASE WHEN d.kode_subkriteria='".$row['kode_subkriteria']."' THEN d.nilai END) '".$row['kode_subkriteria']."',";
}

$sql = "SELECT * FROM kriteria";
$result = $koneksi->query($sql);
$data_kriteria =$result->fetch_all(MYSQLI_ASSOC);
foreach($data_kriteria as $key => $value){
  $sql = "SELECT * FROM subkriteria WHERE factor='Core' AND kode_kriteria='".$value['kode_kriteria']."'";
  $result = $koneksi->query($sql);
  $data_core_factor = $result->fetch_all(MYSQLI_ASSOC);

  $sql = "SELECT * FROM subkriteria WHERE factor='Secondary' AND kode_kriteria='".$value['kode_kriteria']."'";
  $result = $koneksi->query($sql);
  $data_secondary_factor = $result->fetch_all(MYSQLI_ASSOC);
  
  $data_kriteria[$key]['CF'] = $data_core_factor;
  $data_kriteria[$key]['SF'] = $data_secondary_factor;
}
//print_r($data_kriteria);

$query = substr($query, 0, -1);
$sql = "SELECT k.nik, k.nama, ps.jabatan, ps.tgl_nilai, DATE_FORMAT (ps.tgl_nilai, '%d-%m-%Y') AS tgl_nilai, " . $query .
" FROM nilai_detail d 
LEFT JOIN nilai ps ON d.id_nilai = ps.id_nilai 
LEFT JOIN subkriteria sk ON sk.kode_subkriteria=d.kode_subkriteria 
LEFT JOIN karyawan k ON k.nik = ps.nik
GROUP BY k.nik, ps.jabatan";

$result = $koneksi->query($sql);
$data_penilaian =$result->fetch_all(MYSQLI_ASSOC);
//print_r($data_penilaian);

// ambil bobot tiap kriteria
$sql = "SELECT * FROM subkriteria";
$result = $koneksi->query($sql);
$data_bobot = [];
while($row = $result->fetch_assoc()){
  $data_bobot[$row['kode_subkriteria']] = $row['bobot'];
}
//print_r($data_bobot);

// hitung GAP tiap aspek/kategori (dalam bentuk matrik)
$data_gap = [];
foreach($data_penilaian as $key => $value){
  $data_gap[$key] = $value;
  foreach($data_bobot as $k => $v){
    $data_gap[$key][$k] = $value[$k] - $v;
  }
}
//print_r($data_gap);

// matrikulasi ke nilai bobot GAP
$bobot_nilai_gap =  ['0' => ['selisih' => 0, 'bobot_nilai' => 5, 'keterangan' => 'Tidak ada selisih (kompetensi sesuai dengan yang dibutuhkan)'],
'1' => ['selisih' => 1, 'bobot_nilai' => 4.5, 'keterangan' => 'Kompetensi individu kelebihan 1 tingkat'],
'-1' => ['selisih' => -1, 'bobot_nilai' => 4, 'keterangan' => 'Kompetensi individu kekurangan 1 tingkat)'],
'2' => ['selisih' => 2, 'bobot_nilai' => 3.5, 'keterangan' => 'Kompetensi individu kelebihan 2 tingkat'],
'-2' => ['selisih' => -2, 'bobot_nilai' => 3, 'keterangan' => 'Kompetensi individu kekurangan 2 tingkat'],
'3' => ['selisih' => 3, 'bobot_nilai' => 2.5, 'keterangan' => 'Kompetensi individu kelebihan 3 tingkat'],
'-3' => ['selisih' => -3, 'bobot_nilai' => 2, 'keterangan' => 'Kompetensi individu kekurangan 3 tingkat'],
'4' => ['selisih' => 4, 'bobot_nilai' => 1.5, 'keterangan' => 'Kompetensi individu kelebihan 4 tingkat'],
'-4' => ['selisih' => -4, 'bobot_nilai' => 1, 'keterangan' => 'Kompetensi individu kekurangan 4 tingkat']];

//print_r($data_bobot);         
$data_bobot_gap = [];
foreach($data_gap as $key => $value){
  $data_bobot_gap[$key] = $value;
  foreach($data_bobot as $k => $v){
    $data_bobot_gap[$key][$k] = $bobot_nilai_gap[$value[$k]]['bobot_nilai'];
  }
}
//print_r($data_gap);

// hitung core factor dan secondary factor tiap kategori
foreach($data_bobot_gap as $key => $value){
  // hitung CF
  $nilai_ranking = 0;
  foreach($data_kriteria as $k1 => $v1){
    $jml_cf = count($v1['CF']);
    $nilai_cf = 0;
    $total_cf = 0;
    foreach($v1['CF'] as $k2 => $v2){
      $total_cf += $value[$v2['kode_subkriteria']];
    }
    
    $jml_sf = count($v1['SF']);
    $nilai_sf = 0;
    $total_sf = 0;
    foreach($v1['SF'] as $k2 => $v2){
      $total_sf += $value[$v2['kode_subkriteria']];
    }
    $data_bobot_gap[$key][$v1['kode_kriteria']] = [
      'CF' => $total_cf / $jml_cf, 
      'SF' => $total_sf / $jml_sf,
      'NILAI' => (($total_cf / $jml_cf) * 0.6) + (($total_sf / $jml_sf) * 0.4),
      'NILAI_P' => ((($total_cf / $jml_cf) * 0.6) + (($total_sf / $jml_sf) * 0.4)) * $v1['presentase'] / 100,
    ];
    $nilai_ranking += ((($total_cf / $jml_cf) * 0.6) + (($total_sf / $jml_sf) * 0.4)) * $v1['presentase'] / 100;
  }
  $data_bobot_gap[$key]['NILAI_AKHIR'] = $nilai_ranking;
  
}
//print_r($data_bobot_gap);

$index = 0;
for($i=1;$i <= count($data_bobot_gap);$i++){
  $max = 0;
  foreach ($data_bobot_gap as $key => $value) {
    # code...
    if($max < $value['NILAI_AKHIR'] & $value['rangking'] == '0'){
      $max = $value['NILAI_AKHIR'];
      $index = $key;
    }
  }
  $data_bobot_gap[$index]['rangking'] = $i;
}

?>

<!-- DataTables Example -->

<h3 style="text-align: center;">Evaluasi Kinerja Karyawan</h3>
<h2 style="text-align: center;">PT PISMATEX</h2>


<i class="fas fa-table"></i>
Laporan Evaluasi Karyawan</div>
&nbsp;

<table width="100%" cellspacing="0" style="border-collapse: collapse; border: 1px solid black;">
  <thead>
    <tr>
      <th style="border: 1px solid black;">NIK</th>
      <th style="border: 1px solid black;">Nama Karyawan</th>
      <th style="border: 1px solid black;">Jabatan</th>
      <th style="border: 1px solid black;">Tanggal</th>
      <th style="border: 1px solid black;">Nilai Akhir</th>
      <th style="border: 1px solid black;">Rangking</th>
    </tr>
  </thead>


  <tbody>
    <?php
    $juara ='' ;
    $juara_nik = '';
    $juara_jabatan ='' ;
    $juaran_nilai ='' ;
    foreach($data_bobot_gap as $d){
     if ($d['rangking'] === 1) {
      $juara = $d['nama'];
      $juara_nik = $d['nik'];
      $juara_jabatan = $d['jabatan'];
      $juaran_nilai = $d['NILAI_AKHIR'];
    }
    ?>
    <tr>
      <td style="border: 1px solid black;"><?php echo $d['nik']; ?></td>
      <td style="border: 1px solid black;"><?php echo $d['nama']; ?></td>
      <td style="border: 1px solid black;"><?php echo $d['jabatan']; ?></td>
      <td style="border: 1px solid black;"><?php echo $d['tgl_nilai']; ?></td>
      <td style="border: 1px solid black;"><?php echo $d['NILAI_AKHIR']; ?></td>
      <td style="border: 1px solid black;"><?php echo $d['rangking']; ?></td>
    </tr>
    <?php  
  } 
  ?>


</tbody>
</table>
&nbsp;

<div class="row mt-5">
  <div class="col-md-12">
   <h5> jadi untuk karyawan terbaik jatuh kepada saudara <?php echo $juara ?> dengan nik <?php echo $juara_nik ?> dengan perolehan nilai <?php echo $juaran_nilai ?></h5>
 </div>
</div>

</br>
<div class="col-md-4 text-left" style="text-align: right;">
  <P>Pekalongan, <?=date('d M Y')?></P>
  <p></p>
  &nbsp;
  <p class="mt-5"><?=$_SESSION['nama'] ?></p>
  

</div>
</div>
</div>



<?php
$cetak = ob_get_clean();

require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($cetak);
$mpdf->Output();
?>