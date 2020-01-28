<?php $role = "procurement" ?>

<?php
require '../env.php';
$title = 'Detail Barang';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item = query("SELECT * FROM purchasing_item WHERE id = '$id' ")[0];
    $kode = $item['kode_pu'];
    $barcode = $item['barcode'];
    $purchasing = query("SELECT * FROM purchasing WHERE kode = '$kode' ")[0];
    $inventory = query("SELECT * FROM inventory WHERE barcode = '$barcode'")[0];
    $se = $inventory['satuan'];
    $satuan = query("SELECT * FROM satuan WHERE id = '$se'")[0]['satuan'];
} else {
    header('Location: laporan_pu.php?err=1');
}
?>
<script>
    var active = 'header_purchasing';
</script>

<?php include('../templates/header.php') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detail List Barang Masuk</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class=" col-xs-5">Nomor Terima Barang</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $item['kode_pu'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Barcode</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $item['barcode'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Nama Item</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $inventory['nama_barang'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Tanggal Terima</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $purchasing['tanggal_terima'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Jumlah Terima</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $item['quantity_terima'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Satuan</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $satuan ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Nama Penerima</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $purchasing['diterima_oleh'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Kode Supplier Asal</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $purchasing['kode_supplier'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class=" col-xs-5">Harga Beli</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= intval($item['quantity_terima']) * intval($item['harga_satuan']) ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Harga Jual 1</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $inventory['harga_jual1'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Harga Jual 2</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $inventory['harga_jual2'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-xs-5">Harga Jual 3</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" disabled value="<?= $inventory['harga_jual3'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-info" onclick="javascript:window.close()">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include('../templates/footer.php') ?>