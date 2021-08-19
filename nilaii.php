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
<?php require 'sidebar-penilai.php'; ?>
      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
<div class="container-fluid">

<a href="penilaian.php" class="btn btn-success" style="margin:5px"><i class="fa fa-plus"></i>Penilaian</a><br>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Penilaian</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Departemen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Departemen</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
          <?php 
$query = mysqli_query($koneksi,"SELECT * FROM karyawan k LEFT JOIN nilai n ON n.nik=k.nik WHERE n.nik IS NOT NULL AND k.jabatan NOT LIKE 'Kepala%'");
while ($data = mysqli_fetch_assoc($query)) 
{
?>
                    <tr>
                      <td><?=$data['nik']?></td>
                      <td><?=$data['nama']?></td>
                      <td><?=$data['jabatan']?></td>
                      <td><?=$data['departemen']?></td>
<td>
                      <a href="hapus-penilaian.php?kode_subkriteria=<?=$row['kode_subkriteria'];?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      <a href="edit-penilaian.php?kode_subkriteria=<?=$row['kode_subkriteria'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                    </td>
                     
<?php

}
?>

                </table>

        </div>
        <!-- /.container-fluid -->

         <div class="card-footer small text-muted">
            <a href ="penilaian-hasil.php" class="btn btn-success"><i class="fas fa-plus"></i>Proses Penilaian</a></div>

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
