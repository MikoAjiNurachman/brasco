<?php $title = 'Transfer uang antar kas bank' ?>
<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role);
?>
<?php include('../templates/header.php'); ?>
<!-- =============================================== -->

<script>
  var active = 'header_bank';
  var active_2 = 'header_bank_transfer';
</script>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- <section class="content-header">
      <h1>
        MASTER DATA INVETORY
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section> -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Form input Transfer uang antar kas bank</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-9">
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Informasi Penting!</h4>
              Transfer Uang ini akan memakai 2 no KK.... dan KM...., supaya print bank dan rincian sesuai,
              untuk jurnal hanya di buat 1 pasang saja saat di simpan
            </div>
          </div>
        </div>
        <div class="">
          <form class="form-horizontal">
            <div class="box-body">
              <!-- #1 -->
              <div class="form-group">
                <label class="col-sm-2">No Transfer</label>
                <div class="col-sm-2">
                  <?php
                  $query = mysqli_fetch_array(mysqli_query($conn, "SELECT header FROM counter WHERE tabel='no_kas_keluar'"));
                  $kk = $query['header'];
                  $digit = mysqli_fetch_array(mysqli_query($conn, "SELECT max(digit) as digie FROM counter WHERE tabel='no_kas_keluar'"));
                  $angka = $digit['digie'];
                  $angka++;
                  $char = "$kk-";
                  $no = $char . sprintf("%08s", $angka);
                  ?>
                  <input type="text" class="form-control" value="<?= $no ?>" id="no_kas_keluar" readonly="">
                </div>
                <label class="col-sm-1 control-label">Tanggal</label>
                <div class="col-sm-2">
                  <div class="input-group">
                    <input type="date" readonly="" value="<?= date('Y-m-d') ?>" id="tanggal_now" class="form-control">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- #2  -->
              <div class="form-group">
                <label class="col-sm-2">Dari Kas/bank</label>
                <div class="col-sm-2">
                  <select id="kode_bank1" class="form-control">
                    <option selected="" disabled="">Kas Bank</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM bank");
                    foreach ($query as $data) {
                      ?>
                      <option value="<?= $data['kode_bank'] ?>"><?= $data['kode_bank'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <label></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" readonly="" id="nama_bank1">
                </div>
                <label></label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="saldo1" readonly="">
                </div>
              </div>
              <!-- #3 -->
              <div class="form-group">
                <label class="col-sm-2">Jumlah Transfer</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" id="jumlah">
                </div>
              </div>
              <!-- #4 -->
              <div class="form-group">
                <label class="col-sm-2">No Terima</label>
                <div class="col-sm-2">
                  <?php
                  $query = mysqli_fetch_array(mysqli_query($conn, "SELECT header FROM counter WHERE tabel='no_kas_masuk'"));
                  $km = $query['header'];
                  $digit = mysqli_fetch_array(mysqli_query($conn, "SELECT max(digit) as digie FROM counter WHERE tabel='no_kas_masuk'"));
                  $angka = $digit['digie'];
                  $angka++;
                  $char = "$km-";
                  $no = $char . sprintf("%08s", $angka);
                  ?>
                  <input type="text" class="form-control" id="no_kas_masuk" value="<?= $no ?>" readonly="">
                </div>
              </div>
              <!-- #5 -->
              <div class="form-group">
                <label class="col-sm-2">Ke Kas/bank</label>
                <div class="col-sm-2">
                  <select id="kode_bank2" class="form-control">
                    <option selected="" disabled="">Kas Bank</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM bank");
                    foreach ($query as $data) {
                      ?>
                      <option value="<?= $data['kode_bank'] ?>"><?= $data['kode_bank'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <label></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="nama_bank2" readonly="">
                </div>
                <label></label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="saldo2" readonly="">
                </div>
              </div>
              <!-- #6 -->
              <div class="form-group">
                <div class="col-sm-9">
                  <textarea class="form-control" id="keterangan" rows="3">Keterangan. . . . . </textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-9">
                  <div class="pull-right">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" id="save" class="btn btn-info">Simpan</button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>
<script type="text/javascript">
  $('#save').click(function() {
    var tanggal_now = $('#tanggal_now').val()
    var no_kas_keluar = $('#no_kas_keluar').val()
    var no_kas_masuk = $('#no_kas_masuk').val()
    var kode_bank1 = $('#kode_bank1').val()
    var kode_bank2 = $('#kode_bank2').val()
    var nama_bank1 = $('#nama_bank1').val()
    var nama_bank2 = $('#nama_bank2').val()
    var jumlah = $('#jumlah').val()
    var saldo1 = $('#saldo1').val()
    var saldo2 = $('#saldo2').val()
    var keterangan = $('#keterangan').val()
    $.post('kas_bank/ajax.php', {
      'params': 7,
      'tanggal_now': tanggal_now,
      'no_kas_keluar': no_kas_keluar,
      'no_kas_masuk': no_kas_masuk,
      'kode_bank1': kode_bank1,
      'kode_bank2': kode_bank2,
      'nama_bank1': nama_bank1,
      'nama_bank2': nama_bank2,
      'jumlah': jumlah,
      'saldo1': saldo1,
      'saldo2': saldo2,
      'keterangan': keterangan
    }, function(res) {
      res = JSON.parse(res)
      alert(res)
      location.reload(true)
    })
  })
  $('#kode_bank1').change(function() {
    var kode_bank = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 6,
      'kode_bank': kode_bank
    }, function(res) {
      res = JSON.parse(res)
      $('#nama_bank1').val(res.nama_bank)
      $('#saldo1').val(res.saldo_jalan)
    })
  })
  $('#kode_bank2').change(function() {
    var kode_bank = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 6,
      'kode_bank': kode_bank
    }, function(res) {
      res = JSON.parse(res)
      $('#nama_bank2').val(res.nama_bank)
      $('#saldo2').val(res.saldo_jalan)
    })
  })
</script>