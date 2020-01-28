<?php $role = "pemasaran" ?>

<?php
$title = "Edit Sales Order";
require '../env.php';
$i = 1;
$kode = $_GET['nomor'];
$myData = query("SELECT * FROM sales_order WHERE nomor_so = '$kode'")[0];
$f = $myData['kode_customer'];
$myDataCustomer = query("SELECT * FROM customer WHERE kode = '$f' ")[0];

cekAdmin($role);
$id_admin = $_SESSION['admin']['id'];

if (isset($_POST['submit'])) {
    
    extract($_POST);
    $data_item = json_decode($data_item, true);
    $sql = "UPDATE sales_order SET nomor_so ='$nomor_so',tanggal_so = '$tanggal',kode_customer = '$kode_customer',keterangan = '$keterangan',total = '$total' WHERE nomor_so = '$nomor_so', id_edit_admin= '$id_admin';";
    $sql .= "DELETE FROM sales_order_item WHERE nomor_so = '$nomor_so';";
    foreach (array_filter($data_item) as $data) {
        extract($data);
        $sql .= "INSERT INTO sales_order_item(nomor_so,barcode,quantity, id_admin, id_edit_admin) VALUES('$nomor_so','$barcode','$quantity','$id_admin', '0');";
    }
    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Diedit");
    echo '<script>window.location.href = "laporanSalesOrder.php"</script>';
}
?>
<script>
    var active = 'header_sales';
    var active_2 = 'header_sales_input';
</script>
<?php include('../templates/header.php') ?>

<div class="content-wrapper">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h1>EDIT SALES ORDER</h1>

        </div>
        <div class="panel-body">
            <form action="" method="POST">
                <!-- 1 -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>KIRIM KE</label>

                        </div>
                    </div>
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Nomor Sales Order :</label>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="nomor_so" id="nomor_so" value="<?= $myData['nomor_so'] ?>" required class="form-control">

                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div style="display: inline-flex;">
                                <input style="margin-right: 20px" type="text" value="<?= $myData['kode_customer'] ?>" name="kode_customer" id="kode_customer" placeholder="Kode Customer" class="form-control">
                                <i style="font-size: 30px;cursor:pointer;" class="fa fa-search" id="cari_customer"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tanggal Sales Order :</label>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="display: inline-flex;">
                                <input style="margin-right: 20px" required type="date" value="<?= $myData['tanggal_so'] ?>" name="tanggal" class="form-control">
                                <i style="font-size: 30px" class="fa fa-calendar"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly id="nama" placeholder="Nama Customer" value="<?= $myDataCustomer['nama'] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly id="alamat" placeholder="Alamat" value="<?= $myDataCustomer['alamat'] ?>" style="font-size: 14px;" class="form-control input-lg">
                        </div>
                    </div>
                </div>
                <!-- 5 -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" value="<?= $myDataCustomer['kota'] ?>" id="kota" readonly placeholder="Kota" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" id="no_telepon" readonly value="<?= $myDataCustomer['telepon'] ?>" placeholder="No Telepon" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" id="handphone" readonly value="<?= $myDataCustomer['handphone'] ?>" placeholder="No Handphone" class="form-control">

                        </div>
                    </div>
                </div>
                <div style="border-bottom: 1px solid black; margin-bottom: 20px"></div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="display: inline-flex;">
                                <input style="margin-right: 20px" type="text" id="barcode_so" placeholder="Barcode" class="form-control">
                                <i style="font-size: 30px;cursor:pointer" class="fa fa-search" id="cari_barcode"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" id="nama_item" readonly placeholder="Nama Item" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" id="satuan" readonly placeholder="Satuan" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" id="quantity" placeholder="Qty" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <i style="font-size: 30px;cursor:pointer" id="masuk_data" class="fa fa-plus"></i>

                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px">

                    <table class="table table-bordered ">
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

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="keterangan" value="<?= $myData['keterangan'] ?>" required class="form-control input-lg " placeholder="KETERANGAN">

                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="data_item" id="data_item">
                            <button class="btn btn-primary pull-right" type="submit" name="submit">Edit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    var sessData = [];
    var storeData = [];
    var i = 1;
    var total = 0;
    $(document).ready(function() {
        $.post('sales_order/ajax.php', {
            request: 'cari_item',
            data: $('#nomor_so').val()
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
                $('#nama').val(data.contact_name);
                $('#alamat').val(data.alamat);
                $('#kota').val(data.kota);
                $('#no_telepon').val(data.telepon);
                $('#handphone').val(data.handphone);
            }
        })
    })
    $('#cari_barcode').on('click', function() {
        if ($('#barcode_so').val() == '') {
            alert("Tolong diisi Kode Barcodenya");
            return;
        }
        if ($('#nama').val() == '') {
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
        total = parseInt(total) - parseInt(storeData[i].quantity)
        $('#total').val(total);
        delete storeData[i];
        $('#data_item').val(JSON.stringify(storeData));

    }
</script>
<?php include('../templates/footer.php') ?>