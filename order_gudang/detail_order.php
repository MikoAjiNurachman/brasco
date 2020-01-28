<?php $role = "pemasaran" ?>

<?php
require '../env.php';
$title = "Order ke Gudang";

if (isset($_GET['nomor'])) {
    $nomor_order = $_GET['nomor'];
    $data = query("SELECT * FROM order_gudang WHERE nomor_order = '$nomor_order'")[0];
}
?>
<script>
    var active = 'header_sales';
    var active_2 = '';
</script>

<?php include('../templates/header.php') ?>
<form action="" method="POST">

    <div class="content-wrapper">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>ORDER KE GUDANG</h3>
                </div>
                <div class="box-body form-horizontal">
                    <!-- form grid ke 1 -->
                    <div class="col-sm-6">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="date" value="<?= $data['tanggal'] ?>" disabled required name="tanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No Order</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_order" id="no_order" value="<?= $nomor_order ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label class="control-label">Cari SO</label>
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" class="form-control" name="nomor_so" value="<?= $data['nomor_so'] ?>" required readonly id="nomor_so">
                                </div>
                                <div class="col-xs-2">
                                    <a data-toggle="modal" data-target="#modal2" style="cursor : pointer; color: #000;"><i class="fa fa-search fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <p><b>Kirim Ke</b></p>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" value="<?= $data['kode_customer'] ?>" disabled id="kode_customer" name="kode_customer" placeholder="Kode Customer">
                                </div>
                                <div class="col-xs-2">
                                    <i id="cari_customer" class="fa fa-search fa-2x" style="cursor: pointer"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="" readonly id="nama_cust" placeholder="Nama Customer">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <textarea class="form-control" readonly id="alamat_cust" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" readonly id="kota_cust" name="" placeholder="Kota">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" readonly id="telepon_cust" name="" placeholder="No Telepon">
                                </div>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" readonly id="handphone_cust" name="" placeholder="No Handphone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div style="display: inline-flex">
                                    <input style="margin-right: 20px;" disabled type="text" id="barcode_so" placeholder="Barcode" class="form-control">
                                    <i style="font-size: 30px;cursor:pointer" class="fa fa-search" id="cari_barcode"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div>
                                    <input type="text" id="nama_item" readonly placeholder="Nama Item" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <input type="text" id="satuan" readonly placeholder="Satuan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-6">
                            <div class="form-group">
                                <input type="text" id="quantity" disabled placeholder="Qty" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-6">
                        </div>
                    </div>

                    <!-- table -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center ">
                                <thead align="center">
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center>Barcode</center>
                                        </th>
                                        <th>
                                            <center>Nama Item</center>
                                        </th>
                                        <th>
                                            <center>QTY</center>
                                        </th>
                                        <th>
                                            <center>Satuan</center>
                                        </th>
                                        <th>
                                            <center>Harga Jual Satuan</center>
                                        </th>
                                        <th>
                                            <center>Jumlah</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody align="center" id="table_so">
                                    <tr>
                                        <!-- table dari jquery -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="padding-top: 10px;">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" disabled name="keterangan" required rows="3" placeholder="Keterangan"><?= $data['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pull-right">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="data_item" id="data_item">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>


    <script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var sessData = [];
        var storeData = [];
        var i = 1;
        var total = 0;
        $(document).ready(function() {
            $.post('sales_order/ajax.php', {
                request: 'cari_item_gudang',
                data: $('#no_order').val()
            }, function(e) {
                e = JSON.parse(e);
                $.post('sales_order/ajax.php', {
                    request: 'cari_customer',
                    data: $('#kode_customer').val()
                }, cust => {
                    e.forEach(d => {
                        $.post('sales_order/ajax.php', {
                            request: 'cari_barcode',
                            data: d.barcode
                        }, inv => {
                            inv = JSON.parse(inv)[0]
                            if (parseInt(cust.tipe_customer) == 1) {
                                inv.harga_jual1 = inv.harga_jual1;
                            } else if (parseInt(cust.tipe_customer) == 2) {
                                inv.harga_jual1 = inv.harga_jual2;
                            } else if (parseInt(cust.tipe_customer) == 3) {
                                inv.harga_jual1 = inv.harga_jual3;
                            }
                            $.post('sales_order/ajax.php', {
                                request: 'cari_satuan',
                                data: inv.satuan
                            }, lel => {

                                lel = JSON.parse(lel)[0];
                                inv.satuan = lel.satuan;
                                $.post('sales_order/ajax.php', {
                                    request: 'cari_customer',
                                    data: $('#kode_customer').val()
                                }, function(data) {
                                    data = JSON.parse(data);
                                    if (data == '') {
                                        alert('Tidak ditemukan Customer');
                                        return;
                                    } else {
                                        storeData.push({
                                            'barcode': d.barcode,
                                            'quantity': d.quantity
                                        })
                                        $('#data_item').val(JSON.stringify(storeData));
                                        $('#table_so').append(
                                            '<tr id="tr_so_' + i + '">' +
                                            '<td id="icr">' + i + '</td>' +
                                            '<td>' + d.barcode + '</td>' +
                                            '<td>' + inv.nama_barang + '</td>' +
                                            '<td>' + d.quantity + '</td>' +
                                            '<td>' + inv.satuan + '</td>' +
                                            '<td>' + inv.harga_jual1 + '</td>' +
                                            '<td>' + parseInt(inv.harga_jual1) * parseInt(d.quantity) + '</td>' +
                                            '<td>' +
                                            '</tr>'
                                        )
                                        total += parseInt(d.quantity);
                                        $('#total').val(total);
                                        fix_iteration('#table_so');
                                        i++;
                                        data = data[0];
                                        sessData.dataCust = data;
                                        $('#nama_cust').val(data.nama);
                                        $('#alamat_cust').val(data.alamat);
                                        $('#kota_cust').val(data.kota);
                                        $('#telepon_cust').val(data.telepon);
                                        $('#handphone_cust').val(data.handphone);
                                    }
                                })

                            })


                        })

                    });
                })
            })
        })
    </script>
    <?php include('../templates/footer.php') ?>