<?php
//include('dbconnected.php');
include('koneksi.php');

$kode_kriteria = $_GET['kode_kriteria'];
$nama_kriteria = $_GET['nama_kriteria'];
$presentase = $_GET['presentase'];


//query update

$query = mysqli_query($koneksi,"INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `presentase`) VALUES ('$kode_kriteria', '$nama_kriteria', '$presentase')");

if ($query) {
 # credirect ke page index
 header("location:kriteria.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>