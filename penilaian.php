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
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Penilaian</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <div class="card-body">
    <form action="tambah-penilaian.php" method="get">
            NIK :
          </select>
              <select name="nik" class="form-control" required="required">
                <?php
                //include ("konfig/koneksi.php");
                $s=mysqli_query($koneksi,"select * from karyawan");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                 <option value="<?php echo $d['nik'] ?>"><?php echo $d['nik']." | ".$d['nama'] ?></option>
                <?php
                }
                ?>
              </select>
             
            Jabatan :
              <select name="jabatan" class="form-control" required="required">
                <?php
                // ("konfig/koneksi.php");
                $s=mysqli_query($koneksi,"select * from karyawan order by jabatan ASC");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                  <option value="<?php echo $d['jabatan'] ?>"><?php echo $d['jabatan'] ?></option>
                <?php
                }
                ?>
              </select>

              Departemen :
              <select name="departemen" class="form-control" required="required">
                <?php
                //include ("konfig/koneksi.php");
                $s=mysqli_query($koneksi,"select * from karyawan group by departemen ASC");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                  <option value="<?php echo $d['departemen'] ?>"><?php echo $d['departemen'] ?></option>
                <?php
                }
                ?>
              </select>
                <br>
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kriteria</th>
                  <th>Sub Kriteria</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody>
                <?php
               // $sql = "SELECT *From subkriteria s LEFT JOIN kriteria k ON k.kode_kriteria=s.kode_kriteria ORDER BY s.kode_kriteria ASC, s.kode_kriteria";
              //  $result = $koneksi->query($sql);
              //  $no=1;
             //   while ($data=$result->fetch_assoc()){
                 

                  $sql = mysqli_query($koneksi,"SELECT *From subkriteria s LEFT JOIN kriteria k ON k.kode_kriteria=s.kode_kriteria ORDER BY s.kode_kriteria ASC, s.kode_subkriteria");
                  $no=1;
                  while ($data = mysqli_fetch_assoc($sql)) {
                   ?>

                  <tr>
                    <td><?=$no++; ?></td>
                    <td><?=$data['nama_kriteria']; ?></td>
                    <td><?=$data['subkriteria']; ?></td>
                    <td>
                      <input type="hidden" name="kode_subkriteria[]" value="<?=$data['kode_subkriteria']; ?>"/>
                      <input type="number" required="required" placeholder="Masukkan Nilai 1-5" class="form-control" name="<?=$data['kode_subkriteria']; ?>"/>
                    </td>
                  </tr>

                  <?php
                }
                ?>

              </tbody>
            </table>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>Simpan</button>

          </form>
 </div>
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
