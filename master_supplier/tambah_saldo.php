<?php $role = "procurement" ?>

<?php
include '../env.php';
cekAdmin($role);
if (isset($_POST['simpan'])) {
    $search = query("SELECT * FROM supplier_saldo WHERE kode_supplier = '$_POST[kode_supplier]'");
    if (!isset($search[0])) {
        //Data tidak ada, insert

        $sql = "INSERT INTO supplier_saldo(kode_supplier,saldo_awal,saldo_jalan) VALUES('$_POST[kode_supplier]','$_POST[saldo]','$_POST[saldo]')";
        $query = mysqli_query($conn, $sql);
        lanjutkan($query, "ditambahkan!");
    } else {
        //Data ada, update
        alert("Saldo sudah pernah diinput! ");
    }
}
?>

<script>
    var active = 'header_supplier';
    var active_2 = 'header_supplier_tambah_saldo';
</script>

<?php $title = "Tambah Saldo Supplier";
include('../templates/header.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Saldo Supplier</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3">Kode Supplier</label>
                                    <div class="col-sm-7">
                                        <select name="kode_supplier" class="form-control">
                                            <?php foreach (query("SELECT * FROM supplier") as $data) : ?>
                                                <option value="<?= $data['kode'] ?>"><?= $data['kode'] ?> - <?= $data['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3">Saldo</label>
                                    <div class="col-sm-7">
                                        <input type="number" name="saldo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <button class="btn btn-info" name="simpan">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>