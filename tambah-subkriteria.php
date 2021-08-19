<?php
//include('dbconnected.php');
include('koneksi.php');

$kode_subkriteria = $_GET['kode_subkriteria'];
$kode_kriteria = $_GET['kode_kriteria'];
$subkriteria = $_GET['subkriteria'];
$bobot = $_GET['bobot'];
$factor = $_GET['factor'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `subkriteria` (`kode_subkriteria`, `kode_kriteria`, `subkriteria`, `bobot`, `factor`) VALUES ('$kode_subkriteria', '$kode_kriteria', '$subkriteria', '$bobot', '$factor')");

if ($query) {
 # credirect ke page index
 header("location:subkriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>