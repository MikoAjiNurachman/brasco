<script>
  var active = 'header_customer';
</script>
<?php $role = "pemasaran" ?>

<?php
$title = 'Master Data Customer';
include '../env.php';
cekAdmin($role);

if (isset($_POST['edit'])) {
  extract($_POST);
  $kode_customer = $kode;

  $id_admin = $_SESSION['admin']['id'];
  $query = "UPDATE customer 
  SET
  kode = '$kode_customer',
  nama = '$nama',
  kota = '$kota',
  alamat = '$alamat',
  kodepos = '$kodepos',
  telepon = '$telepon',
  handphone = '$handphone',
  npwp = '$npwp',
  ktp = '$ktp',
  tipe_customer = '$tipe_customer',
  kredit = '$kredit',
  contact_name = '$contact_name',
  email = '$email',
  kode_sales = '$kode_sales',
  top = '$top',
  batas_kredit = '$batas_kredit',
  tanggal_jual_akhir = '$tanggal',
  saldo_awal = '$saldo_awal',
  saldo_jalan = '$saldo_jalan',
  keterangan = '$keterangan',
  id_edit_admin = '$id_admin'
  WHERE kode = '$kode_old'";
  $sql = mysqli_query($conn, $query);
  lanjutkan($sql, "Diedit");
} else if (isset($_POST['delete'])) {

  $id = $_POST['delete'];
  $query = "DELETE FROM customer WHERE kode = '$id'";
  $sql = mysqli_query($conn, $query);
  lanjutkan($sql, "Dihapus");
} else if (isset($_POST['simpan'])) {
  extract($_POST);
  $kode_customer = $kode;

  $id_admin = $_SESSION['admin']['id'];
  $query =  "INSERT INTO customer(kode,nama,alamat,kota,kodepos,telepon,handphone,npwp,ktp,tipe_customer,kredit,contact_name,email,kode_sales,top,batas_kredit,tanggal_jual_akhir,saldo_awal,saldo_jalan,keterangan, id_admin, id_edit_admin) VALUES(
    '$kode_customer','$nama','$alamat','$kota','$kodepos','$telepon','$handphone','$npwp','$ktp','$tipe_customer','$kredit','$contact_name','$email','$kode_sales','$top','$batas_kredit','$tanggal','$saldo_awal','$saldo_jalan','$keterangan', '$id_admin', '0'
  );";
  $sql = mysqli_query($conn, $query);
  lanjutkan($sql, "Disimpan");
}
$show = query("SELECT * FROM customer");
?>

