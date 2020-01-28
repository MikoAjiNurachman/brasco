<?php $role = "procurement" ?>

<?php
$title = "Data Purchase Order";
require '../env.php';
cekAdmin($role);
$query = "SELECT * FROM purchase_order";

if (isset($_GET['request'])) {
    if ($_GET['request'] == "delete") {
        $kode = $_GET['kode'];
        $query = "DELETE FROM purchase_order WHERE kode = '$kode';";
        $query .= "DELETE FROM purchase_order_item WHERE kode_po ='$kode'";
        $sql = mysqli_multi_query($conn, $query);
        lanjutkan($sql, "Dihapus");
    }
}
if (isset($_POST['submit'])) {
    extract($_POST);
    if ($kode_po !== '') {
        if ($kode_supplier !== '') {
            $query = "SELECT * FROM purchase_order WHERE kode = '$kode_po' AND kode_supplier = '$kode_supplier' AND status = 'Approve'";
        } else {
            $query  = "SELECT * FROM purchase_order WHERE kode = '$kode_po' AND status = 'Approve'";
        }
    }
    if ($kode_supplier !== '' && $kode_po == '') {
        $query = "SELECT * FROM purchase_order WHERE kode_supplier = '$kode_supplier' AND status = 'Approve'";
    }
}

?>
<script>
    var active = 'header_po';
    var active_2 = 'header_purchase_data';
</script>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DATA PURCHASE ORDER
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">DATA PURCHASE ORDER</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <!-- alert -->
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Informasi!</h4>
                    Sebelum membuat PO pastikan sudah membuat kode item di Master Inventory dan kode Suplier di Master Supplier
                </div>
                <!-- /alert -->

                <!-- form -->
                <div class="form-body" style="margin-top: 50px;">
                    <!-- div class md-6 -->
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="POST">
                                <h4 class="mr-5" style="margin-bottom: 30px;">Cari Data PO</h4>
                                <div class="form-group  textbox col-xs-4">
                                    <input type="text" name="kode_po" class="form-control" placeholder="KODE PO">
                                </div>
                                <div class="form-group textbox col-xs-5">
                                    <input type="text" name="kode_supplier" class="form-control" placeholder="Kode Supplier">
                                </div>
                                <div class="col-xs-3">
                                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <!-- div class md-6 -->
                        <div class="col-md-6">
                            <h4 class="text-center" style="margin-bottom: 30px;">Tambah Data PO</h4>
                            <div class="button-add text-center">
                                <a href="purchase_order" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
        </div>
        <?php if (isset($query)) : ?>
            <div class="box box-info">
                <div class="box-body">

                    <!-- datatable -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PO NUMBER</th>
                                <th>Tanggal</th>
                                <th>KODE SUPPLIER</th>
                                <th>STATUS</th>
                                <th>JUMLAH</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sql = query($query);
                            foreach ($sql as $row) :
                                $kode = $row['kode_supplier'];
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $kode ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['total_harga'] ?></td>
                                    <td>
                                        <a href="purchase_order/edit_po.php?kode=<?= $row['kode'] ?>"><i class="fa fa-edit fa-lg" style="color: blue; padding: 5px;"></i></a>
                                        <?php if ($row['status'] == 'Approve') : ?>
                                            <a href="purchase_order/data_purchase_order.php?request=delete&kode=<?= $row['kode'] ?>"><i class="fa fa-trash fa-lg" style="color: red; padding: 5px;"></i></a>
                                            <a href="purchase_order/cetak/cetak_purchase_order.php?kode=<?= $row['kode'] ?>" target="_blank"><i class="fa fa-print fa-lg" style="color: green; padding: 5px;"></i></a>

                                        <?php else : ?>
                                            <a><i class="fa fa-trash fa-lg" style="color: grey; padding: 5px;"></i></a>
                                            <a><i class="fa fa-print fa-lg" style="color: grey; padding: 5px;"></i></a>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php $i++;
                                                                                                        endforeach; ?>
                        </tbody>
                    </table>
                    <!-- datatable -->
                    <div class="button-close pull-right" style="margin-top: 20px;">
                        <a href="#" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>