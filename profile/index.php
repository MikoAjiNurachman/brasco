<?php $role = "utility" ?>

<?php
// Load file koneksi.php
include "../env.php";
cekAdmin($role);
if (isset($_POST['kode_cabang'])) {
  $_POST['id'] = 1;
  $logo = $_FILES['logo']['name'];
  $id_admin = $_SESSION['admin']['id'];
  $query =  "UPDATE profil SET id ='{$_POST['id']}', kode_cabang = '{$_POST['kode_cabang']}',nama_cabang = '{$_POST['nama_cabang']}',alamat = '{$_POST['alamat']}',alamat2 = '{$_POST['alamat2']}',kota = '{$_POST['kota']}',kodepos = '{$_POST['kodepos']}',no_telp = '{$_POST['no_telp']}',no_hp = '{$_POST['no_hp']}',chief = '{$_POST['chief']}', id_edit_admin = '$id_admin'";
  if (!empty($logo)) {
    $hapus = mysqli_query($conn, "SELECT * FROM profil where id='{$_POST['id']}'");
    // menghapus gambar yang lama
    $nama_gambar = mysqli_fetch_assoc($hapus);
    // nama field gambar
    $lokasi = $nama_gambar['logo'];
    // alamat tempat foto
    if (move_uploaded_file($_FILES['logo']['tmp_name'], 'images/' . $logo)) {
      $query .= ",logo = '$logo' ";
      $hapus_gambar = "images/{$lokasi}";
      unlink($hapus_gambar);
    } else {
      alert('Foto tidak bisa diupload!');
    }
  }
  $query .= "WHERE id='{$_POST['id']}'";
  lanjutkan(mysqli_query($conn, $query), "Diupdate!");
}
$title = "Profile"; ?>
<script>
  var active = 'header_profil';
</script>


<?php include('../templates/header.php') ?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      PROFIL
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>
  <?php
  $query = "SELECT * FROM profil";
  $row = query($query)[0];
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
        <form method="post" action="" enctype="multipart/form-data" id="form">
          <div class="box-body">
            <div class="form-group" style="width: 10%">
              <label for="kode_cabang">Kode Cabang</label>
              <input type="text" class="form-control" name="kode_cabang" id="kode_cabang" value="<?php echo $row['kode_cabang']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="nama_cabang">Nama Cabang</label>
              <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" value="<?php echo $row['nama_cabang']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="alamat2">Alamat 2</label>
              <input type="text" class="form-control" name="alamat2" id="alamat2" value="<?php echo $row['alamat2']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="kota">Kota</label>
              <input type="text" class="form-control" name="kota" id="kota" value="<?php echo $row['kota']; ?>">
            </div>
            <div class="form-group" style="width: 10%">
              <label for="kodepos">Kodepos</label>
              <input type="text" class="form-control" name="kodepos" id="kodepos" value="<?php echo $row['kodepos']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="exampleInputPassword1">No Telepon</label>
              <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?php echo $row['no_telp']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="exampleInputPassword1">No Handphone</label>
              <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?php echo $row['no_hp']; ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="exampleInputPassword1">Chief Manager</label>
              <input type="text" class="form-control" name="chief" id="Chief" value="<?php echo $row['chief']; ?>">
            </div>
            <div class="form-group">
              <p class="text-bold">Logo</p>
              <img id="foto" src="profile/images/<?= $row['logo'] ?>" alt="Foto Profile" width="100px" height="100px">
              <input id="foto_input" type="file" id="logo" name="logo" class="custom-file-input" value="<?php echo $row['logo']; ?>">
            </div>
          </div>
          <div class="box-footer">
            <button type="button" id="edit" class="btn btn-success">Edit</button>
            <button id="buton" type="submit" value="simpan" class="btn btn-primary" name="simpan">Save</button>
          </div>
        </form>
      </div>
      <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $(document).ready(() => {
    $('#buton').hide()
    $('input').attr('readonly', 'readonly')
    $('#foto_input').hide()
  })
  $('#edit').on('click', () => {
    $('#buton').show()
    $('input').removeAttr('readonly')
    $('#foto_input').show()
    $('#foto').hide()
  })

</script>
<?php include('../templates/footer.php') ?>