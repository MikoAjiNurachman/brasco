<?php $role = "utility" ?>

<?php
$title = "Show Profile";
include('../templates/header.php') ?>
<?php
include('dbconnect.php');

//query
$query = "SELECT * FROM profil WHERE id='1'";
$result = mysqli_query($conn, $query);

?>
<div class="content-wrapper">
  <form method="post" action="edit.php" enctype="multipart/form-data">

    <?php
    while ($row = mysqli_fetch_assoc($result)) {

      ?>

      <!-- Main content -->
      <section class="content">

        <div class="">
          <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">PROFIL</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="proses_simpan.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="callout callout-danger">
                  <label>Informasi!<br>Data Profil</label>
                </div>
                <div class="form-group" style="width: 10%">
                  <label for="kode_cabang">Kode Cabang</label>
                  <input type="text" class="form-control" name="kode_cabang" id="kode_cabang" value="<?php echo $row['kode_cabang']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="nama_cabang">Nama Cabang</label>
                  <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" value="<?php echo $row['nama_cabang']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="alamat2"></label>
                  <input type="text" class="form-control" name="alamat2" id="alamat2" value="<?php echo $row['alamat2']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="kota">Kota</label>
                  <input type="text" class="form-control" name="kota" id="kota" value="<?php echo $row['kota']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 10%">
                  <label for="kodepos">Kodepos</label>
                  <input type="text" class="form-control" name="kodepos" id="kodepos" value="<?php echo $row['kodepos']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="exampleInputPassword1">No Telepon</label>
                  <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?php echo $row['no_telp']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="exampleInputPassword1">No Handphone</label>
                  <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?php echo $row['no_hp']; ?>" disabled>
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="exampleInputPassword1">Chief Manager</label>
                  <input type="text" class="form-control" name="chief" id="Chief" value="<?php echo $row['chief']; ?>" disabled>
                </div>
                <label for="exampleInputFile">Logo</label>
              <?php echo "<td><img src='profile/images/" . $row['logo'] . "' width='100' height='100'></td>";
                echo "<br><br><td><center><a href='profil.php'>Kembali ke halaman profil</a></td></center><br><br><br>";
                echo "</tr>";
              }
              ?>
              <a href="editform.php" class="btn btn-primary">Edit</a>
              </div>
            </form>
          </div>
        </div>
      </section>
  </form>
</div>

</body>

</html>



<?php include('../templates/footer.php') ?>