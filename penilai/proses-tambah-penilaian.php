<?php
//include('dbconnected.php');
include('../koneksi.php');

$nik = $_GET['nik'];
$kode = $_GET['kode_subkriteria'];
$jabatan = $_GET['jabatan'];
$tgl_nilai = $_GET['tgl_nilai'];
$nilai=$_GET['nilai'];


//query tambah nilai
$query = mysqli_query($koneksi,"INSERT INTO `nilai` (`nik`, `jabatan`, `tgl_nilai`) VALUES ('$nik', '$jabatan', '$tgl_nilai')");

$id_nilai = $koneksi->insert_id;
foreach($kode as $key=>$value){
	$query = mysqli_query($koneksi,"INSERT INTO `nilai_detail` (id_nilai, `kode_subkriteria`, `nilai`) VALUES ('$id_nilai', '$value', '".$_GET[$value]."')");
}

if ($query) {
 # credirect ke page index
 header("location:nilaii.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>