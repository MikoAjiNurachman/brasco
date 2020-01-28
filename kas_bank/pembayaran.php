<?php $title = 'Form input Pembayaran' ?>
<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role); ?>
<?php include('../templates/header.php');
?>
<!-- =============================================== -->

<script>
  var active = 'header_bank';
  var active_2 = 'header_bank_pembayaran';
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
        <h3 class="box-title">Form Input Pembayaran</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="">
          <form class="form-horizontal" method="post">
            <div class="box-body">
              <!-- #1 -->
              <div class="form-group">
                <label class="col-sm-2 ">No kas Keluar</label>
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
                  <input type="text" class="form-control" value="<?= $no ?>" id="no_kas" readonly="">
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
              <!-- #2 -->
              <div class="form-group">
                <label class="col-sm-2 ">Kas/bank</label>
                <div class="col-sm-3">
                  <select id="kode_bank" class="form-control">
                    <option selected="">Kas Bank</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM bank");
                    foreach ($query as $data) {
                      ?>
                      <option value="<?= $data['kode_bank'] ?>"><?= $data['kode_bank'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <label>
                  <!-- sebagai penambah padding saat responsive --></label>
                <div class="col-sm-4">
                  <input type="text" id="nama_bank" readonly="" placeholder="Nama Bank" class="form-control" name="">
                </div>
              </div>
              <!-- #3 -->
              <div class="form-group">
                <label class="col-sm-2 ">No Giro</label>
                <div class="col-sm-3">
                  <input type="text" id="no_giro" class="form-control" name="">
                </div>
              </div>
              <!-- #4 -->
              <div class="form-group">
                <label class="col-sm-2">Tanggal Giro</label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <input type="date" name="tanggal1" id="tanggal_giro" class="form-control">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- #5 -->
              <div class="form-group">
                <label class="col-sm-2">Jenis Biaya</label>
                <div class="col-sm-3">
                  <select class="form-control select2" id="kode_akun">
                    <option selected="" disabled="">Kode Akun</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT kodeakun,namaakun FROM ms_akun");
                    foreach ($query as $data) {
                      ?>
                      <option value="<?= $data['kodeakun'] ?>"><?= $data['kodeakun'] ?> - <?= $data['namaakun'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <label>
                  <!-- sebagai penambah padding saat responsive --></label>
                <div class="col-sm-4">
                  <input type="text" id="nama_akun" readonly="" class="form-control" placeholder="Nama Akun">
                </div>
              </div>
              <!-- #6 -->
              <div class="form-group">
                <label class="col-sm-2">Jumlah</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="jumlah">
                </div>
              </div>
              <!-- #7 -->
              <div class="form-group">
                <div class="col-sm-9">
                  <textarea class="form-control" id="ket" rows="3" placeholder="Keterangan"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-9">
                  <div class="pull-right">
                    <button type="button" id="reset" class="btn btn-danger">Reset</button>
                    <button type="button" id="simpan" class="btn btn-info">Simpan</button>
                  </div>
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
  $('#reset').click(function() {
    window.location.reload()
  })
  $('#simpan').click(function() {
    var no_kas = $('#no_kas').val()
    var tanggal_now = $('#tanggal_now').val()
    var kode_bank = $('#kode_bank').val()
    var nama_bank = $('#nama_bank').val()
    var no_giro = $('#no_giro').val()
    var tanggal_giro = $('#tanggal_giro').val()
    var kode_akun = $('#kode_akun').val()
    var nama_akun = $('#nama_akun').val()
    var jumlah = $('#jumlah').val()
    var ket = $('#ket').val()
    $.post('kas_bank/ajax.php', {
      'params': 3,
      'no_kas': no_kas,
      'tanggal_now': tanggal_now,
      'kode_bank': kode_bank,
      'nama_bank': nama_bank,
      'no_giro': no_giro,
      'tanggal_giro': tanggal_giro,
      'kode_akun': kode_akun,
      'nama_akun': nama_akun,
      'jumlah': jumlah,
      'ket': ket
    }, function(res) {
      var message = JSON.parse(res)
      alert(message.response)
      var no_kas = $('#no_kas').val('')
      var tanggal_now = $('#tanggal_now').val('')
      var kode_bank = $('#kode_bank').val('')
      var nama_bank = $('#nama_bank').val('')
      var no_giro = $('#no_giro').val('')
      var tanggal_giro = $('#tanggal_giro').val('')
      var kode_akun = $('#kode_akun').val('')
      var nama_akun = $('#nama_akun').val('')
      var jumlah = $('#jumlah').val('')
      var ket = $('#ket').val('')
      location.reload(true)
    })
  })
  $('#kode_bank').change(function() {
    var kode_bank = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 1,
      'kode_bank': kode_bank
    }, function(res) {
      var obj = JSON.parse(res)
      if (obj) {
        $('#nama_bank').val(obj.nama_bank)
      } else {
        $('#nama_bank').val('')
      }
    })
  })
  $('#kode_akun').change(function() {
    var kode_akun = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 2,
      'kode_akun': kode_akun
    }, function(res) {
      var obj = JSON.parse(res)
      if (obj) {
        $('#nama_akun').val(obj.nama_akun)
      } else {
        $('#nama_akun').val('')
      }
    })
  })
</script>