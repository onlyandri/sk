<?php
//include('dbconnected.php');
include('koneksi.php');

$nama_user = $_GET['nama_user'];
$email = $_GET['email'];
$password = $_GET['password'];
$level = $_GET['level'];


//query update
$query = mysqli_query($koneksi,"INSERT INTO `user` (`nama_user`, `email`, `password`,`level` ) VALUES ('$nama_user', '$email', MD5('$password'), '$level')");

if ($query) {
 # credirect ke page index
 header("location:profile.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>