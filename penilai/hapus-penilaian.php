<?php
//include('dbconnected.php');
include('../koneksi.php');

$id = $_GET['id_nilai'];

//query update
$query1 = mysqli_query($koneksi,"DELETE FROM `nilai_detail` WHERE id_nilai = '$id'");
$query = mysqli_query($koneksi,"DELETE FROM `nilai` WHERE id_nilai = '$id'");

if ($query) {
 # credirect ke page index
 header("location:nilaii.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>