<!-- =============================================== -->
<?php include('../templates/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      MASTER DATA CUSTOMER
    </h1>
    <!-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol> -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Input Data Customer</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <form action="" method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-3">Kode Customer</label>
              <div class="col-sm-9">
                <input type="text" name="kode" class="form-control" style="width: 40%;">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Nama Customer</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" style="width: 40%;">
              </div>
            </div>
          </div>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom ">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Nama dan Alamat</a></li>
              <li><a href="#tab_2" data-toggle="tab">Profil</a></li>
              <li><a href="#tab_3" data-toggle="tab">Aging</a></li>
              <li><a href="#tab_4" data-toggle="tab">Keterangan</a></li>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-3">Alamat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" name="alamat" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Kota</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="kota" required class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Kode Pos</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="number" name="kodepos" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Telepon</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="number" name="telepon" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Handphone</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="number" name="handphone" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_2">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-3">NPWP</label>
                    <div class="col-sm-9">
                      <input type="number" name="npwp" class="form-control" required style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">KTP</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="ktp" class="form-control" required style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Tipe Customer</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <select class="form-control" name="tipe_customer" style="width: 50%">
                        <option value="1">Customer 1</option>
                        <option value="2">Customer 2</option>
                        <option value="3">Customer 3</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Kredit</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <select class="form-control" name="kredit" style="width: 50%">
                        <option>Y</option>
                        <option>T</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Contact Name</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="contact_name" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Email</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="email" name="email" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Kode Sales</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="kode_sales" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_3">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-3">TOP</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="top" required class="form-control" style="width: 60%;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Batas Kredit</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="batas_kredit" required class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Tanggal Jual Akhir</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <div class="input-group" style="width: 40%;">
                        <input type="date" name="tanggal" class="form-control">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Saldo Awal</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="number" name="saldo_awal" required class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Saldo Jalan</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <input type="text" name="saldo_jalan" required class="form-control">
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_4">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-3">Keterangan</label>
                    <div class="col-sm-9" style="margin-top: 10px;">
                      <textarea class="form-control" rows="3" name="keterangan" required></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="buton pull-right">
                  <div class="save pad col-xs-6">
                    <button class="btn btn-info" type="submit" name="simpan">Save</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.tab-pane -->

        </form>

        <!-- /.tab-content -->

        <div class="data-table table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Kode Customer</th>
                <th>Nama Customer</th>
                <th>Saldo Awal</th>
                <th>Saldo Jalan</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($show as $data) : ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $data['kode'] ?></td>
                  <td><?= $data['nama'] ?></td>
                  <td><?= $data['saldo_awal'] ?></td>
                  <td><?= $data['saldo_jalan'] ?></td>
                  <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_customer<?= $i ?>">Detail</button>



                  </td>
                </tr>

                <!-- modal form -->
                <div class="modal fade" id="modal_customer<?= $i ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Detail</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="">
                          <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-3">Kode Customer</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode" value="<?= $data['kode'] ?> " required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3">Nama Customer</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                              </div>
                            </div>
                          </div>
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1_<?= $i ?>" data-toggle="tab">Nama dan Alamat</a></li>
                            <li><a href="#tab_2_<?= $i ?>" data-toggle="tab">Profil</a></li>
                            <li><a href="#tab_3_<?= $i ?>" data-toggle="tab">Aging</a></li>
                            <li><a href="#tab_4_<?= $i ?>" data-toggle="tab">Keterangan</a></li>
                          </ul>
                          <div class="tab-content">

                            <div class="tab-pane active" id="tab_1_<?= $i ?>">
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-3">Alamat</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" name="alamat"><?= $data['alamat'] ?></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Kota</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="kota" required class="form-control" value="<?= $data['kota'] ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Kode Pos</label>
                                  <div class="col-sm-9">
                                    <input type="number" name="kodepos" required class="form-control" value="<?= $data['kodepos'] ?>" style="width: 50%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Telepon</label>
                                  <div class="col-sm-9">
                                    <input type="number" name="telepon" required class="form-control" value="<?= $data['telepon'] ?>" style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Handphone</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="handphone" value="<?= $data['handphone'] ?>" required class="form-control" style="width: 60%;">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="tab-pane" id="tab_2_<?= $i ?>">
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-3">NPWP</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="npwp" class="form-control" value="<?= $data['npwp'] ?>" required style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">KTP</label>
                                  <div class="col-sm-9">
                                    <input value="<?= $data['ktp'] ?>" type="text" name="ktp" class="form-control" required style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Tipe Customer</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" name="tipe_customer" style="width: 50%">
                                      <option <?php if ($data['tipe_customer'] == 1) echo "active" ?> value="1">Customer 1</option>
                                      <option <?php if ($data['tipe_customer'] == 2) echo "active" ?> value="2">Customer 2</option>
                                      <option <?php if ($data['tipe_customer'] == 3) echo "active" ?> value="3">Customer 3</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Kredit</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" name="kredit" style="width: 50%">
                                      <option <?php if ($data['kredit'] == "Y") echo "active" ?>>Y</option>
                                      <option <?php if ($data['kredit'] == "T") echo "active" ?>>T</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Contact Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="contact_name" value="<?= $data['contact_name'] ?>" required class="form-control" style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Email</label>
                                  <div class="col-sm-9">
                                    <input type="email" name="email" value="<?= $data['email'] ?>" required class="form-control" style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Kode Sales</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="kode_sales" value="<?= $data['kode_sales'] ?>" required class="form-control" style="width: 60%;">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="tab-pane" id="tab_3_<?= $i ?>">
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-3">TOP</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="top" value="<?= $data['top'] ?>" required class="form-control" style="width: 60%;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Batas Kredit</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="batas_kredit" value="<?= $data['batas_kredit'] ?>" required class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Tanggal Jual Akhir</label>
                                  <div class="col-sm-9">
                                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal_jual_akhir'] ?>" style="width: 60%">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Saldo Awal</label>
                                  <div class="col-sm-9">
                                    <input type="number" name="saldo_awal" value="<?= $data['saldo_awal'] ?>" required class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3">Saldo Jalan</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="saldo_jalan" required value="<?= $data['saldo_jalan'] ?>" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="tab-pane" id="tab_4_<?= $i ?>">
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-3">Keterangan</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" name="keterangan" required><?= $data['keterangan'] ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="kode_old" value="<?= $data['kode'] ?>">
                        <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                        <form action="" method="POST">
                          <button name="delete" type="submit" value="<?= $data['kode'] ?>" class="btn btn-danger">Hapus</a>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

              <?php $i++;
              endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>