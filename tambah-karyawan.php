<?php
//include('dbconnected.php');
include('koneksi.php');

$nik = $_GET['nik'];
$nama = $_GET['nama'];
$jabatan = $_GET['jabatan'];
$departemen = $_GET['departemen'];
$jenis_kelamin = $_GET['jenis_kelamin'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `karyawan` (`nik`, `nama`, `jabatan`, `departemen`, `jenis_kelamin`) VALUES ('$nik', '$nama', '$jabatan', '$departemen', '$jenis_kelamin')");

if ($query) {
 # credirect ke page index
 header("location:karyawan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>