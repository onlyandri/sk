<?php
require 'cek-sesi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kelola Admin</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php require 'koneksi.php'; ?>
<?php require 'sidebar.php'; ?>
      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">


<?php
$query = mysqli_query($koneksi,"select * from user");
$data = mysqli_fetch_array($query);
$level = $data['level'];
if($level == 'Admin'){
  $_SESSION['level'] = $data['level'];
	$lihat = 'none';
} else {
	$lihat = 'hidden';
};
?>
<button type="button" class="btn btn-success" style="margin:5px; visibility:<?=$lihat?>" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Admin</i></button><br>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Kelola Admin</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Level</th>
					  <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                  </tfoot>
                  <tbody>
				  <?php 
//$level = $data['level'];
//if($level == 'Admin'){
//  $_SESSION['level'] = $data['level'];
				  //$id = $_SESSION['level'];
//if ($id == Penilai ) {
$query = mysqli_query($koneksi,"SELECT * FROM user");
//} else {
//$query = mysqli_query($koneksi,"SELECT * FROM user where level = '$id'");
//}
  $no=1;
while ($data = mysqli_fetch_assoc($query)) 
{
?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?=$data['nama_user']?></td>
                      <td><?=$data['email']?></td>
                      <td><?=$data['password']?></td>
                      <td><?=$data['level']?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_user']; ?>"></a>
</td>
</tr>
<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal<?php echo $data['id_user']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Admin</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-admin.php" method="get">

<?php
$id = $data['id_user']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">



<div class="form-group">
<label>Nama</label>
<input type="text" name="nama_user" class="form-control" value="<?php echo $row['nama_user']; ?>">      
<!--  <select name="nama_user" class="form-control" value="<?php echo $row['nama_user']; ?>">
                <?php
               
               // $s=mysqli_query($koneksi,"select * from karyawan");
              //  while($d=mysqli_fetch_assoc($s)){
                ?>
                <option value="<?php echo $d['nama'] ?>"<?= $d['nama'] == $row['nama'] ? 'selected' : '';?>><?php echo $d['nama'] ?></option> -->
                <?php
               // }
                ?>
          </select>   
</div>


<div class="form-group">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">      
</div>

<div class="form-group">
<label>Password</label>
<input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>">      
</div>

<div class="form-group">
<label>Level</label>
<select name="level" class="form-control" value="<?php echo $row['level']; ?>">
                <?php
               
                $s=mysqli_query($koneksi,"select * from user group by level");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                  <option value="<?php echo $d['level'] ?>"<?= $d['level'] == $row['level'] ? 'selected' : '';?>><?php echo $d['level'] ?></option>
                <?php
                }
                ?>
          </select>
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
</div>
<?php 
}
//mysql_close($host);
?>  
       
</form>
</div>
</div>

</div>
</div>



 <!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
		    <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
		<form action="tambah-admin.php" method="get">
        <div class="modal-body">
		Nama : 
         <select required="required" class="form-control" name="nama_user">
          <?php
                // ("konfig/koneksi.php");
                $s=mysqli_query($koneksi,"select * from karyawan");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                  <option value="<?php echo $d['nama'] ?>"><?php echo $d['nama'] ?></option>
                <?php
                }
                ?>
              </select>
		Email : 
         <input type="text" class="form-control" name="email">
		Password : 
         <input type="password" class="form-control" name="password">
    Level : 
        <select name="level" class="form-control">
         <option value="-1">--Pilih Level--</option>
         <option>Admin</option>
         <option>Penilai</option> 
         </select>
    </div>
        
        <!-- footer modal -->
        <div class="modal-footer">
		<button type="submit" class="btn btn-success" >Tambah</button>
		</form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
  </div>


<?php               
} 
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php require 'footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php require 'logout-modal.php';?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
