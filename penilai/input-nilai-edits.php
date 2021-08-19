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

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <?php 
//include ("../koneksi.php");
//$id_nilai = $_GET['id'];
//  $id = ($_GET['id_nilai']);
//$data1 = mysqli_query($koneksi,"SELECT k.nik, k.nama, n.jabatan, n.id_nilai FROM karyawan k LEFT JOIN nilai n ON k.nik = n.nik WHERE n.id_nilai='".$id."'");

//while ($data1 = mysqli_fetch_assoc($sql)) {
//$result = $koneksi->query($sql);
//while ($row = mysqli_fetch_assoc($data));
//$row = $result->fetch_array();
//}
      

      ?>



      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Penilaian</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        
        <!-- body modal -->
        <div class="card-body">
          <form action="proses-edit-penilaian.php" method="get">
           

           <?php

       //   include '../koneksi.php';
//$id_nilai = (isset($_POST['id_nilai']))?
           $id = $_GET['id'];
//$_POST['id_nilai']: ''; 
             //  include '../koneksi.php';
      // $sql1=mysqli_query($koneksi, "SELECT *FROM nilai where id_nilai='$id_nilai'");
           $sql1=mysqli_query($koneksi, "SELECT * FROM nilai  where id_nilai =$id ");
                //$data_siswa = [];
               // while($d = mysqli_fetch_assoc($data) ){
               ///   $data_siswa[$d['id_kriteria']] = $d;
                //  $nama_siswa = $d['nama_siswa'];
           while ($row = mysqli_fetch_assoc($sql1)) {

       // }
         //  echo $id;
            ?> 
            

            <div class ="form-group">
             <label for="nik"> NIK </label>

             <input type="hidden" name="id_nilai" value="<?php echo $row['id_nilai'];?>"  />
             <input type="text" name="nik" value="<?php echo $row['nik'];?>" readonly class="form-control" />
           </div>
           <div class ="form-group">
            <label for="jabatan"> Jabatan </label>
            <select class=" form-control" id="jabatan" name="jabatan"  value="<?php echo $row['jabatan'];?>">
              <?php
                // ("konfig/koneksi.php");
              $s=mysqli_query($koneksi,"select * from karyawan order by jabatan ASC");
              while($d=mysqli_fetch_assoc($s)){
                ?>
                <option value="<?php echo $d['jabatan'] ?>"<?=$d['jabatan'] == $row['jabatan'] ? 'selected' : '';?>><?php echo $d['jabatan'] ?></option>

                <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tgl_nilai" class="form-control" value="<?php echo $row['tgl_nilai']; ?>">      
          </div>

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
       // $sql = mysqli_query($koneksi, "SELECT * FROM subkriteria s 
        //      LEFT JOIN kriteria k ON k.kode_kriteria=s.kode_kriteria
             // LEFT JOIN nilai_detail d ON d.kode_subkriteria_non = s.kode_subkriteria
         //     LEFT JOIN nilai n ON n.id_nilai = d.id_nilai
            //  ORDER BY s.kode_kriteria ASC, s.kode_subkriteria");
       // $result = $koneksi->query($sql);
      //  $no = 1;
      //  while ($data=mysqli_fetch_assoc($sql)) {
              
              $sql = mysqli_query($koneksi,"SELECT *From subkriteria s LEFT JOIN kriteria k ON k.kode_kriteria=s.kode_kriteria LEFT JOIN nilai_detail d ON d.kode_subkriteria=s.kode_subkriteria LEFT JOIN nilai n ON n.id_nilai=d.id_nilai WHERE d.id_nilai = $id GROUP BY s.kode_kriteria ASC, s.kode_subkriteria");
              $no=1;
              while ($data = mysqli_fetch_assoc($sql)) {

                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $data['nama_kriteria']; ?></td>
                  <td><?= $data['subkriteria']; ?></td>
                  <td>
                    <input type="hidden" name="kode_subkriteria[]" value="<?= $data['kode_subkriteria']; ?>"/>
                    <input type="number" class="form-control" name="nilai<?= $data['kode_subkriteria']; ?>" value="<?= $data['nilai'];?>"/>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
          <a href="nilaii.php" class="btn btn-danger"><i class="fa fa-window-close"></i>Batal</a><br>
          
          <?php 
        }
//mysql_close($host);
        ?> 

      </form>
    </div>
  </div>



  

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
