<?php include('../env.php') ?>
<?php $role = 'Pemasaran';
cekAdmin($role);
?>
<?php

$query = query("SELECT * FROM picking WHERE nomor_picking = '$_GET[kode]' ");
$kode_cus = $query[0]['kode_customer'];
$query2 = query("SELECT * FROM customer WHERE kode = '$kode_cus'")[0];
$nama_cus = $query2['nama'];
$query3 = query("SELECT * FROM picking_item WHERE nomor_picking = '$_GET[kode]'");


foreach ($query3 as $querye) {
    $qty_order = $querye['quantity_order'];
    $qty_pick = $querye['quantity_packing'];
    // $barcod = $querye['barcode'];
    // $query4 = query("SELECT * FROM inventory WHERE barcode = '$barcod'");
    // print_r($query4);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <base href="<?php echo $base_url ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Picking</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

    <style>
        @page {
            size: landscape;
            margin: 0mm;
        }

        .pt-5 {
            padding-top: 20px;
        }
    </style>

</head>

<body">

    <h2 class="text-info text-center">LIST PICKING BARANG</h2>

    <div class="pt-5">
        <?php foreach ($query as $cust) : ?>
            <div class="col-xs-2">
                <div class="pull-left">
                    <p>Kode Customer </p>
                    <p>Customer</p>
                    <p>No Order</p>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="pull-left">
                    <p><?= $cust['kode_customer'] ?></p>
                    <p><?= $nama_cus ?></p>
                    <p><?= $cust['nomor_order'] ?></p>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="pull-right">
                    <p>Nomor Pick </p>
                    <p>Tanggal Pick</p>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="pull-right">
                    <p><?= $cust['nomor_picking'] ?> </p>
                    <p><?= $cust['tanggal'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="data-table">
        <table class="table table-bordered table-striped text-center">
            <thead style="background: #31708F; color: #fff;">
                <tr>
                    <th>No</th>
                    <th>Barcode</th>
                    <th>Nama Item</th>
                    <th>Satuan</th>
                    <th>Qty Order</th>
                    <th>Qty Pick</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_qty = 0;
                $no = 1;
                foreach ($query3 as $queryz) :
                    $barcod = $queryz['barcode'];
                    $query4 = query("SELECT * FROM inventory WHERE barcode = '$barcod'");
                    foreach ($query4 as $invent) :
                        // print_r($invent);   
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $invent['barcode'] ?></td>
                            <td><?= $invent['nama_barang'] ?></td>
                            <?php
                                    $id_satuan = $invent['satuan'];
                                    $satuan = query("SELECT * FROM satuan WHERE id = '$id_satuan'")[0];
                                    ?>
                            <td><?= $satuan['satuan'] ?></td>
                            <td><?= $qty_order ?></td>
                            <td><?= $qty_pick ?></td>
                        </tr>
                        <?php
                                $total_qty += intval($qty_order);
                                // print_r($total_qty);
                                ?>
                    <?php endforeach; ?>
                <?php
                    $no++;
                endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td>Total QTY</td>
                    <td></td>
                    <td></td>
                    <td><?= $total_qty ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="col-xs-6 text-center">
        <p>Prepare By</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>(........................)</p>
    </div>
    <div class="col-xs-6 text-center">
        <p>Diperiksa Oleh</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>(........................)</p>
    </div>
    </body>

</html>