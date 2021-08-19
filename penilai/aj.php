<?php 
require('../koneksi.php');

$nik = $_POST['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM karyawan where nik = $nik");

$output = '';

while($data = mysqli_fetch_assoc($query)){

	$output = array(
		'jabatan' => $data['jabatan']);
}

echo json_encode($output);


 ?>