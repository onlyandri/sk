<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['kode_kriteria'];
$nama_kriteria = $_GET['nama_kriteria'];
$presentase = $_GET['presentase'];


//query update
$query = mysqli_query($koneksi,"UPDATE kriteria SET nama_kriteria='$nama_kriteria' , presentase='$presentase' WHERE kode_kriteria='$id' ");

if ($query) {
 # credirect ke page index
 header("location:kriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>