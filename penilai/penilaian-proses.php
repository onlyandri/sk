<?php
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
$bobot_nilai_gap = 	['0' => ['selisih' => 0, 'bobot_nilai' => 5, 'keterangan' => 'Tidak ada selisih (kompetensi sesuai dengan yang dibutuhkan)'],
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
	$data_bobot_gap[$key]['rangking'] = 0;
	
}
//print_r($data_bobot_gap);

// perangkingan
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