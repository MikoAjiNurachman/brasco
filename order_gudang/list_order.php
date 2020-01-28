<?php $role = "pemasaran" ?>

<?php
require '../env.php';
$title = "List Order ke Gudang";
if (isset($_POST['cari'])) {
    extract($_POST);
    $sql = "SELECT * FROM order_gudang WHERE ";
    if ($customer !== '') {
        $customer = rtrim($customer);
        $sql .= "kode_customer = '$customer' ";
    }
    if ($tanggal !== '') {
        if ($customer !== '') {
            $sql .= " AND ";
        }
        $sql .= "tanggal = '$tanggal'";
    }
    if ($customer == 'sen') {
        $sql = "SELECT * FROM order_gudang ";
    }
    $query = query($sql);
}

?>
<script>
    var active = 'header_order';
    var active_2 = 'header_order_list'
</script>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="box box-primary">
            <div class="">
                <div class="box-header with-border">
                    <h2 class="box-title">LIST ORDER KE GUDANG</h2>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-2 ">Tanggal</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="date" name="tanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class=" col-sm-2">Customer : </label>
                                <div class="col-sm-3">
                                    <select name="customer" class="form-control">
                                        <option value="sen">-- Semua Customer --</option>
                                        <?php
                                        foreach (query("SELECT * FROM customer") as $o) {
                                            echo '<option value="' . $o['kode'] . '" >' . $o['nama'] . '</option>';
                                        }
                                        ?>
                                        <option value="">-- Tidak Pilih Customer --</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="cari" class="btn btn-info">Search</button>
                                </div>
                            </div>
                            <div class="form-group pad">
                                <a href="order_gudang/input_order.php" class="btn btn-primary">Buat order baru</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <?php if (isset($query)) : ?>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="data-table">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No </th>
                                        <th>Tanggal</th>
                                        <th>No Order</th>
                                        <th>No SO</th>
                                        <th>Customer</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                        foreach ($query as $t) : extract($t);
                                            $src = query("SELECT * FROM customer WHERE kode='$kode_customer'")[0]; ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $nomor_order ?></td>
                                            <td><?= $tanggal ?></td>
                                            <td><?= $nomor_so ?></td>
                                            <td><?= $src['nama'] ?></td>
                                            <td><?= $total ?></td>
                                            <td><?= $keterangan ?></td>
                                            <td>
                                                <a title="Edit" href="order_gudang/edit_order.php?nomor=<?= $nomor_order ?>"><i style="color: blue;font-size:24px;" class="fa fa-pencil"></i></a>
                                                <a title="Hapus" onclick="return confirm('Yakin ingin menghapus?')" href="order_gudang/ajax.php?nomor_order=<?= $nomor_order ?>"><i style="color: red;font-size:24px;" class="fa fa-trash"></i></a>
                                                <a title="Detail" target="_blank" href="order_gudang/detail_order.php?nomor=<?= $nomor_order ?>"><i style="color: green;font-size:24px;" class="fa fa-info"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>