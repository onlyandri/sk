<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_user'];
$nama_user = $_GET['nama_user'];
$email = $_GET['email'];
$level = $_GET['level'];
$password = $_GET['password'];

//query update
$query = mysqli_query($koneksi,"UPDATE user SET nama_user='$nama_user' , email='$email', password=MD5('$password') WHERE id_user='$id' ");

if ($query) {
 # credirect ke page index
 header("location:profile.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($Koneksi);
}

//mysql_close($host);
?>