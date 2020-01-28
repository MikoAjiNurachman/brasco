<?php $role = "procurement" ?>

<?php
require '../env.php';
cekAdmin($role);
$id_admin = $_SESSION['admin']['id'];
$no_retur1 = query("SELECT * FROM counter WHERE tabel = 'retur_pembelian_barang'")[0];
$see = intval($no_retur1['digit']) + 1;
$no_retur = $no_retur1['header'] . "-" . $see;
if (isset($_POST['simpan'])) {
    extract($_POST);
    $total = 0;
    $sql = "INSERT INTO retur_pembelian_barang(nomor_retur,nomor_invoice,tanggal,kode_supplier,keterangan,id_admin, id_edit_admin) VALUES(
        '$nomor_retur',
        '$nomor_invoice',
        '$tanggal', 
        '$kode_supplier',
        '$keterangan_transaksi',
        '$id_admin',
        '0'
    );";
    $sql .= PHP_EOL;
    $digit = explode('-', $nomor_retur)[1];
    $sql .= "UPDATE counter SET digit = '$digit' WHERE tabel = 'retur_pembelian_barang';";
    $sql .= PHP_EOL;
    foreach ($_POST['data'] as $my) {
        $my = json_decode($my, true);
        extract($my);
        $id_admin = $_SESSION['admin']['id'];
        $sql .= "INSERT INTO retur_pembelian_barang_item(nomor_retur,barcode,jumlah,keterangan,id_admin, id_edit_admin) VALUES(
            '$nomor_retur',
            '$barcode',
            '$jumlah',
            '$keterangan',
            '$id_admin',
            '0'
        );";
        $sql .= PHP_EOL;
        $inven = query("SELECT * FROM inventory WHERE barcode = '$barcode' ")[0];
        $hpp = intval($inven['harga_beli']) * intval($jumlah);
        $sql .= "INSERT INTO intrn(tanggal,kode_item,quantity,satuan,harga_beli,hpp,harga_jual,discount,keterangan,tipe_transaksi,kode_user) VALUES(
            '$tanggal',
            '$barcode',
            '$jumlah',
            '$inven[satuan]',
            '$inven[harga_beli]',
            '$hpp',
            '0',
            '0',
            'Retur Barang Pembelian',
            'RB',
            '$id_admin'
        );";
        $sql .= PHP_EOL;
        $quantity_selisih = intval($inven['quantity']) - intval($jumlah);
        $sql .= "UPDATE inventory SET quantity = '$quantity_selisih' WHERE barcode = '$barcode';";
        $sql .= PHP_EOL;

        $total += intval($jumlah);
    }
    $jurnal = query("SELECT * FROM jurnal_referensi")[0];
    $hutang = $jurnal['hutang'];
    $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,kredit,keterangan,tanggal,userid,useredit) VALUES(
        '$nomor_retur',
        '1',
        '$hutang',
        '0'
        '$total',
        'Hutang Retur Barang Pembelian',
        '$tanggal',
        '$id_admin',
        '0'
    );";
    $sql .= PHP_EOL;
    $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,kredit,keterangan,tanggal,userid,useredit) VALUES(
        '$nomor_retur',
        '2',
        '0',
        '$hutang',
        '$total',
        'Persediaan Retur Barang Pembelian',
        '$tanggal',
        '$id_admin',
        '0'
    );";
    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "dibuat!");
}
?>
<?php $title = 'Retur Pembelian Barang' ?>
<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Form Return Purchasing
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <form action="" method="POST" class="form-horizontal">
        <section class="content">

            <!-- Default box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Retur Pembelian Barang</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <h2>RETUR PEMBELIAN BARANG</h2>
                    <div class="form">
                        <div class="box-body">
                            <p class="pad bg-info">Data Transaksi</p>
                            <div class="form-group">
                                <label class="col-sm-2">No. Retur</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nomor_retur" readonly value="<?= $no_retur ?>">
                                </div>
                                <label class="col-sm-2 control-label">No. Invoice</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nomor_invoice" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Tanggal Retur</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="date" name="tanggal" id="formtanggal" class="form-control" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Supplier</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_supplier" readonly id="kode_supplier" required>
                                </div>
                                <label></label>
                                <div class="col-sm-3">
                                    <input type="text" id="nama_supplier" class="form-control" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <i class="fa fa-search fa-2x" style="cursor:pointer" data-toggle="modal" data-target="#supplier"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" name="keterangan_transaksi" required></textarea>
                                </div>
                            </div>

                            <p class="pad bg-info">Input Barang</p>
                            <div class="form-group">
                                <label class="col-sm-2">Barcode</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" readonly id="barcode">
                                </div>
                                <label></label>
                                <div class="col-sm-1">
                                    <a class="btn btn-info" data-toggle="modal" data-target="#labelbarcode">Cari Barcode</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Jumlah</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="jumlah_barcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" id="keterangan_barcode"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button class="btn btn-info pull-right" type="button" id="submit_barcode">Add</button>
                                </div>
                            </div>
                        </div>

                        <!-- modal supplier -->
                        <div class="modal fade" id="supplier">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Kode Supplier</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example1" class="table table-striped table-bordered">
                                            <thead>
                                                <th>No</th>
                                                <th>Nama Supplier</th>
                                                <th>Saldo Jalan</th>
                                                <th>Contact Name</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                foreach (query("SELECT * FROM supplier") as $data) : ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $data['nama'] ?></td>
                                                        <td>Rp. <?= $data['saldo_jalan'] ?></td>
                                                        <td><?= $data['contact_name'] ?></td>
                                                        <td><button class="btn btn-primary" onclick="supplier('<?= $data['kode'] ?>')" data-dismiss="modal">Pilih</button></td>
                                                    </tr>
                                                <?php $i++;
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal barcode -->
                        <div class="modal fade" id="labelbarcode">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Barcode</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example3" class="table table-striped table-bordered">
                                            <thead>
                                                <th>Barcode</th>
                                                <th>Nama Barang</th>
                                                <th>Quantity</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                foreach (query("SELECT * FROM inventory") as $data) : ?>
                                                    <tr>
                                                        <td><?= $data['barcode'] ?></td>
                                                        <td><?= $data['nama_barang'] ?></td>
                                                        <td><?= $data['quantity'] ?></td>
                                                        <td><button class="btn btn-primary" data-dismiss="modal" onclick=" inventory('<?= $data['barcode'] ?>',this)">Pilih</button></td>
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

                    <div class="data-table">
                        <h4>DAFTAR BARANG</h4>
                        <!-- <div class="button" style="padding-bottom: 10px;">
                        <button class="btn btn-default">Copy</button>
                        <button class="btn btn-default">CSV</button>
                        <button class="btn btn-default">Excel</button>
                        <button class="btn btn-default">PDF</button>
                        <button class="btn btn-default">Print</button>
                    </div> -->

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Barcode</th>
                                    <th>Nama Item</th>
                                    <th>Keterangan Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody id="table_barang">
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-info" type="submit" name="simpan">Save</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
    </form>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= jquery() ?>
