<?php $role = "inventory" ?>

<?php
include '../env.php';
cekAdmin($role);
$title = 'Pengajuan Perubahan Harga';
$query = query("SELECT * FROM counter WHERE tabel = 'pengajuan_perubahan_harga'")[0];
$c = intval($query['digit']) + 1;
$id = $query['header'] . "-" . $c;


?>
<script>
  var active = 'header_perubahan';
  var active_2 = 'header_perubahan_pengajuan';
</script>
<!-- =============================================== -->
<?php include('../templates/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengajuan Perubahan Harga
    </h1>
    <script>
      var simpanData = [];
      var i = 1;
    </script>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box-body">
      <!-- right column -->
      <div class="col">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label-inline" for="nomorpengajuan">Nomor Pengajuan</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="nomor_pengajuan" value="<?= $id ?>" disabled id="nomorpengajuan" placeholder="Nomor Pengajuan..">
                </div>
              </div>

              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label class="col-sm-2 control-label-inline" for="formtanggal">Tanggal</label>
                <div class="col-sm-2">
                  <div class="input-group">
                    <input type="date" required id="formtanggal" name="tanggal" class="form-control">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.box-body -->
              <!-- select -->
              <div class="form-group">
                <label for="tipecustomer" class="col-sm-2">Tipe Customer</label>
                <div class="col-sm-2">
                  <select class="form-control" id="tipecustomer_pph" name="tipe_customer">
                    <option value="1">Customer 1</option>
                    <option value="2">Customer 2</option>
                    <option value="3">Customer 3</option>
                  </select>
                </div>
              </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="box box-info">
          <div class="box-body">
            <div class="row" style="margin-left: 5px">
              <div class="col-sm-2">
                <select id="barcode_pph" class="form-control">
                  <option value="0">Pilih Barcode</option>
                  <?php foreach (query("SELECT * FROM inventory") as $barcode) : ?>
                    <option value="<?= $barcode['barcode'] ?>"><?= $barcode['barcode'] ?> - <?= $barcode['nama_barang'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" disabled placeholder="Nama Item" id="item_pph">
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" disabled placeholder="H. Jual Lama" id="jual_pph">
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="H. Jual Baru" id='harga_baru'>
              </div>

              <div class="col-sm-2 col-xs-10 ">
                <input type="text" class="form-control" placeholder="Keterangan" id="keterangan">
              </div>
              <div class="col-sm-1 col-xs-2" style="margin-top: 5px;">
                <i class="fa fa-plus fa-2x" id="insert_pph" style="cursor:pointer"></i>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead align="center">
                    <tr>
                      <th>No</th>
                      <th>Barcode</th>
                      <th>Nama Item</th>
                      <th>Harga Jual Lama</th>
                      <th>Harga Jual Baru</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody align="center" id="table">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary pull-right btn-block" id="simpan_pph" name="simpan">Save</button>
        </form>
      </div>
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $('#insert_pph').on('click', function() {

    var data = {
      'barcode': $('#barcode_pph').val(),
      'harga_jual_lama': $('#jual_pph').val(),
      'harga_jual_baru': $('#harga_baru').val(),
      'keterangan': $('#keterangan').val()
    }
    if (!Number.isInteger(parseInt(data.harga_jual_baru))) {
      alert('Harga  Harus Berbentuk angka');
      return;
    }
    simpanData.push(data);
    $('#table').append(
      '<tr id="tr_pph_' + i + '">' +
      '<td>' + i + '</td>' +
      '<td>' + data.barcode + '</td>' +
      '<td>' + $('#item_pph').val() + '</td>' +
      '<td>' + data.harga_jual_lama + '</td>' +
      '<td>' + data.harga_jual_baru + '</td>' +
      '<td>' + data.keterangan + '</td>' +
      '<td onclick="hapus_pph(' + i + ')" style="cursor:pointer; color: red;" > Hapus' + '</td>' +
      '</tr>'
    );
    i++;
  });

  function delayTimes(callback, ms) {
    var timer = 0;
    return function() {
      var context = this,
        args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function() {
        callback.apply(context, args);
      }, ms || 0);
    };
  }

  function hapus_pph(number) {
    $('#tr_pph_' + number).remove();
    console.log(number);
  }
  $('#simpan_pph').on('click', function() {
    if ($('#formtanggal').val() == '') {
      alert("Tolong diisi tanggalnya");
      return false;

    }
    var owo = {
      'nomor_pengajuan': $('#nomorpengajuan').val(),
      'tanggal': $('#formtanggal').val(),
      'tipe_customer': $('#tipecustomer_pph').children("option:selected").val(),
    }
    $.ajax({
      url: 'pengajuan_perubahan_harga/ajax_barcode.php',
      type: 'POST',
      data: {
        'simpan': 'yes',
        'data': simpanData,
        'inti': owo
      },
      complete: function(res) {
        // console.log(res.responseText)
        // return false;
        console.log(response);

        var response = JSON.parse(res.responseText);
        if (response.msg == "berhasil") {
          alert('Data Berhasil Masuk');
          window.location.reload();
        } else {
          alert('Data Gagal Masuk');
          if (response.err = "Column 'tanggal' cannot be null") {
            alert('Tolong diisi tanggalnya');
          }
        }
      },
      error: function(jqXHR, textStatus, err) {
        console.log(textStatus + err + jqXHR);
      }
    })
  })
  $('#tipecustomer_pph').change(function() {
    $.ajax({
      url: './pengajuan_perubahan_harga/ajax_barcode.php',
      type: 'POST',
      data: {
        "barcode": $('#barcode_pph').val()
      },
      complete: function(response, text, XHR) {
        var res = JSON.parse(response.responseText);
        $('#item_pph').val(res.nama_barang);
        var tipe_pelanggan = $('#tipecustomer_pph').children("option:selected").val();
        if (tipe_pelanggan == 1) {
          $('#jual_pph').val(res.harga_jual1);
        } else if (tipe_pelanggan == 2) {
          $('#jual_pph').val(res.harga_jual2);
        } else if (tipe_pelanggan == 3) {
          $('#jual_pph').val(res.harga_jual3);
        }
      }
    })
  })
  $('#barcode_pph').change(() => {
    $.ajax({
      url: './pengajuan_perubahan_harga/ajax_barcode.php',
      type: 'POST',
      data: {
        "barcode": $('#barcode_pph').val()
      },
      complete: function(response, text, XHR) {
        var res = JSON.parse(response.responseText);
        $('#item_pph').val(res.nama_barang);
        var tipe_pelanggan = $('#tipecustomer_pph').children("option:selected").val();
        if (tipe_pelanggan == 1) {
          $('#jual_pph').val(res.harga_jual1);
        } else if (tipe_pelanggan == 2) {
          $('#jual_pph').val(res.harga_jual2);
        } else if (tipe_pelanggan == 3) {
          $('#jual_pph').val(res.harga_jual3);
        }
      }
    })
  });
</script>

<?php include('../templates/footer.php') ?>