<?php $role = "manager" ?>

<?php
include '../env.php';

$title = 'Pengajuan Perubahan Harga';
$nomor = $_GET['kode'];
$data = query("SELECT * FROM pengajuan_perubahan_harga WHERE nomor_pengajuan = '$nomor'");
$data = $data[0];
$q = query("SELECT * FROM pph_item WHERE nomor_pengajuan = '$nomor'");
?>
<!-- =============================================== -->
<?php include('../templates/header.php') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengajuan Perubahan Harga
        </h1>
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
                                    <input type="text" class="form-control" name="nomor_pengajuan" value="<?= $data['nomor_pengajuan'] ?>" disabled id="nomorpengajuan" placeholder="Nomor Pengajuan..">
                                </div>
                            </div>

                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label-inline" for="formtanggal">Tanggal</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="date" disabled id="formtanggal" value="<?= $data['tanggal_pengajuan'] ?>" name="tanggal" class="form-control">
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
                                    <select disabled class="form-control" id="tipecustomer_pph" name="tipe_customer">
                                        <option>Customer <?= $data['tipe_customer'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>


                <!-- Main content -->
                <div class="box box-info">
                    <div class="box-body">
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead align="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Item</th>
                                        <th>Harga Jual Lama</th>
                                        <th>Harga Jual Baru</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php $i = 1;
                                    foreach ($q as $res) : extract($res);
                                        $r = query("SELECT * FROM inventory WHERE barcode = '$barcode_inventory'");
                                        $r = $r[0]; ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $barcode_inventory ?></td>
                                            <td><?= $r['nama_barang'] ?></td>
                                            <td><?= $harga_jual_lama ?></td>
                                            <td><?= $harga_jual_baru ?></td>
                                            <td><?= $keterangan ?></td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->

<?php include('../templates/footer.php') ?>