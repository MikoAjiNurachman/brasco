<?php $role = "pemasaran" ?>

<?php
$title = "List Picking Gudang";
require '../env.php';
$datas =  query("SELECT * FROM picking");
if (isset($_POST['search'])) {
    extract($_POST);
    if ($tanggal == '') {
        if (intval($status) == 1) {
            $sql = "SELECT * FROM picking";
        } else {
            $sql = "SELECT * FROM picking WHERE status = '$status'";
        }
    } else {
        if (intval($status) == 1) {
            $sql = "SELECT * FROM picking WHERE tanggal = '$tanggal'";
        } else {
            $sql = "SELECT * FROM picking WHERE tanggal = '$tanggal' AND status = '$status'";
        }
    }
    $datas = query($sql);
}
?>

<script>
    var active = 'header_picking';
    var active_2 = 'header_picking_list';
</script>
<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="box box-info">
            <div class="">
                <div class="box-header with-border">
                    <h3 class="box-title">LIST PICKING GUDANG</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-1 col-xs-3">Tanggal</label>
                                <div class="col-sm-3 col-xs-3">
                                    <div class="input-group">
                                        <input type="date" id="formtanggal" name="tanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 col-xs-3">Status</label>
                                <div class="col-sm-3 col-xs-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">-- Pilih Status -- </option>
                                        <option>Selesai</option>
                                        <option>Proses</option>
                                        <option value="1">Tidak Tahu</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 col-xs-1">
                                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="picking_gudang/input.php" class="btn btn-info">Picking</a>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-body">
                <div>
                    <div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No </th>
                                        <th>No Pick</th>
                                        <th>No Order</th>
                                        <th>Kode Cust</th>
                                        <th>Qty Order</th>
                                        <th>Qty Pick</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($datas as $data) :
                                        $val = query(sprintf("SELECT * FROM order_gudang WHERE nomor_order = '%s'", $data['nomor_order']))[0];
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $data['nomor_picking'] ?></td>
                                            <td><?= $data['nomor_order'] ?></td>
                                            <td><?= $data['kode_customer'] ?></td>
                                            <td><?= $val['total'] ?></td>
                                            <td><?= $data['total'] ?></td>
                                            <td><?= $data['status'] ?></td>
                                            <td>
                                                <a href="picking_gudang/edit.php?kode=<?= $data['nomor_picking'] ?>" style="color: blue"><span class="fa fa-edit fa-lg"></span></a>&nbsp&nbsp&nbsp
                                                <a href="picking_gudang/cetak.php?kode=<?= $data['nomor_picking'] ?>" target="_blank" style="color: black"><span class="fa fa-print fa-lg"></span></a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $('form').submit((e) => {
        var is = $('#status').children('option:selected').val();
        if (parseInt(is) == 0) {
            alert("Tolong dipilih Statusnya");
            e.preventDefault();
            return false;
        }
    })
</script>

<?php include('../templates/footer.php') ?>