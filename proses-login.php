<?php
 
// menghubungkan dengan koneksi
include 'koneksi.php';
$username = "";
$password = "";

// mengaktifkan session php
session_start();
if (isset($_POST["submit"])) {
 
// menangkap data yang dikirim dari form
//$email =mysqli_real_escape_string($koneksi,$_POST['email']);
//$pass =mysqli_real_escape_string($koneksi, $_POST['pass']);
	$id_user = $_POST['id_user'];
	$email = $_POST['email'];
	$password = MD5($_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
//$data = mysqli_query($koneksi,"select * from admin where email='$email' and pass='$pass'");

$query = mysqli_query($koneksi,"select * from admin where email='$email' and password='$password'");
$data = mysqli_fetch_array($query);

 
// menghitung jumlah data yang ditemukan
if ($query) {
//$cek = mysqli_num_rows($data);
	$cek = mysqli_num_rows($query);
 
if($cek > 0){
	$name = $data['email'];
			$level = $data['level'];
			if ($level == 'Admin') {
				echo "<script>alert('Selamat datang di website,$name');</script>";
				$_SESSION['id_user'] = $data['id_admin'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['nama_user'] = $data['nama_user'];
				$_SESSION['level'] = $data['level'];
				header("location: admin/index_admin.php");
			} else if ($level == 'Penilai') {
				echo "<script>alert('Selamat datang di website,$name');</script>";
				$_SESSION['id_user'] = $data['id_admin'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['nama_user'] = $data['nama_user'];
				$_SESSION['level'] = $data['level'];
				header("location: index.php");
			}
		} else {
			//header("location: index.php");
			header("location:login.php?pesan=gagal");
		
		}
	}


}





///$sesi = mysqli_query($koneksi,"select * from admin where email='$email' and pass='$pass'");
//$sesi = mysqli_fetch_assoc($sesi);
//	$_SESSION['id'] = $sesi['id_admin'];
//	$_SESSION['nama'] = $sesi['nama'];
//	$_SESSION['status'] = "login";
	//header("location:index.php");
//}else{
//	header("location:login.php?pesan=gagal");
//}
?>