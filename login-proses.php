<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';

//$id=$_POST['id_user'];
$email=$_POST['email'];
$password=$_POST['password'];



// menangkap data yang dikirim dari form
//$email =mysqli_real_escape_string($koneksi,$_POST['email']);
//$password =mysqli_real_escape_string($koneksi, $_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$query = mysqli_query($koneksi,"select * from user where email='$email' and password=MD5('$password')");
$data = mysqli_fetch_array($query);
	
 
// menghitung jumlah data yang ditemukan
//$cek = mysqli_num_rows($query);

if ($query) { 
	$cek = mysqli_num_rows($query);
if($cek > 0){
	$user=$data['nama_user'];
	$level = $data['level'];
	if($level == 'Admin'){
		echo "<script>alert('Selamat datang di website,$name');</script>";
		$_SESSION['id_user'] = $data['id_admin'];
		$_SESSION['nama'] = $data['nama_user'];
		$_SESSION['nama_user'] = $sesi['nama_user'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['status'] = "login";
		header("location: index.php");
	} else if ($level == 'Penilai') {
				echo "<script>alert('Selamat datang di website,$name');</script>";
			$_SESSION['id_user'] = $data['id_admin'];
			$_SESSION['nama'] = $data['nama_user'];
			$_SESSION['nama_user'] = $sesi['nama_user'];
			$_SESSION['level'] = $data['level'];
			$_SESSION['status'] = "login";
			header("location: penilai/index-penilai.php");
		}
		} else {
			header("location: index.php");
		}
	}





	
//$sesi = mysqli_query($koneksi,"select * from admin where email='$email' and password=MD5('$password')";
//$sesi = mysqli_fetch_assoc($sesi);
//if
//	$_SESSION['id'] = $sesi['id_admin'];
//	$_SESSION['nama'] = $sesi['nama'];
///	$_SESSION['status'] = "login";
	//header("location:index.php");
//}else{
//	header("location:login.php?pesan=gagal");
//}
?>