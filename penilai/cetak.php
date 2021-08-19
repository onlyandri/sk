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
<body>


  <?php require '../koneksi.php'; ?>
  <!-- Main Content -->
  <div id="content">
    <?php
    require('penilaian-proses.php');
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center" style="margin:50px; ">
          <h4>karyawan terbaik</h4>
          <h3 class="text-center">PT gajah duduk international</h3>
        </div>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="datatables" width="100%" cellspacing="0">
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
                  <th>Rangking</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $juara ='' ;
                $juara_nik = '';
                $juara_jabatan ='' ;
                $juaran_nilai ='' ;

                foreach($data_bobot_gap as $key => $row) {

                  if ($row['rangking'] == 1) {
                  # code...
                    $juara = $row['nama'];
                    $juara_nik = $row['nik'];
                    $juara_jabatan = $row['jabatan'];
                    $juaran_nilai = $row['NILAI_AKHIR'];
                  }
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
                    <td><?= $row['rangking'];?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>

            </table>
          </div>
          <!-- /.container-fluid -->

          <div class="row mt-5">
            <div class="col-md-12">
             <h5> jadi untuk karyawan terbaik jatuh kepada saudara <?php echo $juara ?> dengan nik <?php echo $juara_nik ?> dengan perolehan nilai <?php echo $juaran_nilai ?></h5>
           </div>
         </div>

       </div>
       <!-- End of Main Content -->

     </div>
     <!-- End of Content Wrapper -->

     <div class="row mt-5">
      <div class="col-md-8">

      </div>
      <div class="col-md-4 text-left" style="text-align: right;">
        <P>Pekalongan, <?=date('d M Y')?></P>
        <p></p>
        &nbsp;
        <p class="mt-5"><?=$_SESSION['nama'] ?></p>


      </div>
    </div>

  </div>
</div>


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

<script type="text/javascript">
  $(document).ready(function(){
   window.print();
 })
  window.onafterprint = function(){window.history.back()}
</script>

</body>

</html>