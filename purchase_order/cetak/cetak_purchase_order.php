<?php $role = "procurement" ?>
<?php include('../../env.php') ?>
<?php
$query = $conn->query("SELECT * FROM purchase_order WHERE kode = '$_GET[kode]' ");
foreach ($query as $v) {
    // $nama = $v["nama_supplier"];
    $kode_sup = $v['kode_supplier'];
    $query2 = $conn->query("SELECT * FROM supplier WHERE kode = '$kode_sup' ");
    foreach ($query2 as $supp) {
        $nama = $supp['nama'];
    }
    $kode = $v["kode_supplier"];
    $keterangan = $v["keterangan"];
    $dpp = $v["dpp"];
    $ppn = $v["tipe_ppn"];
    $total_akhir = $v["total_harga"];
    $tanggal = $v["tanggal"];
    $uang_muka = $v['uangmuka_beli'];
}
$query2 = $conn->query("SELECT * FROM supplier WHERE nama = '$nama' ");
foreach ($query2 as $z) {
    $telepon = $z["telepon"];
    $kota  = $z['kota'];
}
$query3 = $conn->query("SELECT * FROM purchase_order_item WHERE kode_po = '$kode'");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Purchase Order</title>
    <link rel="stylesheet" href="../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/bower_components/font-awesome/css/font-awesome.min.css">


    <!-- folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css"> -->
    <!-- Date Picker -->
    <link rel="stylesheet" href="../../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
        thead {
            background: #B8DAFF;
        }

        .pt-4 {
            padding-top: 15px;
        }

        .line {
            border-bottom: solid 2px #000;
            margin-top: 110px;
        }

        .pad {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content-header">
            <h2 class=" text-center">PURCHASE ORDER</h2>
            <div class="">
                <div class="">
                    <div class="col-xs-5 pt-4">
                        <p>PT. BRASCO GROUP <br>
                            Jl. Widara 41 Jakarta Barat <br>
                            Telp. 021-77777777, 0812 4736 8922</p>
                    </div>
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-3 pt-4 pull-right">
                        <p class="">No.PO : <?= $kode ?> <br>
                            Tanggal PO : <?= $tanggal ?></p>
                    </div>

                </div>
            </div>
            <div class="line"></div>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body pt-4">
                    <form>
                        <?php
                                            $i = 1;
                                            foreach ($query2 as $f) :
                        ?>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-xs-2 col-form-label">Supplier</label>
                                    <div class="col-xs-10">
                                        <input type="text" class="form-control" name="" value="<?= $f['nama'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-form-label">ALamat</label>
                                    <div class="col-xs-10">
                                        <textarea name="" class="form-control" rows="3"><?= $f['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-2 col-form-label">Kota</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="" value="<?= $f['kota'] ?>">
                                    </div>
                                    <label class="col-xs-2 col-form-label">Telepon</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="" value="<?= $telepon ?>">
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                        <?php foreach ($query as $ok) : ?>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-xs-2 col-form-label">Kirim</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="" value="<?= $ok['nama'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-2 col-form-label">Alamat</label>
                                <div class="col-xs-10">
                                    <textarea name="" class="form-control" rows="3"><?= $ok['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-2 col-form-label">Kota</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="" value="<?= $ok['kota'] ?>">
                                </div>
                                <label class="col-xs-2 col-form-label">Telepon</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="" value="<?= $ok['telepon'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-2 col-form-label">Kodepos</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="" value="<?= $ok['kodepos'] ?>">
                                </div>
                                <label class="col-xs-2 col-form-label">Handphone</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="" value="<?= $ok['handphone'] ?>">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </form>

                    <div class="data-table pad">
                        <div class="box-body">
                            <table class="table table table-bordered table-hover" style="margin-top: 170px;">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Item</th>
                                        <th scope="col">Nama Item</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Sat</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        foreach ($query3 as $tabel) :
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $tabel['kode_item_supplier'] ?></td>
                                            <td><?= $tabel['nama_inventory'] ?></td>
                                            <td><?= $tabel['quantity'] ?></td>
                                            <td><?php
                                                    $id = $tabel["satuan"];
                                                    $satuan = $conn->query("SELECT * FROM satuan WHERE id = '$id'");
                                                    foreach ($satuan as $sat) {
                                                        echo $sat['satuan'];
                                                    }
                                                ?></td>
                                            <td><?= $tabel['harga_satuan'] ?></td>
                                            <td><?php
                                                $harga_satuan = intval($tabel["harga_satuan"]);
                                                $quantity = intval($tabel["quantity"]);
                                                $total = $harga_satuan * $quantity;
                                                echo $total;
                                                ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <div class="form2">
                                <form>
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" rows="3"><?= $keterangan ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-2">Uang Muka</label>
                                            <div class="col-xs-5">
                                                <input type="text" class="form-control" name="" value="<?php echo $uang_muka ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">DPP</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" name="" value="<?= $dpp ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">PPN(T/I/E)</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" name="" value="<?= $ppn ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">Ongkir</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" name="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">Total Akhir</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" name="" value="<?= $total_akhir ?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        function printWindow(){
            window.print();
            CheckWindowState();
        }
        function CheckWindowState(){
            if(document.readyState=="complete"){
                window.close();
            }
            else{
                setTimeout("CheckWindowState()", 11000);
            }
        }
        printWindow();
    </script>
</body>

</html>