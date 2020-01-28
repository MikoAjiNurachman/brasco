<?php $role = "inventory" ?>

<?php

require 'functions.php';

if (isset($_POST["submit"])) {
  if (ubah($_POST) > 0) {
    echo "
        <script>
        alert('Data Berhasil Diubah!');
        document.location.href='index.php';
        </script>
        ";
  } else {
    echo "
        <script>
        alert('Data Tidak ada yang Diubah!');
        document.location.href='index.php';
        </script>
        ";
  }
}
$id = $_GET["id"];

$data = query("SELECT * FROM inventory WHERE id=$id");
$data = $data[0];
$harga1 = $data['harga_jual1'];
$harga2 = $data['harga_jual2'];
$harga3 = $data['harga_jual3'];
$title = "Edit Data Inventory";
?>
<?php include('../templates/header.php') ?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Data Inventory
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Data Inventory</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="" method="post">
        <div class="box-body">
          <div class="form-group" style="width: 10%">
            <label for="InputBarcode">Barcode</label>
            <input type="text" class="form-control" readonly id="InputBarcode" name="barcode" placeholder="Barcode" value="<?php echo $data["barcode"]; ?>">
          </div>
          <div class="form-group" style="width: 70%">
            <label for="NamaItem">Nama Item</label>
            <input type="text" class="form-control" id="NamaItem" name="nama_barang" placeholder="Nama Item" value="<?php echo $data["nama_barang"]; ?>">
          </div>
          <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
          <div class="form-group" style="width: 10%">
            <label for="Satuan">Satuan</label>
            <select name="id_satuan" class="form-control">
              <?php
              $datat = query("SELECT * FROM satuan");
              foreach ($datat as $datas) : ?>
                <?php if ($datas['id'] ==  $data['satuan']) : ?>
                  <option selected value="<?= $datas['id'] ?>"><?= $datas['satuan'] ?></option>
                <?php else : ?>
                  <option value="<?= $datas['id'] ?>"><?= $datas['satuan'] ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group" style="width: 70%">
            <label>Tipe Barang</label>
            <select class="form-control" name="id_tipe_barang" id="id_tipe_barang" class="form-control">
              <?php
              $datat = cariBarang();
              foreach ($datat as $datas) : ?>
                <?php if ($datas['id'] ==  $data['id_tipe_barang']) : ?>
                  <option value="<?= $datas['id'] ?>" selected><?= $datas['nama_barang'] ?></option>
                <?php else : ?>
                  <option value="<?= $datas['id'] ?>"><?= $datas['nama_barang'] ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div style="width: 70%">
            <label>Harga Beli Akhir</label>
            <div class="form-group input-group">
              <span class="input-group-addon">Rp</span>
              <input readonly type="text" class="form-control">
              <span class="input-group-addon">.00</span>
            </div>
            <div class="form-group">
              <label for="TanggalAkhir">Tanggal Beli Akhir</label>
              <input readonly type="text" name="satuan" class="form-control" id="Satuan" placeholder="DD/MM/YYYY">
            </div>
            <div>
              <label>Harga Jual 1</label>
              <div class="form-group input-group">
                <span class="input-group-addon">Rp</span>
                <input type="text" name="harga_jual1" value="<?php echo $harga1; ?>" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>
              <div>
                <label>Harga Jual 2</label>
                <div class="form-group input-group">
                  <span class="input-group-addon">Rp</span>
                  <input type="text" name="harga_jual2" value="<?php echo $harga2; ?>" class="form-control">
                  <span class="input-group-addon">.00</span>
                </div>
                <div>
                  <label>Harga Jual 3</label>
                  <div class="form-group input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" name="harga_jual3" value="<?php echo $harga3; ?>" class="form-control">
                    <span class="input-group-addon">.00</span>
                  </div>

                  <!-- /.box-body -->
                  <div class="box-footer" style="float: right;">
                    <button type="submit" name="submit" class="btn btn-success">Save</button>
                  </div>
      </form>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  function cancel() {
    window.location.href = "index.php";
  }
</script>
<?php include('../templates/footer.php') ?>