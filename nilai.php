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

      <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Penilaian</i></button><br>


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
                  <th>Periode</th>
                  <th>Kriteria</th>
                  <th>Sub Kriteria</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Departemen</th>
                  <th>Periode</th>
                  <th>Kriteria</th>
                  <th>Sub Kriteria</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php 
                $query = mysqli_query($koneksi,"SELECT * FROM nilai");
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  ?>
                  <tr>
                    <td><?=$data['nik']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['jabatan']?></td>
                    <td><?=$data['departemen']?></td>
                    <td><?=$data['periode']?></td>
                    <td><?=$data['kriteria']?></td>
                    <td><?=$data['subkriteria']?></td>
                    <td>
                      <!-- Button untuk modal -->
                      <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_nilai']; ?>"></a>
                    </td>
                  </tr>

                  <!-- Modal -->
                  <div id="myModalTambah" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- konten modal-->
                      <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Penilaian</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- body modal -->
                        <form action="tambah-subkriteria.php" method="get">
                          <div class="modal-body">
                            NIK : 
                            <select>
                              <?php
                              include ("konfig/koneksi.php");
                              $s=mysqli_query($koneksi,"select * from karyawan");
                              while($d=mysqli_fetch_assoc($s)){
                                ?>
                                <option value="<?php echo $d['nik'] ?>"><?php echo $d['nik'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                            Nama : 
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Karyawan">
                            Jabatan :
                            <select name="id_karyawan" class="form-control">
                              <?php
                              include ("konfig/koneksi.php");
                              $s=mysqli_query($koneksi,"select * from karyawan");
                              while($d=mysqli_fetch_assoc($s)){
                                ?>
                                <option value="<?php echo $d['id_karyawan'] ?>"><?php echo $d['id_karyawan']." | ".$d['jabatan'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                            Departemen :
                            <select name="id_karyawan" class="form-control">
                              <?php
                              include ("konfig/koneksi.php");
                              $s=mysqli_query($koneksi,"select * from karyawan");
                              while($d=mysqli_fetch_assoc($s)){
                                ?>
                                <option value="<?php echo $d['id_karyawan'] ?>"><?php echo $d['id_karyawan']." | ".$d['departemen'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                            periode : 
                            <input type="date" class="form-control" name="periode" placeholder="Masukkan Periode">
                            Kriteria :
                            
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
                      echo $_POST['penilaian'];
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
