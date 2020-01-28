<?php $title = 'Master Bank' ?>
<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role);
$id_add = $_SESSION['admin']['id'];
?>
<?php include('../templates/header.php');
?>
<!-- =============================================== -->

<script>
  var active = 'header_bank';
  var active_2 = 'header_bank_master';
</script>
<!-- =============================================== -->
<?php
if (isset($_POST['edit'])) {
  extract($_POST);
  $query = mysqli_query($conn, "UPDATE bank SET kode_bank = '$kode_bank_edit',nama_bank = '$nama_bank_edit',saldo_jalan = '$saldo_jalan_edit',saldo_awal = '$saldo_awal_edit',tipe='$tipe_edit',nomor_akun = '$nomor_akun_edit',id_edit_admin = '$id_add' WHERE kode_bank = '$kode_bank_edit'");
  if ($query) {
    ?>
    <script type="text/javascript">
      alert("Data Berhasil Diedit !")
    </script>
  <?php } else { ?>
    <script type="text/javascript">
      alert("Data Gagal Diedit !")
    </script>
<?php }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Master Bank</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

        <div class="form">
          <form method="POST" class="form-horizontal" action="kas_bank/master_bank.php">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2">Kode Bank / Kas</label>
                <div class="col-sm-4">
                  <input type="text" id="kode_bank" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2">Nama Bank / Kas</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="nama_bank">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2">Saldo Awal</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" id="saldo_awal">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2">Saldo Jalan</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" id="saldo_jalan">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2">Tipe</label>
                <div class="col-sm-4">
                  <select id="tipe" class="form-control ">
                    <option value="kas">Kas</option>
                    <option value="bank">Bank</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2">Kode Akun</label>
                <div class="col-sm-4">
                  <select class="form-control select2" id="nomor_akun">
                    <option selected="" disabled="">Kode Akun</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT kodeakun,namaakun FROM ms_akun");
                    foreach ($query as $data) {
                      ?>
                      <option value="<?= $data['kodeakun'] ?>"><?= $data['kodeakun'] ?> - <?= $data['namaakun'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <label></label>
              </div>
              <div class="col-sm-6">
                <button type="button" id="save" class="btn btn-info pull-right">Save</button>
              </div>
            </div>
          </form>
        </div>

        <div class="data-table">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <th>No</th>
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th>Saldo Awal</th>
                <th>Saldo Jalan</th>
                <th>Tipe</th>
                <th>Nomor Akun</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $show = mysqli_query($conn, "SELECT * FROM bank ORDER BY kode_bank");
                $no = 1;
                foreach ($show as $datas) {
                  ?>
                  <div class="form">
                    <form method="POST" class="form-horizontal" enctype="form-data" action="kas_bank/master_bank.php">
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $datas['kode_bank'] ?></td>
                        <td><?= $datas['nama_bank'] ?></td>
                        <td><?= $datas['saldo_awal'] ?></td>
                        <td><?= $datas['saldo_jalan'] ?></td>
                        <td><?= $datas['tipe'] ?></td>
                        <td><?= $datas['nomor_akun'] ?></td>
                        <td>
                          <a><button type="button" class="btn btn-success" data-toggle="modal" data-target="#prev_edit<?= $no ?>" class="pad"><i class="fa fa-edit fa-lg"></i></button></a>
                          <a href="kas_bank/delete.php?kode_bank=<?= $datas['kode_bank'] ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></button></a>
                        </td>
                      </tr>
                      <div class="modal fade" id="prev_edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title">Edit Data</h4>

                            </div>
                            <div class="modal-body">
                              <div class="box-body">
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Kode Bank</label>
                                  <div class="col-sm-10">
                                    <input type="text" readonly="" name="kode_bank_edit" value="<?= $datas['kode_bank'] ?>" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Nama Bank</label>
                                  <div class="col-sm-10">
                                    <input type="text" value="<?= $datas['nama_bank'] ?>" class="form-control" name="nama_bank_edit">
                                  </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Saldo Awal</label>
                                  <div class="col-sm-10">
                                    <input type="number" class="form-control" value="<?= $datas['saldo_awal'] ?>" name="saldo_awal_edit">
                                  </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Saldo Jalan</label>
                                  <div class="col-sm-10">
                                    <input type="number" value="<?= $datas['saldo_jalan'] ?>" class="form-control" name="saldo_jalan_edit">
                                  </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Tipe</label>
                                  <div class="col-sm-10">
                                    <select name="tipe_edit" class="form-control">
                                      <option value="kas" <?php if ($datas['tipe'] == "kas") {
                                                              echo "selected";
                                                            } ?>>Kas</option>
                                      <option value="bank" <?php if ($datas['tipe'] == "bank") {
                                                                echo "selected";
                                                              } ?>>Bank</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group" style="padding-bottom: 50px">
                                  <label class="col-sm-2">Kode Akun</label>
                                  <div class="col-sm-10">
                                    <select class="form-control" name="nomor_akun_edit">
                                      <?php
                                        $nomor_akun = $datas['nomor_akun'];
                                        $tam = mysqli_fetch_array(mysqli_query($conn, "SELECT kodeakun,namaakun FROM ms_akun WHERE kodeakun = '$nomor_akun'"));
                                        ?>
                                      <?php
                                        $query = mysqli_query($conn, "SELECT kodeakun,namaakun FROM ms_akun");
                                        foreach ($query as $data) {
                                          ?>
                                        <option <?= ($tam['kodeakun'] == $data['kodeakun']) ? 'selected' : null ?> value="<?= $data['kodeakun'] ?>"><?= $data['kodeakun'] ?> - <?= $data['namaakun'] ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </form>
                  </div>
          </div>
        </div>
      <?php $no++;
      } ?>
      </tbody>
      </table>
      </div>
    </div>

</div>
<!-- /.box-body -->
<!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include('../templates/footer.php') ?>
<script type="text/javascript">
  var status;
  $('#kode_bank').keyup(function() {
    var data = $('#kode_bank').val();
    if ($('#kode_bank').val() == '') {
      $('#').css('border', '1px solid red');
      return;
    }
    $.ajax({
      url: './kas_bank/ajax.php',
      type: 'POST',
      data: {
        "kode": $('#kode_bank').val(),
        "params": 15
      },
      complete: function(response, textStatus, jqXHR) {
        var respon = JSON.parse(response.responseText);
        if (respon == 0) {
          $('#kode_bank').css('border', '1px solid green');
          status = 1;
        } else {
          $('#kode_bank').css('border', '1px solid red');
          status = 0;
        }
      },
      error: function(jqXHR, textStatus, err) {
        console.log(textStatus + err + jqXHR);
      }

    });
  });
  $('#save').click(function() {
    var kode_bank = $('#kode_bank').val()
    var nama_bank = $('#nama_bank').val()
    var saldo_awal = $('#saldo_awal').val()
    var saldo_jalan = $('#saldo_jalan').val()
    var tipe = $('#tipe').val()
    var nomor_akun = $('#nomor_akun').val()
    if (status == 1) {
      $.post('kas_bank/ajax.php', {
        'params': 5,
        'kode_bank': kode_bank,
        'nama_bank': nama_bank,
        'saldo_awal': saldo_awal,
        'saldo_jalan': saldo_jalan,
        'tipe': tipe,
        'nomor_akun': nomor_akun
      }, function(res) {
        var message = JSON.parse(res)
        alert(message)
        $('#kode_bank').val('')
        $('#nama_bank').val('')
        $('#saldo_awal').val('')
        $('#saldo_jalan').val('')
        $('#tipe').val()
        $('#nomor_akun').val('')
        location.reload(true)
      })
    } else {
      alert("Tolong dibetulkan kode banknya");
    }

  })
</script>ation.reload(true)
})
})
</script>