<?php $role = "pemasaran" ?>

<?php
$title = "Input Sales Order";
if (isset($_POST['submit'])) {
    require '../env.php';
    cekAdmin($role);
    $id_admin = $_SESSION['admin']['id'];
    

    extract($_POST);
    $data_item = json_decode($data_item, true);
    $sql = "INSERT INTO sales_order(nomor_so, tanggal_so, kode_customer, keterangan, total, id_admin, id_edit_admin) VALUES('$nomor_so', '$tanggal','$kode_customer','$keterangan','$total', '$id_admin', '0'); ";
    foreach (array_filter($data_item) as $data) {
        extract($data);
        $sql .= "INSERT INTO sales_order_item(nomor_so,barcode,quantity, id_admin, id_edit_admin) VALUES('$nomor_so','$barcode','$quantity', '$id_admin', '0');";
    }
    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Ditambahkan");
}
?>

<script>
    var active = 'header_sales';
    var active_2 = 'header_sales_input';
</script>

<?php include('../templates/header.php') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header text-center">
                <h3>INPUT SALES ORDER</h3>

            </div>
            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal">

                    <!-- form grid ke 1 -->
                    <div class="col-sm-6">
                        <div class="box-body">
                            <h5><b>KIRIM KE</b></h5>
                            <div class="form-group">
                                <div style="display: inline-flex">
                                    <input style="margin-right: 20px;" type="text" name="kode_customer" id="kode_customer" placeholder="Kode Customer" class="form-control">
                                    <i style="font-size: 30px; cursor:pointer;" class="fa fa-search" id="cari_customer"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" readonly id="nama" placeholder="Nama Customer" class="form-control">
                            </div>
                            <div class="form-group">
                                <Textarea type="text" readonly id="alamat" placeholder="Alamat" class="form-control"></Textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" id="kota" readonly placeholder="Kota" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6" style="padding-bottom: 10px;">
                                        <input type="text" id="no_telepon" readonly placeholder="No Telepon" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="handphone" readonly placeholder="No Handphone" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- grid ke 2 -->
                    <div class="col-sm-6">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-4">Nomor Sales Order</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nomor_so" id="nomor_so" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4">Tanggal Sales Order</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="date" required name="tanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div style="border-bottom: 1px solid black; margin-bottom: 20px"></div>
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
                </div> -->



            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">

                <div class="col-xs-3">
                    <div class="form-group">
                        <div style="display: inline-flex">
                            <input style="margin-right: 20px;" type="text" id="barcode_so" placeholder="Barcode" class="form-control">
                            <i style="font-size: 30px;cursor:pointer" class="fa fa-search" id="cari_barcode"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="form-group">
                        <div>
                            <input type="text" id="nama_item" readonly placeholder="Nama Item" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <input type="text" id="satuan" readonly placeholder="Satuan" class="form-control">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <input type="text" id="quantity" placeholder="Qty" class="form-control">
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="form-group">
                        <i style="font-size: 30px;cursor:pointer" id="masuk_data" class="fa fa-plus"></i>
                    </div>
                </div>

                <!-- table -->
                <div class="data-table">
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
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
                    <div class="col-sm-6">
                        <div class="form-group" style="padding-top: 10px;">
                            <textarea type="text" name="keterangan" required class="form-control" rows="3" placeholder="KETERANGAN"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="pull-right">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="data_item" id="data_item">
                                <button class="btn btn-primary pull-right" type="submit" name="submit">Simpan</button>
                            </div>
                        </div>
                    </div>

                    </form>
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
                $('#nama').val(data.nama);
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
            '<i style="color: red;cursor:pointer" onclick="so_hapus(' + i + ')" class="fa fa-trash fa-lg"></i>' + '</td>' +
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
        delete storeData[i];
        $('#data_item').val(JSON.stringify(storeData));

    }
</script>
<?php include('../templates/footer.php') ?>