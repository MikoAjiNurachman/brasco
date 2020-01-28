<?php $role = "procurement" ?>

<?php
require '../env.php';
cekAdmin($role);
if (isset($_POST['submit'])) {
    extract($_POST);
    $id_admin = $_SESSION['admin']['id'];
    $sql = "UPDATE purchase_order SET kode = '$kode',tanggal = '$tanggal',kode_supplier ='$kode_supplier',nama_supplier = '$nama_supplier',alamat_supplier = '$alamat_supplier',nama = '$nama',alamat = '$alamat',kota = '$kota',kodepos = '$kodepos',telepon = '$telepon',handphone = '$handphone',dpp ='$dpp',tipe_ppn = '$tipe_ppn',tipe_ppn_input = '$tipe_ppn_teks',total_harga = '$total_harga',keterangan = '$keterangan', id_edit_admin = '$id_admin' WHERE kode = '$kode'; ";
    $sql .= "DELETE FROM purchase_order_item WHERE kode_po = '$kode';";
    $sql .= "DELETE FROM label_barcode WHERE kode_po = '$kode';";

    $data_po = json_decode($data_po);
    $data_po = array_filter($data_po);
    foreach ($data_po as $data) {
        $data = (array) $data;
        extract($data);
        $sql .= "INSERT INTO purchase_order_item(kode_po,barcode_inventory,kode_item_supplier,nama_inventory,quantity,harga_satuan,satuan) VALUES('$kode','$barcode','$kode_item_supplier','$nama_item','$quantity','$harga','$satuan'); ";
    }
    $dataLabel = json_decode($dataLabel);
    $dataLabel = array_filter($dataLabel);
    foreach ($dataLabel as $data) {
        $data = (array) $data;
        extract($data);
        $sql .= "INSERT INTO label_barcode(kode_po,barcode,harga,keterangan,quantity) VALUES ('$kode','$barcode','$harga','$keterangan','$quantity');";
    }
    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Diedit");
    echo "<script> document.location.href = 'data_purchase_order.php'</script>";
}
$data = query("SELECT * FROM inventory");
$kode = $_GET['kode'];
$query = "SELECT * FROM purchase_order WHERE kode ='$kode'";
$var = query($query)[0];
$kode_supp = $var['kode_supplier'];
$supplier = query("SELECT * FROM supplier WHERE kode='$kode_supp'")[0];
$title = 'Edit Purchase Order';
?>
<script>
    var dataSimpan = {
        'buat_po': false,
        'i': 1,
        'satuan': '',
        'total': 0
    };
    var active = 'header_po';
    var active_2 = 'header_purchase_order';
    var simpanArray = [];
