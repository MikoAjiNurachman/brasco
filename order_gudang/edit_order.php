<?php $role = "pemasaran" ?>

<?php
session_start();
require '../env.php';
cekAdmin($role);
$title = "Order ke Gudang";

if (isset($_POST['submit'])) {
    $id = $_SESSION['admin']['id'];
    extract($_POST);
    $data_item = json_decode($data_item, true);
    $sql = "UPDATE order_gudang SET tanggal = '$tanggal',kode_customer = '$kode_customer',nomor_so = '$nomor_so',keterangan = '$keterangan',total = '$total', id_edit_admin = '$id' WHERE nomor_order = '$no_order'; ";
    $sql .= "DELETE FROM order_gudang_item WHERE nomor_order = '$no_order';";
    foreach (array_filter($data_item) as $data) {
        extract($data);
        $sql .= "INSERT INTO order_gudang_item(nomor_order,barcode,quantity,id_admin,id_edit_admin) VALUES('$no_order','$barcode','$quantity','$id','0');";
    }
    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Diedit");
    $return = true;
}
if (isset($_GET['nomor'])) {
    $nomor_order = $_GET['nomor'];
    $data = query("SELECT * FROM order_gudang WHERE nomor_order = '$nomor_order'")[0];
}
?>
<?php if (isset($return)) : ?>
    <script>
        window.stop();
        location.href = 'list_order.php';
    </script>
