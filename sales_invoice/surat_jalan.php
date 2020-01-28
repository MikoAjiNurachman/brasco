<?php $role = "pemasaran" ?>
<?php
require '../env.php';
if (isset($_GET)) {
    $kode = $_GET['kode'];
    $invoice = query("SELECT * FROM sales_invoice WHERE nomor_invoice = '$kode'")[0];
    $kode_customer = $invoice['kode_customer'];
    $kounter = query("SELECT * FROM counter WHERE tabel = 'sales_invoice'")[0];
    $kounter2 = query("SELECT * FROM counter WHERE tabel = 'purchase_order'")[0];
    $customer = query("SELECT * FROM customer WHERE kode = '$kode_customer' ")[0];

    $no_si = $kounter['header'] . "-" . $kounter['digit'];
    $no_po = $kounter2['header'] . "-" . $kounter['digit'];

    $profil = query("SELECT * FROM profil")[0];
    $foto = $profil['logo'];
    $phone = $profil['no_telp'];
    $alamat = $profil['alamat'];
    $cabang_nama = $profil['nama_cabang'];
    $kota = $profil['kota'];
    $tanggal = $invoice['tanggal'];
    $tanggal2 = date("d-m-Y", strtotime($tanggal));

    $kepada = $customer['nama'];
    $alamat = $customer['alamat'];
    $kota = $customer['kota'];
    $kode_pos = $customer['kodepos'];
    $telepon = $customer['telepon'];
    $handphone = $customer['handphone'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Surat jalan</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <style type="text/css">
        .pt-5 {
            padding-top: 15px;
        }

        .pr-5 {
            padding-right: 20px;
        }
    </style>
</head>

<body>

    <div class="content pt-5">
        <div class="row">
            <div class="col-xs-4">
                <div class="col-xs-3">
                    <img src="../profile/images/<?= $foto ?>" width="50px">
                </div>
                <div class="col-xs-9">
                    <?= $cabang_nama ?> <br>
                    <?= $alamat ?> <br>
                    <?= $phone ?>
                </div>
            </div>
            <div class="col-xs-4">
                <h2 class="text-center text-primary">Surat Jalan</h2>
            </div>
            <div class="col-xs-4">
                <div class="pull-right pr-5">
                    <p>No SI : <?= $no_si ?></p>
                    <p>Tgl SI : <?= $tanggal2 ?></p>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-xs-6">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Kepada</label>
                        <div class="col-xs-10">
                            <input type="text" readonly="" name="" class="form-control" value="<?= $kepada ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Alamat</label>
                        <div class="col-xs-10">
                            <textarea name="" class="form-control" rows="3" readonly><?= $alamat ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="row">
                                <label class="col-xs-4 control-label">Kota</label>
                                <div class="col-xs-8">
                                    <input type="text" readonly="" name="" class="form-control" value="<?= $kota ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <label class="col-xs-4 control-label">Kd Pos</label>
                                <div class="col-xs-8">
                                    <input type="text" readonly="" name="" class="form-control" value="<?= $kode_pos ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="row">
                                <label class="col-xs-4 control-label">Telp</label>
                                <div class="col-xs-8">
                                    <input type="text" readonly="" name="" class="form-control" value="<?= $telepon ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <label class="col-xs-4 control-label">HP</label>
                                <div class="col-xs-8">
                                    <input type="text" readonly="" name="" class="form-control" value="<?= $handphone ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-6">
                <div class="pull-right pr-5">
                    <p>No SI : <?= $no_si ?></p>
                    <p>No PO : <?= $no_po ?></p>
                </div>
                <div style="border: solid 1px #000; display: inline-block; margin-top: 70px;" class="pad pr-5">
                    <p>**Perhatian**</p>
                    <p>Cek kondisi barang, apabila sudah di tanda tangan SJ ini kami tidak menerima complain. Terimakasih</p>
                </div>
            </div>
        </div>

        <div class="tabel pt-5">
            <table class="table table-bordered table-striped">
                <thead style="background: #1863f9;">
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Qty</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $salin = query("SELECT * FROM sales_invoice WHERE nomor_invoice = '$kode'");
                    foreach ($salin as $pick_item) :
                        $k = $pick_item['data'];
                        $o = json_decode($k);
                        $asd = array();
                        foreach ($o as $oe => $ok) :
                            $pack_item = query("SELECT * FROM packing_item WHERE nomor_packing = '$ok'");
                            foreach ($pack_item as $kode) :
                                $id_pik = $kode['id_picking_item'];
                                $pick_item1 = query("SELECT * FROM picking_item WHERE id = '$id_pik'")[0];
                                $item = query("SELECT * FROM inventory WHERE barcode  = '$pick_item1[barcode]'")[0];
                                $nama_item = $item['nama_barang'];
                                $qty = $pick_item1['quantity_packing'];
                                $satuan = query("SELECT * FROM satuan WHERE id = '$item[satuan]'")[0]['satuan'];
                                ?>
                                <tr>

                                    <td><?= $no; ?></td>
                                    <td><?= $nama_item ?></td>
                                    <td><?= $qty ?></td>
                                    <td><?= $satuan ?></td>
                                </tr>
                            <?php $no++;
                                    endforeach; ?>
                        <?php endforeach; ?>

                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-xs-4 text-center">
                Dikirim Oleh
                <br>
                <br>
                <br>
                <br>
                (....................)
            </div>
            <div class="col-xs-4 text-center">
                Manager
                <br>
                <br>
                <br>
                <br>
                (....................)
            </div>
            <div class="col-xs-4 text-center">
                Diterima Oleh
                <br>
                <br>
                <br>
                <br>
                (....................)
            </div>
        </div>

    </div>
    </div>

</body>

</html>