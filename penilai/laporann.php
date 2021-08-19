<?php
require '../cek-sesi.php';
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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php require '../koneksi.php'; ?>
<?php require 'sidebar.php'; ?>
      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>


<?php
require('penilaian-proses.php');
?>
        <!-- Begin Page Content -->
<div class="container-fluid">


  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

        <div class="form-group">
            <label>Tanggal Awal</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input id="tgl_mulai" type="date" placeholder="masukkan tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal"  value="<?php if (isset($_POST['tgl_awal'])) echo $_POST['tgl_awal'];?>" >
            </div>
        </div>
        <div class="form-group">
            <label>Tanggal Akhir</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input id="tgl_akhir" type="date" placeholder="masukkan tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir" value="<?php if (isset($_POST['tgl_akhir'])) echo $_POST['tgl_akhir'];?>">
            </div>
        </div>

        <script type="text/javascript">
            $(function(){
                $(".datepicker").datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: false,
                });
                $("#tgl_mulai").on('changeDate', function(selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $("#tgl_akhir").datepicker('setStartDate', startDate);
                    if($("#tgl_mulai").val() > $("#tgl_akhir").val()){
                        $("#tgl_akhir").val($("#tgl_mulai").val());
                    }
                });
            });
        </script>
    <div class="form-group">
        <input type="submit" class="btn btn-info" value="Cari">
        <a href="laporann.php" class="btn btn-danger" style="margin:5px"><i class="fa fa-print"></i>Cetak</a><br>

    </div>

    </form>



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
                      <th>Nama Karyawan</th>
                      <th>Jabatan</th>
                      <th>Tanggal</th>
                            <?php
              foreach($data_kriteria as $key => $value){
              ?>  
              <th><?= $value['nama_kriteria'];?></th>
              <?php
              }
              ?>
              <th>Nilai Akhir</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>NIK       </th>
              <th>Nama Karyawan  </th>
              <th>Jabatan    </th>
              <th>Tanggal    </th>
              <?php
              foreach($data_kriteria as $key => $value){
              ?>  
              <th><?= $value['nama_kriteria'];?></th>
              <?php
              }
              ?>
              <th>Nilai Akhir</th>
            </tr>
           
          </tfoot>
          <tbody>
          <?php



           foreach($data_bobot_gap as $key => $row) {
 
        if (isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])) {

            $tgl_awal=date('Y-m-d', strtotime($_POST["tgl_awal"]));
            $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));


            $sql="select * from nilai where tgl_nilai between '".$tgl_awal."' and '".$tgl_akhir."' order by nik asc";

      }else {
         $sql="select * from nilai order by nik asc";
      }

   

     // $hasil=mysqli_query($koneksi,$sql);
    //  $no=0;
    //   while ($data = mysqli_fetch_array($hasil)) {
    //      $no++;

           

//}
      
            ?>


         
    

            <tr>
              <td><?= $row['nik'];?></td>
              <td><?= $row['nama'];?></td>
              <td><?= $row['jabatan'];?></td>
              <td><?= $row['tgl_nilai'];?></td>
              <?php
              foreach($data_kriteria as $k => $value){
              ?>  
              <td><?= $row[$value['kode_kriteria']]['NILAI_P'];?></td>
              <?php
              }
              ?>
              <td><?= $row['NILAI_AKHIR'];?></td>
            </tr>
          <?php
          }
          ?>
          </tbody>
        </table>

         </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
     



    


<?php require '../footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php require '../logout-modal.php';?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>

                      