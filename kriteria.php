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

  <title>SPK Evaluasi Kinerja</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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

          <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus">Kriteria</i></button><br>



          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Kriteria</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kriteria</th>
                      <th>Kriteria</th>
                      <th>Presentase</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Kode Kriteria</th>
                      <th>Kriteria</th>
                      <th>Presentase</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
				  <?php 
$query = mysqli_query($koneksi,"SELECT * FROM kriteria order by kode_kriteria ASC");
while ($data = mysqli_fetch_array($query)) 
{
?>
                    <tr>
                      <td><?=$data['kode_kriteria']?></td>
                      <td><?=$data['nama_kriteria']?></td>
                      <td><?=$data['presentase']?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['kode_kriteria']; ?>"></a>
</td>
</tr>
<!-- Modal Edit Kriteria-->
<div class="modal fade" id="myModal<?php echo $data['kode_kriteria']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Kriteria</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-kriteria.php" method="get">

<?php
$id = $data['kode_kriteria']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE kode_kriteria='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>



<div class="form-group">
<label>Kode Kriteria</label>
<input readonly="" name="kode_kriteria" class="form-control" value="<?php echo $row['kode_kriteria']; ?>">      
</div>

<div class="form-group">
<label>Kriteria</label>
<input type="text" name="nama_kriteria" class="form-control" required="required" value="<?php echo $row['nama_kriteria']; ?>">      
</div>

<div class="form-group">
<label>Bobot</label>
<input type="text" name="presentase" class="form-control" value="<?php echo $row['presentase']; ?>">      
</div>


<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<a href="hapus-kriteria.php?kode_kriteria=<?=$row['kode_kriteria'];?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
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

<?php
$query_tambah ="SELECT max(kode_kriteria) as idMaks FROM kriteria";
$hasil = mysqli_query($koneksi,$query_tambah);
$data = mysqli_fetch_array($hasil);
$nim = $data['idMaks'];

$noUrut = (int) substr($nim, 2, 3);
$noUrut++;

$char = "K";

$IDbaru = $char . sprintf("%03s", $noUrut);
?>

<!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kriteria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <form action="tambah-kriteria.php" method="get">
        <div class="modal-body">
    Kode Kriteria : 
         <input type="text" class="form-control" name="kode_kriteria" value="<?php echo $IDbaru;?>" readonly> 
    Kriteria : 
         <input type="text" class="form-control" required="required" name="nama_kriteria" placeholder="Masukkan Kriteria">
    Presentase : 
         <input type="text" class="form-control" name="presentase" placeholder="Masukkan presentase">

        </div>
        <!-- footer modal -->
        <div class="modal-footer">
    <button type="submit" name="simpan" class="btn btn-success" >Tambah</button>
    </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
  </div>


<?php  
if (isset($_POST['simpan'])){
  echo "<br>Data yang dipilih:<br>";
  echo $_POST['kriteria'];
}             
?>

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
