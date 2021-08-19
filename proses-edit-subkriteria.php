<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['kode_subkriteria'];
$kode_kriteria = $_GET['kode_kriteria'];
$subkriteria = $_GET['subkriteria'];
$bobot = $_GET['bobot'];
$factor = $_GET['factor'];


//query update
$query = mysqli_query($koneksi,"UPDATE subkriteria SET kode_kriteria='$kode_kriteria' , subkriteria='$subkriteria' , bobot='$bobot' , factor='$factor' WHERE kode_subkriteria='$id' ");

if ($query) {
 # credirect ke page index
 header("location:subkriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>