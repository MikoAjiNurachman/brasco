<?php $role = "pemasaran" ?>

<?php
require '../env.php';
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $tit = query("SELECT * FROM packing_item WHERE nomor_packing = '$id'");
    $query = '';
    foreach ($tit as $p) {
        $s = $p['id_picking_item'];
        $query .= "UPDATE picking_item SET quantity_packing = '0' WHERE id = '$s';";
    }
    $query .= "DELETE FROM packing WHERE nomor_packing = '$id';";
    $query .= "DELETE FROM packing_item WHERE nomor_packing = '$id';";
    $result = mysqli_multi_query($conn, $query);
    lanjutkan($result, "Dihapus!");
    $return = true;
}
$title = "List Packing Gudang";
$query = query("SELECT * FROM packing");
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $query = query("SELECT * FROM packing WHERE tanggal = '$tanggal'");
}
?>
<?php if (isset($return)) : ?>
    <script>
        window.stop();
        window.location.href = 'list.php';
    </script>
<?php endif; ?>
<script>
    var active = 'header_packing';
    var active_2 = 'header_packing_list';
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
                    <h3 class="box-title">LIST PACKING GUDANG</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="GET">
                        <div class="form-group">
                            <label class="col-sm-1">Tanggal</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="date" name="tanggal" class="form-control">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                        <a href="packing_gudang/input.php" class="btn btn-info">Packing</a>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pack</th>
                                    <th>Kode Cust</th>
                                    <th>Nama Customer</th>
                                    <th>Qty Pack</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($query as $data) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $data['nomor_packing'] ?></td>
                                        <td><?= $data['kode_customer'] ?></td>
                                        <td><?= query(sprintf("SELECT * FROM customer WHERE kode = '%s'", $data['kode_customer']))[0]['nama'] ?></td>
                                        <td><?= $data['total'] ?></td>
                                        <td><a href="packing_gudang/edit.php?nomor=<?= $data['nomor_packing'] ?>"><i class="fa fa-edit fa-lg text-blue"></i></a>

                                            <form action="" method="POST"> <button type="submit" class="btn " name="delete" value="<?= $data['nomor_packing'] ?>"><i class="fa fa-trash fa-lg text-red"></i></button></form>
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

    </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>