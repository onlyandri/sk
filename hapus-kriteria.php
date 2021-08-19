<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['kode_kriteria'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `kriteria` WHERE kode_kriteria = '$id'");

if ($query) {
 # credirect ke page index
 header("location:kriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>