<script>
    var active = 'header_retur';
    var link = "retur_pembelian_barang/ajax.php";

    function supplier(kode) {
        $.get(link, {
                request: 'data_supplier',
                'kode': kode

            },
            res => {
                res = JSON.parse(res)
                $('#kode_supplier').val(res.kode)
                $('#nama_supplier').val(res.nama)

            }
        )
    }
    $('#submit_barcode').click(() => {
        if ($('#jumlah_barcode').val() == '' || $('#keterangan_barcode').val() == '' || $('#barcode').val() == '') {
            alert("Tolong diisi semua datanya!");
            return false;
        } else {
            $.get(link, {
                request: 'data_inventory_dengan_satuan',
                data: $('#barcode').val()
            }, res => {
                res = JSON.parse(res);
                res.keterangan = $('#keterangan_barcode').val();
                res.jumlah = $('#jumlah_barcode').val();
                $('#table_barang').append(
                    `<tr>
                        <td>${res.barcode}</td>
                        <td>${res.nama_barang}</td>
                        <td>${$('#keterangan_barcode').val()}</td>
                        <td>${$('#jumlah_barcode').val()}</td>
                        <td>${res.satuan}</td>
                        <td><i onclick="deleteTable(this)" style="cursor:pointer" class="fa fa-trash text-red fa-lg"></i></td>
                        <input type="hidden" name="data[]" value='${JSON.stringify(res)}'>
                    </tr>`);
                $('#jumlah_barcode').val('')
                $('#keterangan_barcode').val('')
                $('#barcode').val('')
            })
        }

    })

    function deleteTable(res) {
        $(res).parent().parent().remove()
    }

    function inventory(barcode, thiss) {
        $.get(link, {
            request: 'data_inventory',
            data: barcode
        }, res => {
            res = JSON.parse(res);
            $('#barcode').val(res.barcode);
        })
    }
</script>
<?php include('../templates/footer.php') ?>