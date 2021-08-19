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


          <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Sub Kriteria</i></button><br>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Sub Kriteria</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Sub Kriteria</th>
                      <th>Kriteria</th>
                      <th>Sub Kriteria</th>
                      <th>Bobot</th>
                      <th>Factor</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Kode Sub Kriteria</th>
                      <th>Kriteria</th>
                      <th>Sub Kriteria</th>
                      <th>Factor</th>
                      <th>Bobot</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
				  <?php 
$query = mysqli_query($koneksi,"SELECT * FROM subkriteria");
//$query=mysqli_query($koneksi,"select s.id_subkriteria,k.id_kriteria, s.kode_subkriteria, s.subkriteria,s.bobot,s.factor,k.kode_kriteria,k.nama_kriteria from subkriteria s inner join kriteria k on s.id_kriteria=k.id_kriteria order by k.id_kriteria, s.kode_subkriteria asc") or die(mysqli_error($koneksi));
while ($data = mysqli_fetch_assoc($query)) 
{
?>
                    <tr>
                      <td><?=$data['kode_subkriteria']?></td>
                      <td><?=$data['id_kriteria']?></td>
                      <td><?=$data['subkriteria']?></td>
                      <td><?=$data['bobot']?></td>
                      <td><?=$data['factor']?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_subkriteria']; ?>"></a>
</td>
</tr>
<!-- Modal Edit Kriteria-->
<div class="modal fade" id="myModal<?php echo $data['id_subkriteria']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Sub Kriteria</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-subkriteria.php" method="get">

<?php
$id = $data['id_subkriteria']; 

//$query_edit=mysqli_query($koneksi,"select s.id_subkriteria,k.id_kriteria, s.kode_subkriteria, s.subkriteria,s.bobot,s.factor,k.kode_kriteria,k.nama_kriteria from subkriteria s inner join kriteria k on s.id_kriteria=k.id_kriteria order by k.id_kriteria, s.kode_subkriteria asc") or die(mysqli_error($koneksi));
$query_edit = mysqli_query($koneksi,"SELECT * FROM subkriteria WHERE id_subkriteria='$id'");

//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_subkriteria" value="<?php echo $row['id_subkriteria']; ?>">

<div class="form-group">
<label>Kriteria</label>
<select name="id_kriteria" class="form-control" value="<?php echo $row['nama_kriteria']; ?>">
          <?php 
          $sql="select * from kriteria order by id_kriteria asc";
          $query=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
          while($fetch=mysqli_fetch_object($query)){
            echo "<option value='".$fetch->id."'>".$fetch->kode_kriteria." - ".$fetch->nama_kriteria."</option>";
          }
          ?>
          </select>      
</div>

<div class="form-group">
<label>Kode Sub Kriteria</label>
<input type="text" readonly name="kode_subkriteria" class="form-control" value="<?php echo $row['kode_subkriteria']; ?>">      
</div>

<div class="form-group">
<label>Sub Kriteria</label>
<input type="text" name="subkriteria" class="form-control" value="<?php echo $row['subkriteria']; ?>">      
</div>

<div class="form-group">
<label>Bobot</label>
<input type="text" name="bobot" class="form-control" value="<?php echo $row['bobot']; ?>">      
</div>

<div class="form-group">
<label>factor</label>
<select name="factor" class="form-control" value="<?php echo $row['factor']; ?>">
<option value="factor">Core Factor</option>
<option value="factor">Secondary Factor</option> 
</select>
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<a href="hapus-subkriteria.php?id_subkriteria=<?=$row['id_subkriteria'];?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
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
/*$query_tambah = mysqli_query($koneksi,"SELECT max(kode_subkriteria) as kodeTerbesar From subkriteria");
$data=mysqli_fetch_array($query);
$kodeProgram=$data[kodeTerbesar];

$urutan=(int) sybstr($kodeProgram, 1, 3);
$urutan++;
$huruf="S";
$kodeProgram=$huruf.sprintf("%02s",$urutan);*/

?>

 <!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Sub Kriteria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <form action="tambah-subkriteria.php" method="get">
        <div class="modal-body">
    Kriteria : 
         <select name="id_kritria" class="form-control">
          <option value="-1">Pilih Kriteria</option>
          <?php 
          $sql="select * from kriteria order by id_kriteria asc";
          $query=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
          while($fetch=mysqli_fetch_object($query)){
          echo "<option value='".$fetch->id."'>".$fetch->kode_kriteria." - ".$fetch->nama_kriteria."</option>";
        }
        ?>
        </select>
    Kode Sub Kriteria : 
         <input type="text" class="form-control" name="kode_subkriteria" placeholder="S001">
    Sub Kriteria : 
         <input type="text" class="form-control" name="subkriteria" placeholder="Masukkan Sub Kriteria">
    Bobot : 
         <input type="text" class="form-control" name="bobot" placeholder="Masukkan bobot (1-10)">
    Factor : 
         <select name="factor" class="form-control">
         <option value="-1">--Pilih Factor--</option>
         <option value="factor">Core Factor</option>
         <option value="factor">Secondary Factor</option> 
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
