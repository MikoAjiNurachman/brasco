<?php $role = "manager" ?>

<?php
$title = "Approval Purchase Order Manager";
require '../env.php';
if (isset($_POST['kirim'])) {
    $sql = '';
    $tanggal = $_POST['tanggal'];
    for ($i = 1; $i <= $_POST['total']; $i++) {
        $keterangan_approve = $_POST['keterangan' . $i];
        $status = $_POST['status' . $i];
        $kode = $_POST['kode' . $i];
        $sql .= "UPDATE purchase_order SET tanggal_approve = '$tanggal', keterangan_approve = '$keterangan_approve', status = '$status' WHERE kode = '$kode' ;";
    }
    $query2 = mysqli_multi_query($conn, $sql);
    lanjutkan($query2, "Di Update");
}
if (isset($_POST['submit'])) {
    extract($_POST);
    $t = false;
    $sql = 'SELECT * FROM purchase_order ';
    if ($tanggal !== '') {
        if ($tanggal2 !== '') {
            $sql .= "WHERE tanggal BETWEEN CAST('$tanggal' AS DATE)  AND CAST('$tanggal2' AS DATE) ";
        } else {
            $sql .= "WHERE tanggal = CAST('$tanggal' AS DATE) ";
        }
        $t = true;
    }
    if ($t && $status !== "Semua") {
        $sql .= "AND status = '$status' ";
    }
    if (!$t && $status !== "Semua") {
        $sql .= "WHERE status = '$status'";
    }
    if ($tanggal2 !== '' && $tanggal == '') {
        alert("Tolong diisi tanggal pertamanya");
        $sql = '';
    }
    $query = query($sql);
}

?>
<script>
    var active = 'header_po';
    var active_2 = 'header_purchase_approval';
</script>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Approve Purchase Order
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Laporan PO</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-info pb-4">

            <div class="box-body ">
                <h3 class="text-center">APPROVAL PURCHASE ORDER MANAGER</h3>

                <div class="row" style="margin-top: 40px;">
                    <form method="POST" action="">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Tanggal PO</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="date" name="tanggal" id="formtanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="date" name="tanggal2" id="formtanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Status</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select style="width: auto" name="status" class="form-control">
                                            <option>Semua</option>
                                            <option>Approve</option>
                                            <option>Belum Approve</option>
                                            <option>Reject</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="submit" class="btn btn-info" value="Search">
                        </div>
                    </form>
                </div>


            </div>
            <!-- /.box-footer-->
        </div>
        <?php if (isset($query)) : ?>
            <div class="box box-info">
                <form action="" method="POST">
                    <div class="box-body">
                        <!-- table -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Purchase Order</th>
                                    <th>Tanggal Approve</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <th>Approval</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    foreach ($query as $data) : extract($data); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $kode ?></td>
                                        <td><?= $tanggal ?></td>
                                        <td><?= ($tanggal_approve == '') ? 'Unknown' : $tanggal_approve ?></td>
                                        <td><?= $status ?></td>
                                        <td><a href="purchase_order/lihat_po_manager.php?kode=<?= $kode ?>" target="_blank" class="btn btn-info">Detail</a></td>
                                        <td>
                                            <div class="input-group">
                                                <select style="width: auto" name="status<?= $i ?>" class="form-control">
                                                    <option>Approve</option>
                                                    <option>Reject</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td> <input type="text" name="keterangan<?= $i ?>"></td>
                                        <input type="hidden" name="total" value="<?= $i ?>">
                                        <input type="hidden" name="kode<?= $i ?>" value="<?= $kode ?>">
                                    </tr>
                                <?php $i++;
                                    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                        <button type="submit" name="kirim" class="btn btn-info pull-right mt-2">Save</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>