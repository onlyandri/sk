<?php
//include('dbconnected.php');
include('koneksi.php');

$nik = $_GET['nik'];
$kode = $_GET['kode_subkriteria'];
$jabatan = $_GET['jabatan'];
$departemen = $_GET['departemen'];
$nilai=$_GET['nilai'];


//query tambah nilai
$query = mysqli_query($koneksi,"INSERT INTO `nilai` (`nik`, `jabatan`, `departemen`) VALUES ('$nik', '$jabatan', '$departemen')");

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