<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['kode_subkriteria'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `subkriteria` WHERE kode_subkriteria = '$id'");

if ($query) {
 # credirect ke page index
 header("location:subkriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>