</script>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Purchase Order
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <h3 class="header text-center">PURCHASE ORDER <span><a href="purchase_order/cetak/cetak_label_barcode.php?kode=<?= $kode ?>" class="btn btn-primary pull-right" target="_blank">Print Label Barcode</a></span></h3>
                <!-- form -->
                <input type="hidden" id="kode" value="<?= $_GET['kode'] ?>">
                <div class="form-body" style="margin-top: 20px;">
                    <form action="" method="POST">
                        <!-- div class md-6 -->
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 39px;">
                                <div class="form-group ">
                                    <input type="text" value="<?= $var['kode'] ?>" name="kode" readonly id="kode" class="form-control" placeholder="KODE PO">
                                </div>
                                <div class="form-group textbox">
                                    <input type="date" name="tanggal" value="<?= $var['tanggal'] ?>" class="form-control" placeholder="TANGGAL PO">
                                </div>
                                <div class="kode-nama">
                                    <div class="row">
                                        <div class="textbox col-xs-5">
                                            <input type="text" value="<?= $supplier['kode'] ?>" name="kode_supplier" id="kode_supplier" class="form-control" placeholder="KODE SUPPLIER">
                                        </div>
                                        <div class="textbox col-xs-6">
                                            <input type="text" readonly name="nama_supplier" value="<?= $supplier['nama'] ?>" id="nama_supplier" class="form-control" placeholder="NAMA SUPPLIER">
                                        </div>
                                        <div class="col-xs-1">
                                            <i id="cari_supplier_po" style="cursor:pointer" class="fa fa-search fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="textbox form-group" style="margin-top: 15px;">
                                    <textarea class="form-control" id="alamat_supplier" readonly rows="3" name="alamat_supplier" placeholder="ALAMAT"><?= $supplier['alamat'] ?></textarea>
                                </div>
                            </div>
                            <!-- div class md-6 -->
                            <div class="col-md-6">
                                <h4 class="mr-5">DIKIRIM KE</h4>
                                <div class="form-group textbox">
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="NAMA" value="<?= $var['nama'] ?>">
                                </div>
                                <div class="textbox form-group" style="margin-top: 15px;">
                                    <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="ALAMAT"><?= $var['alamat'] ?></textarea>
                                </div>
                                <div class="kota-kode">
                                    <div class="row">
                                        <div class="textbox col-xs-8">
                                            <input type="text" name="kota" id="kota" class="form-control" placeholder="KOTA" value="<?= $var['kota'] ?>">
                                        </div>
                                        <div class="textbox col-xs-4">
                                            <input type="text" name="kodepos" id="kodepos" class="form-control" placeholder="KODE POS" value="<?= $var['kodepos'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="nomer" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="textbox col-xs-6">
                                            <input type="text" name="telepon" id="telepon" class="form-control" placeholder="NO TELEPON" value="<?= $var['telepon'] ?>">
                                        </div>
                                        <div class="textbox col-xs-6">
                                            <input type="text" name="handphone" id="handphone" class="form-control" placeholder="NO HANDPHONE" value="<?= $var['handphone'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <hr>
                <!-- /form end -->

                <div class="form bawah">
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="text" name="barcode" id="barcode_po" class="form-control" placeholder="BARCODE">
                        </div>
                        <div class="col-xs-2">
                            <input type="number" name="kode_item_supplier" id="kode_item_supplier" class="form-control" placeholder="KODE ITEM SUPPLI">
                        </div>
                        <div class="col-xs-3">
                            <input type="number" readonly class="form-control" name="nama_item" id="nama_item" placeholder="NAMA ITEM">
                        </div>
                        <div class="col-xs-2">
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="QTY ORDER">
                        </div>
                        <div class="col-xs-2">
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="HARGA SATUAN">
                        </div>
                        <div class="col-xs-1">
                            <i class="fa fa-plus fa-2x" id="tambah_data_po" style="margin-top: 5px; cursor:pointer"></i>
                        </div>
                    </div>
                </div>

                <!-- data table -->
                <div class="table-data">
                    <table id="" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Item Supplier</th>
                                <th>Nama Item</th>
                                <th>QTY order</th>
                                <th>Sat</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table_po">
                        </tbody>
                    </table>
                </div>
                <!-- /data table -->

                <div class="form-no2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="keterangan" value="<?= $var['keterangan'] ?>" class="form-control" placeholder="KETERANGAN" style="width: 70%;">
                            </div>
                            <div class="form-group">
                                <a href="#labelbarcode" type="button" class="btn btn-info" data-toggle="modal">Label Barcode</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">DPP</label>
                                <div class="col-sm-8">
                                    <input type="number" id="dpp" name="dpp" class="form-control" value="<?= $var['dpp'] ?>">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 50px;">
                                <label class="col-sm-4 control-label">Tipe PPN</label>
                                <div class="col-sm-4 radio">
                                    <label>
                                        <input type="radio" <?php if ($var['tipe_ppn'] == 'T') echo 'checked' ?> name="tipe_ppn" id="tipe_ppn_t" value="T">
                                        T
                                    </label>
                                    <label>
                                        <input type="radio" <?php if ($var['tipe_ppn'] == 'I') echo 'checked' ?> name="tipe_ppn" id="tipe_ppn_i" value="I">
                                        I
                                    </label>
                                    <label>
                                        <input type="radio" <?php if ($var['tipe_ppn'] == 'E') echo 'checked' ?> name="tipe_ppn" id="tipe_ppn_e" value="E">
                                        E
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly id="ppn" name="tipe_ppn_teks" class="form-control" value="<?= $var['tipe_ppn_input'] ?>">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 100px;">
                                <label class="col-sm-4 control-label">Total</label>
                                <div class="col-sm-8">
                                    <input type="text" id="total" name="total_harga" readonly class="form-control" value="<?= $var['total_harga'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- button -->
                    <div class="form-group tombol pull-right" style="margin-top: 20px;">
                        <input type="hidden" name="data_po" id="data_po">
                        <input type="submit" name="submit" class="btn btn-primary" value="Save">
                    </div>
                    <!-- Modal Start -->
                    <div class="modal fade" id="labelbarcode">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Label Barcode</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">
                                        <div class="col-sm-2">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <select id="barcode_label" class="form-control select2 ">
                                                        <?php foreach ($data as $val) : ?>
                                                            <option value="<?= $val['barcode'] ?>"><?= $val['barcode'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="number" id="quantity_label" class="form-control" placeholder="Qty">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="number" id="harga_jual_label" class="form-control" placeholder="Harga Jual">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="text" id="keterangan_label" class="form-control" placeholder="Keterangan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="box-body">
                                                <i id="label_barcode_input" class="fa fa-plus fa-2x" style="padding-top: 5px; cursor:pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="data-table table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Barcode</th>
                                                        <th>Qty</th>
                                                        <th>Harga Jual</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table2">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal End -->
                    <!-- /button -->
                    <input type="hidden" name="dataLabel" id="dataLabel">
                    </form>
                </div>

            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    var dataSimpan = {
        'buat_po': false,
        'i': 1,
        'satuan': '',
        'total': 0,
        'label': 0
    };
    var simpanLabel = []
    var simpanArray = [];

    $('#barcode_label').change(() => {
        var barcode = document.getElementById('barcode_label').value;
        dataSimpan.barcodeLabel = barcode
    })

    $('#label_barcode_input').click(() => {
        var quantity = $('#quantity_label').val()
        var harga = $('#harga_jual_label').val()
        var keterangan = $('#keterangan_label').val()
        if (quantity == '' || harga == '' || keterangan == '') {
            alert('Tolong diisi datanya!');
            return false;
        } else {
            var save = {
                'barcode': dataSimpan.barcodeLabel,
                'harga': harga,
                'keterangan': keterangan,
                'quantity': quantity
            }
            $.post('purchase_order/ajax.php', {
                request: 'cari_barcode',
                data: dataSimpan.barcodeLabel
            }, (datas) => {
                datas = JSON.parse(datas);
            })
            simpanLabel.push(save)
            $('#table2').append(
                `<tr id="tr_${dataSimpan.label}">
                    <td>${save.barcode}</td>
                    <td>${save.quantity}</td>
                    <td>${save.harga}</td>
                    <td>${save.keterangan}</td>
                    <td><button class="btn btn-danger" onclick="labelDelete(${dataSimpan.label})">Hapus</button></td>
                </tr>
                `
            )
            dataSimpan.label++
            $('#dataLabel').val(JSON.stringify(simpanLabel));
        }
    })

    function labelDelete(id) {
        $('#tr_' + id).remove()
        delete simpanLabel[id]
        $('#dataLabel').val(JSON.stringify(simpanLabel));

    }


    $(document).ready(function() {
        var kodeku = $('#kode').val();
        var barcode = document.getElementById('barcode_label').value;
        dataSimpan.barcodeLabel = barcode
        $.post('purchase_order/ajax.php', {
            request: 'data_label',
            kode: kodeku
        }, function(data) {
            data = JSON.parse(data);
            data.forEach(val => {
                var save = {
                    'id': val.id,
                    'barcode': val.barcode,
                    'harga': val.harga,
                    'keterangan': val.keterangan,
                    'quantity': val.quantity
                }
                simpanLabel.push(save)
                $('#table2').append(
                    `<tr id="tr_${dataSimpan.label}">
                    <td>${save.barcode}</td>
                    <td>${save.quantity}</td>
                    <td>${save.harga}</td>
                    <td>${save.keterangan}</td>
                    <td><button class="btn btn-danger" onclick="labelDelete(${dataSimpan.label})">Hapus</button></td>
                </tr>
                `
                )
                dataSimpan.label++
                $('#dataLabel').val(JSON.stringify(simpanLabel));
            })

        })
        $.post('purchase_order/ajax.php', {
            request: 'data_po',
            kode: kodeku,
        }, function(data) {
            data = JSON.parse(data);
            for (var x in data) {
                $('#table_po').append(
                    '<tr id="tr_po_' + dataSimpan.i + '">' +
                    '<td>' + dataSimpan.i + '</td>' +
                    '<td>' + data[x].barcode_inventory + '</td>' +
                    '<td>' + data[x].kode_item_supplier + '</td>' +
                    '<td>' + data[x].nama_inventory + '</td>' +
                    '<td>' + data[x].quantity + '</td>' +
                    '<td>' + data[x].satuan + '</td>' +
                    '<td>' + data[x].harga_satuan + '</td>' +
                    '<td>' + parseInt(data[x].quantity) * parseInt(data[x].harga_satuan) + '</td>' +
                    '<td>' + '<button type="button" onclick="po_hapus(' + dataSimpan.i + ')" class="btn btn-danger"> Hapus</button>' + '</td>' +
                    '</tr>'
                );
                simpanArray.push({
                    'barcode': data[x].barcode_inventory,
                    'kode_item_supplier': data[x].kode_item_supplier,
                    'nama_item': data[x].nama_inventory,
                    'quantity': data[x].quantity,
                    'harga': data[x].harga_satuan,
                    'satuan': data[x].satuan
                })
                dataSimpan.i++;
                dataSimpan.total += parseInt(data[x].quantity) * parseInt(data[x].harga_satuan);
                $('#data_po').val(JSON.stringify(simpanArray));
            }

        })

    })
    $('#buat_po').on('click', function() {
        dataSimpan.buat_po = true;
        $.post('purchase_order/ajax.php', {
            request: 'data_inventory'
        }, function(data) {
            data = JSON.parse(data);
            $('#nama').val(data.nama_cabang);
            $('#alamat').val(data.alamat);
            $('#kota').val(data.kota);
            $('#kodepos').val(data.kodepos);
            $('#telepon').val(data.no_telp);
            $('#handphone').val(data.no_hp);
        })
        $.post('purchase_order/ajax.php', {
            request: 'kode_po'
        }, function(data) {
            data = JSON.parse(data);
            $('#kode').val(data);
        })
    })

    $('#cari_supplier_po').on('click', function() {
        if ($('#kode_supplier').val() == '') {
            alert('Tolong diisi Kode Suppliernya');
            return;
        }
        $.post('purchase_order/ajax.php', {
            request: 'data_supplier',
            data: $('#kode_supplier').val()
        }, function(data) {
            data = JSON.parse(data);
            $('#nama_supplier').val(data.nama);
            $('#alamat_supplier').val(data.alamat);
        })
    })

    $('#tambah_data_po').on('click', function() {
        $.post('purchase_order/ajax.php', {
            request: 'cari_satuan',
            data: dataSimpan.satuan
        }, function(data) {
            data = JSON.parse(data);
            console.log(data.satuan);
            dataSimpan.sata = data.satuan;

            var barcode = $('#barcode_po').val();
            var kode_item_supplier = $('#kode_item_supplier').val();
            var nama_item = $('#nama_item').val();
            var quantity = $('#quantity').val();
            var harga = $('#harga').val();
            if (barcode == '' || kode_item_supplier == '' || nama_item == '' || quantity == '' || harga == '') {
                alert('Tolong diisi semua');
                return;
            }
            simpanArray.push({
                'barcode': barcode,
                'kode_item_supplier': kode_item_supplier,
                'nama_item': nama_item,
                'quantity': quantity,
                'harga': harga,
                'satuan': dataSimpan.satuan
            })

            $('#table_po').append(
                '<tr id="tr_po_' + dataSimpan.i + '">' +
                '<td>' + dataSimpan.i + '</td>' +
                '<td>' + barcode + '</td>' +
                '<td>' + kode_item_supplier + '</td>' +
                '<td>' + nama_item + '</td>' +
                '<td>' + quantity + '</td>' +
                '<td>' + dataSimpan.sata + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + parseInt(quantity) * parseInt(harga) + '</td>' +
                '<td>' + '<button type="button" onclick="po_hapus(' + dataSimpan.i + ')" class="btn btn-danger"> Hapus</button>' + '</td>' +
                '</tr>'
            );
            cek_tipe_ppn();
            dataSimpan.i++;
            dataSimpan.total += (parseInt(quantity) * parseInt(harga));
            $('#total').val(dataSimpan.total);
            $('#data_po').val(JSON.stringify(simpanArray));
        })
    })

    function cek_tipe_ppn() {
        var ppn = 0;
        var dpp = parseInt($('#dpp').val());
        if ($('#tipe_ppn_t').is(':checked')) {
            ppn = 0;
            $('#ppn').val(ppn);
        }
        if ($('#tipe_ppn_i').is(':checked')) {
            dpp = dpp * (10 / 11);
            ppn = dpp * (10 / 100);
            $('#ppn').val(parseFloat(ppn).toFixed(2));
        }
        if ($('#tipe_ppn_e').is(':checked')) {
            ppn = dpp * (10 / 100);
            $('#ppn').val(parseFloat(ppn).toFixed(2));
        }
        return ppn;
    }
    $('#tipe_ppn_t').on('click', function() {
        if ($('#dpp').val() == '') alert('Tolong diisi DPP nya');
        var ppn = cek_tipe_ppn();
        var p = parseFloat(dataSimpan.total) - ppn;
        $('#total').val(parseFloat(p).toFixed(2));
    });
    $('#tipe_ppn_i').on('click', function() {
        if ($('#dpp').val() == '') alert('Tolong diisi DPP nya');

        var ppn = cek_tipe_ppn();
        var p = parseFloat(dataSimpan.total) - ppn;
        $('#total').val(parseFloat(p).toFixed(2));
    });
    $('#tipe_ppn_e').on('click', function() {
        if ($('#dpp').val() == '') alert('Tolong diisi DPP nya');

        var ppn = cek_tipe_ppn();
        var p = parseFloat(dataSimpan.total) - ppn;
        $('#total').val(parseFloat(p).toFixed(2));
    });

    function po_hapus(id) {
        $('#tr_po_' + id).remove();
        id--;
        var total = parseInt(simpanArray[id].quantity) * parseInt(simpanArray[id].harga);
        dataSimpan.total = parseInt(dataSimpan.total) - parseInt(total);
        $('#total').val(dataSimpan.total);
        delete simpanArray[id];
        $('#data_po').val(JSON.stringify(simpanArray));


    }
    $('#barcode_po').keyup(delayTimes(function() {
        var barcode = $('#barcode_po').val();
        $.post('purchase_order/ajax.php', {
            request: 'cari_barcode',
            data: String(barcode)
        }, function(data) {
            data = JSON.parse(data);
            $('#nama_item').val(data.nama_barang);
            dataSimpan.satuan = data.satuan;
        })
    }, 500));

    function delayTimes(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
</script>
<?php include('../templates/footer.php') ?>