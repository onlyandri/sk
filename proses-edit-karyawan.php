<?php
//include('dbconnected.php');
include('koneksi.php');

$id=$_GET['nik'];
$nama = $_GET['nama'];
$jabatan = $_GET['jabatan'];
$departemen = $_GET['departemen'];
$jenis_kelamin = $_GET['jenis_kelamin'];

//query update
$query = mysqli_query($koneksi,"UPDATE karyawan SET nama='$nama' , jabatan='$jabatan', departemen='$departemen', jenis_kelamin='$jenis_kelamin' WHERE nik='$id' ");

if ($query) {
 # credirect ke page index
 header("location:karyawan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>