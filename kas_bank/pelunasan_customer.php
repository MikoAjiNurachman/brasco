<?php $title = 'Pelunasan Customer' ?>
<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role); ?>
<?php include('../templates/header.php');
?>
<!-- =============================================== -->

<script>
  var active = 'header_bank';
  var active_2 = 'header_bank_pelunasan_customer';
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
        <h3 class="box-title">Form Pelunasan ke Customer</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="form row">
          <form class="form-horizontal" method="post">
            <!-- bagian 1 -->
            <div class="row">
              <div class="box-body">
                <div class="col-sm-7">
                  <div class="box-body">
                    <!-- #1 -->
                    <div class="form-group">
                      <label class="col-sm-3">Kode Customer</label>
                      <div class="col-sm-9">
                        <select id="kode_customer" class="form-control">
                          <option selected="">Kode Customer</option>
                          <?php
                          $query = mysqli_query($conn, "SELECT kode,nama FROM customer");
                          foreach ($query as $data) {
                            ?>
                            <option value="<?= $data['kode'] ?>"><?= $data['kode'] ?> - <?= $data['nama'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3">Nama Customer</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_customer" readonly="">
                      </div>
                    </div>
                    <!-- #2.1 -->
                    <div class="form-group">
                      <label class="col-sm-3">Alamat</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat" readonly="">
                      </div>
                    </div>
                    <!-- #2.2 -->
                    <div class="form-group">
                      <label class="col-sm-3"></label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="kota" readonly="">
                      </div>
                    </div>
                    <!-- #3 -->
                    <div class="form-group">
                      <label class="col-sm-3">Saldo Awal</label>
                      <div class="col-sm-5">
                        <input type="number" class="form-control" id="saldo_awal" readonly="">
                      </div>
                    </div>
                    <!-- #4 -->
                    <div class="form-group">
                      <label class="col-sm-3">Saldo Jalan</label>
                      <div class="col-sm-5">
                        <input type="number" class="form-control" id="saldo_jalan" readonly="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="box-body">
                    <!-- #1 -->
                    <div class="form-group">
                      <label class="col-sm-3">No Telepon</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="telepon" readonly="">
                      </div>
                    </div>
                    <!-- #2 -->
                    <div class="form-group">
                      <label class="col-sm-3">No HP</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="hp" readonly="">
                      </div>
                    </div>
                    <!-- #3 -->
                    <div class="form-group">
                      <label class="col-sm-3">TOP</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="top" readonly="">
                      </div>
                    </div>
                    <!-- #4 -->
                    <div class="form-group">
                      <label class="col-sm-3">Tgl Beli Akhir</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <input type="date" id="tanggal_jual_akhir" readonly="" class="form-control">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- #5 -->
                    <div class="form-group">
                      <label class="col-sm-3">Jml Beli 1 thn</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jumlah_satu_tahun" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /bagian 1 -->
            <div style="padding-right: 10px; padding-left: 10px;">
              <hr>
            </div>
            <!-- bagian 2 -->
            <div class="row">
              <div class="box-body">
                <div class="col-sm-12">
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2">No Transaksi</label>
                      <div class="col-sm-3">
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
                      <label class="col-sm-1">Tanggal</label>
                      <div class="col-sm-3">
                        <div class="input-group">
                          <input type="date" name="tanggal1" id="tanggal_now" value="<?= date('Y-m-d') ?>" class="form-control" readonly="">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2">kd kas/bank</label>
                      <div class="col-sm-3">
                        <select id="kode_bank" class="form-control">
                          <option selected="">Kode Bank</option>
                          <?php
                          $query = mysqli_query($conn, "SELECT kode_bank,nama_bank FROM bank");
                          foreach ($query as $data) {
                            ?>
                            <option value="<?= $data['kode_bank'] ?>"><?= $data['kode_bank'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <label></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="nama_bank" readonly="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2">No Giro</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="no_giro">
                      </div>
                      <label class="col-sm-1">Jumlah Byr</label>
                      <div class="col-sm-3">
                        <input type="number" class="form-control" id="jumlah">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <textarea class="form-control" id="ket" rows="3" placeholder="keterangan"></textarea>
                      </div>
                      <label class="col-sm-1">Sisa</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="sisa" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /bagian 2 -->

            <!-- data table -->
            <div class="box-body">
              <div class="data-table">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Trans</th>
                        <th>Tanggal</th>
                        <th>Tgl jth Tempo</th>
                        <th>Jumlah</th>
                        <th>Outstanding</th>
                        <th>Kat</th>
                        <th>Bayar</th>
                      </tr>
                    </thead>
                    <tbody id="dataSemua">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- button -->
            <div class="box-body">
              <div class="button pull-right">
                <!-- <button type="" class="btn btn-danger">Keluar</button> -->
                <button type="button" id="simpan" class="btn btn-info">Simpan</button>
              </div>
            </div>

          </form>
        </div>

        <!-- data table -->

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php'); ?>
<script type="text/javascript">
  var outstanding = 0;
  var save = [];
  $('#kode_bank').change(function() {
    var kode_bank = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 1,
      'kode_bank': kode_bank
    }, function(response) {
      res = JSON.parse(response)
      if (res) {
        $('#nama_bank').val(res.nama_bank)
        save.bank = res;
      } else {
        $('#nama_bank').val('')
      }
    })
  })

  function bayar(kode, outstandings) {
    save.outstanding = outstandings
    outstanding = outstandings;
    $('#jumlah').val(outstandings);
    save.kode = kode;
    save.bayar = $('#jumlah').val()
    $('#sisa').val('0')
  }
  $('#simpan').click(() => {
    console.log(save)
    save.giro = $('#no_giro').val()
    save.no_transaksi = $('#no_kas_masuk').val()
    save.tanggal = $('#tanggal_now').val()
    save.keterangan = $('#ket').val()
    if (save.giro == '' || save.no_transaksi == '' || save.keterangan == '') {
      alert("Tolong diisi semua datanya!");
      return false;
    } else {
      $.post('kas_bank/ajax.php', {
        'params': 10,
        'kode_bank': save.bank.kode_bank,
        'nomor_akun': save.bank.nomor_akun,
        'no_transaksi': save.no_transaksi,
        'outstanding': save.outstanding,
        'bayar': save.bayar,
        'saldo_jalan': save.bank.saldo_jalan,
        'kode': save.kode,
        'tanggal': save.tanggal,
        'giro': save.giro,
        'keterangan': save.keterangan,
        'tipe': save.bank.tipe
      }, (res) => {
        res = JSON.parse(res);
        alert(res.msg);
        console.log(res)
        if (res.status == 201) {
          window.location.reload(true)
        }
      })
    }
  })
  $('#jumlah').keyup(() => {
    save.bayar = $('#jumlah').val()
    var sisa = outstanding - parseInt($('#jumlah').val());
    if (sisa < 0) {
      alert('Jumlah Bayar tidak boleh minus!')
      return false;
    } else {
      $('#sisa').val(sisa)
    }
  })
  $('#kode_customer').change(function() {
    var kode_customer = $(this).val()
    $.post('kas_bank/ajax.php', {
      'params': 8,
      'kode_customer': kode_customer
    }, function(res) {
      res = JSON.parse(res)
      if (res) {
        $('#dataSemua').html('')
        $('#nama_customer').val(res.nama)
        $('#alamat').val(res.alamat)
        $('#kota').val(res.kota)
        $('#saldo_awal').val(res.saldo_awal)
        $('#saldo_jalan').val(res.saldo_jalan)
        $('#telepon').val(res.telepon)
        $('#hp').val(res.handphone)
        $('#top').val(res.top)
        $('#jumlah_satu_tahun').val(res.total)
        $('#tanggal_jual_akhir').val(res.tanggal_jual_akhir)
        if (typeof res.item_all != "undefined") {
          var iter = 1;
          res.item_all.forEach((si) => {
            var part = si.tanggal.split('-')
            var jatuh_tempo = new Date(part[0], part[1], parseInt(part[2]) + parseInt(res.top));
            $('#dataSemua').append(`
              <tr>
                  <td>${iter}</td>
                  <td>${si.nomor_invoice}</td>
                  <td>${si.tanggal}</td>
                  <td>${jatuh_tempo.getFullYear()}-${jatuh_tempo.getMonth()}-${jatuh_tempo.getDate()}</td>
                  <td>${si.total}</td>
                  <td>${si.outstanding}</td>
                  <td>${si.nomor_invoice.split('-')[0]}</td>
                  <td><button ${(si.outstanding == 0) ? 'disabled' : null } onclick="bayar('${si.nomor_invoice}','${si.outstanding}')" type="button" class="btn btn-primary">Pilih</button></td>
                </tr>
            `)
            iter++;
          })

        } else {
          $('#dataSemua').html('<tr><td></td><td></td><td></td><td>Tidak Ada Data</td><td></td><td></td><td></td><td></td></tr>')
        }
      } else {
        $('#nama_customer').val('')
        $('#alamat').val('')
        $('#kota').val('')
        $('#saldo_awal').val('')
        $('#saldo_jalan').val('')
        $('#telepon').val('')
        $('#hp').val('')
        $('#top').val('')
        $('#tanggal_jual_akhir').val('')
        $('#jumlah_satu_tahun').val('')
        $('#dataSemua').html('')
      }
    })
  })
</script>