<?php endif ?>
<script>
    var active = 'header_order';
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
                                        <input type="date" value="<?= $data['tanggal'] ?>" required name="tanggal" class="form-control">
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
                                    <input type="text" class="form-control" value="<?= $data['kode_customer'] ?>" id="kode_customer" name="kode_customer" placeholder="Kode Customer">
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

                <div class="modal fade" id="modal2">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center">Pilih Sales Order</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-data">
                                    <form class="form-horizontal" action="" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-xs-3 control-label">Tanggal</label>
                                                <div class="col-xs-6">
                                                    <div class="input-group">
                                                        <input type="date" id="cari_so_tanggal_val" class="form-control">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" id="cari_so_tanggal" class="btn btn-primary">Cek</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No SO</th>
                                                    <th>Kode Customer</th>
                                                    <th>Qty Order</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cari_so_tabel">
                                                <?php
                                                $i_m1 = 1;
                                                foreach (query("SELECT * FROM sales_order") as $data_so) : $so =  $data_so['nomor_so'];
                                                    ?>
                                                    <tr>
                                                        <td><?= $i_m1 ?></td>
                                                        <td><?= $data_so['nomor_so'];  ?></td>
                                                        <td><?= $data_so['kode_customer'] ?></td>
                                                        <td><?= $data_so['total'] ?></td>
                                                        <td><button type="button" class="btn btn-primary" onclick="cari_so('<?= $so ?>')" data-dismiss="modal">Pilih</button></td>
                                                    </tr>
                                                <?php
                                                    $i_m1++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /. Modal Cari SO -->

            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div style="display: inline-flex">
                                    <input style="margin-right: 20px;" type="text" id="barcode_so" placeholder="Barcode" class="form-control">
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
                                <input type="text" id="quantity" placeholder="Qty" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-6">
                            <div class="form-group">
                                <i style="font-size: 30px;cursor:pointer" id="masuk_data" class="fa fa-plus"></i>
                            </div>
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
                                        <th>
                                            <center>Aksi</center>
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
                                <textarea class="form-control" name="keterangan" required rows="3" placeholder="Keterangan"><?= $data['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pull-right">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="data_item" id="data_item">
                                <button type="submit" name="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</form>


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
                                        '<i style="color: red;cursor:pointer" onclick="so_hapus(' + i + ')" class="fa fa-trash"></i>' + '</td>' +
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
    $('#cari_customer').on('click', function() {
        if ($('#kode_customer').val() == '') {
            alert("Tolong diisi Kode Customernya");
            return;
        }
        $.post('sales_order/ajax.php', {
            request: 'cari_customer',
            data: $('#kode_customer').val()
        }, function(data) {
            data = JSON.parse(data);
            if (data == '') {
                alert('Tidak ditemukan Customer');
                return;
            } else {
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
    $('#cari_barcode').on('click', function() {
        if ($('#barcode_so').val() == '') {
            alert("Tolong diisi Kode Barcodenya");
            return;
        }
        if ($('#nama_cust').val() == '') {
            alert('Tolong diisi dahulu data Customernya');
            return;
        }
        $.post('sales_order/ajax.php', {
            request: 'cari_barcode',
            data: $('#barcode_so').val()
        }, function(data) {
            data = JSON.parse(data);
            if (data == '') {
                alert('Tidak ditemukan Barcode');
                return;
            } else {
                data = data[0];
                sessData.dataB = data;
                if (parseInt(sessData.dataCust.tipe_customer) == 1) {
                    sessData.dataB.harga_jual1 = sessData.dataB.harga_jual1;
                } else if (parseInt(sessData.dataCust.tipe_customer) == 2) {
                    sessData.dataB.harga_jual1 = sessData.dataB.harga_jual2;
                } else if (parseInt(sessData.dataCust.tipe_customer) == 3) {
                    sessData.dataB.harga_jual1 = sessData.dataB.harga_jual3;
                }
                $.post('sales_order/ajax.php', {
                    request: 'cari_satuan',
                    data: data.satuan
                }, function(lel) {
                    lel = JSON.parse(lel)[0];
                    sessData.dataB.satuan = lel.satuan;
                    $('#nama_item').val(data.nama_barang);
                    $('#satuan').val(lel.satuan);
                })
            }
        })


    })
    $('#masuk_data').on('click', function() {
        if ($('#quantity').val() == '' || $('#barcode_so').val() == '' || $('#satuan').val() == '' || $('#nama_item').val() == '') {
            alert('Tolong diisi semua fieldnya');
            return;
        }

        storeData.push({
            'barcode': $('#barcode_so').val(),
            'quantity': $('#quantity').val()
        })
        $('#data_item').val(JSON.stringify(storeData));
        $('#table_so').append(
            '<tr id="tr_so_' + i + '">' +
            '<td id="icr">' + i + '</td>' +
            '<td>' + $('#barcode_so').val() + '</td>' +
            '<td>' + sessData.dataB.nama_barang + '</td>' +
            '<td>' + $('#quantity').val() + '</td>' +
            '<td>' + sessData.dataB.satuan + '</td>' +
            '<td>' + sessData.dataB.harga_jual1 + '</td>' +
            '<td>' + parseInt(sessData.dataB.harga_jual1) * parseInt($('#quantity').val()) + '</td>' +
            '<td>' +
            '<i style="color: red;cursor:pointer" onclick="so_hapus(' + i + ')" class="fa fa-trash"></i>' + '</td>' +
            '</tr>'
        )
        total += parseInt($('#quantity').val());
        $('#total').val(total);
        fix_iteration('#table_so');
        i++;
    })



    function so_hapus(i) {
        $('#tr_so_' + i).remove();
        fix_iteration('#table_so');
        i--;
        var total = parseInt($('#total').val()) - parseInt(storeData[i]['quantity']);
        $('#total').val(total)
        delete storeData[i];
        $('#data_item').val(JSON.stringify(storeData));

    }

    function cari_so(kode) {
        $('#nomor_so').val(kode)
    }
    $('#cari_so_tanggal').on('click', () => {
        var d = $('#cari_so_tanggal_val').val()
        if (d == '') {
            alert('Tanggal tidak boleh kosong!');
            return;
        } else {
            $.post('sales_order/ajax.php', {
                request: 'cari_so',
                data: d
            }, res => {
                res = JSON.parse(res)
                $('#cari_so_tabel').html('');
                res.forEach((data_so, i) => {
                    $('#cari_so_tabel').append(
                        '<tr>' +
                        '<td>' + ++i + '</td>' +
                        '<td>' + data_so.nomor_so + '</td>' +
                        '<td>' + data_so.kode_customer + '</td>' +
                        '<td>' + data_so.total + '</td>' +
                        '<td>' + ' <button type = "button"class = "btn btn-primary "onclick = "cari_so(' + "'" + data_so.nomor_so + "'" + ')" data-dismiss = "modal" > Pilih </button></td >' +
                        '</tr>'
                    )
                })

            })
        }
    })
</script>
<?php include('../templates/footer.php') ?>