<?php
//include('dbconnected.php');
include('../koneksi.php');

$nik = $_GET['nik'];
$id_nilai = $_GET['id_nilai'];
$kode = $_GET['kode_subkriteria'];
$jabatan = $_GET['jabatan'];
$tgl_nilai = $_GET['tgl_nilai'];
//$nilai=$_GET['nilai'];


//query tambah nilai
// $query = mysqli_query($koneksi,"UPDATE nilai SET nik='$nik', jabatan=$jabatan, tgl_nilai='$tgl_nilai'");

//$id_nilai = $koneksi->update_id;
foreach($kode as $key=>$value){
	//$query = mysqli_query($koneksi,"UPDATE `nilai_detail` (id_nilai, `kode_subkriteria`, `nilai`) VALUES ('$id_nilai', '$value', '".$_GET[$value]."')");
	$query = mysqli_query($koneksi, "UPDATE nilai_detail SET nilai='".$_GET['nilai'.$value]."' WHERE id_nilai='$id_nilai' AND kode_subkriteria='$value'");

	//id_nilai, `kode_subkriteria`, `nilai`) VALUES ('$id_nilai', '$value', '".$_GET[$value]."')");

//($koneksi,"UPDATE subkriteria SET kode_kriteria='$kode_kriteria' , subkriteria='$subkriteria' , bobot='$bobot' , factor='$factor' WHERE kode_subkriteria='$id' ");


}

//UPDATE nilai_detail SET nilai=? WHERE id_nilai=? AND kode_subkriteria=?");

if ($query) {
 # credirect ke page index
 header("location:nilaii.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>