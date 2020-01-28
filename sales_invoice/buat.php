<?php $role = "pemasaran" ?>

<?php
require '../env.php';
cekAdmin($role);
$id = $_SESSION['admin']['id'];

$jurnal_referensi = query("SELECT * FROM jurnal_referensi")[0];
$persediaan = $jurnal_referensi['persediaan'];
$ppn_masuk = $jurnal_referensi['ppnmasuk'];
$ongkir_beli = $jurnal_referensi['ongkirbeli'];
$hutang = $jurnal_referensi['hutang'];

$sales_invoice_counter = query("SELECT * FROM counter WHERE tabel = 'sales_invoice'")[0];
$digit = sprintf("%08s", ++$sales_invoice_counter['digit']);
$digit_si = $digit;
$no_sales_invoice = $sales_invoice_counter['header'] . "-" . $digit;

$kwitansi_invoice_counter = query("SELECT * FROM counter WHERE tabel = 'kwitansi_invoice'")[0];
$digit = sprintf("%08s", ++$kwitansi_invoice_counter['digit']);
$digit_kwitansi = $digit;
$kwitansi_invoice = $kwitansi_invoice_counter['header'] . "-" . $digit;

$faktur_counter = query("SELECT * FROM counter WHERE tabel = 'faktur'")[0];
$digit = sprintf("%08s", ++$faktur_counter['digit']);
$digit_faktur = $digit;
$faktur = $faktur_counter['header'] . "-" . $digit;

$profile = query("SELECT * FROM profil WHERE id = '1'")[0];
$title = "Sales Invoice";

if (isset($_POST)) {
    extract($_POST);
    if (isset($_POST['kirim'])) {
        $sql = '';
        if (isset($suratJalan)) {
            $suratJalan = 1;
            $sql .= "UPDATE counter SET digit = '$digit_faktur' WHERE tabel = 'faktur';";
        } else {
            $suratJalan = 0;
        }
        $sql .= PHP_EOL;

        if (isset($kwitansi)) {
            $kwitansi = 1;
            $sql .= "UPDATE counter SET digit = '$digit_kwitansi' WHERE tabel = 'kwitansi_invoice';";
        } else {
            $kwitansi = 0;
        }
        $sql .= PHP_EOL;
        $sql .= "INSERT INTO sales_invoice(nomor_invoice,tanggal,kode_customer,data,catatan,surat_jalan,kwitansi,subtotal,ongkir,ppn,tipe_ppn,total,id_admin,id_edit_admin,outstanding) VALUES('$no_sales_invoice','$tanggal','$kode_customer','$dataJs','$catatan','$suratJalan','$kwitansi','$subtotal','$ongkir','$ppn','$tipe_ppn','$total','$id','0','$total');";
        $sql .= PHP_EOL;
        $sql .= "UPDATE counter SET digit = '$digit_si' WHERE tabel = 'sales_invoice';";
        $no_sales_invoice = $sales_invoice_counter['header'] . "-" . sprintf("%08s", ++$digit_si);
        $sql .= PHP_EOL;
        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,keterangan,tanggal,userid) VALUES('$no_sales_invoice','1','$persediaan','$subtotal','Persediaan Sales Invoice','$today','$id');";
        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,keterangan,tanggal,userid) VALUES('$no_sales_invoice','2','$ppn_masuk','$ppn','PPN Beli Sales Invoice','$today','$id');";
        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,keterangan,tanggal,userid) VALUES('$no_sales_invoice','3','$ongkir_beli','$ongkir','Ongkir Beli Sales Invoice','$today','$id');";
        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,kredit,keterangan,tanggal,userid) VALUES('$no_sales_invoice','4','$hutang','$total','Hutang Sales Invoice','$today','$id');";
        $query = mysqli_multi_query($conn, $sql);
        lanjutkan($sql, "Ditambahkan");
        $success = [
            'surat_jalan' => $suratJalan,
            'kwitansi' => $kwitansi,
            'invoice' => $nomor_invoice
        ];
    }
}

if (isset($_GET['kode'])) {
    $kodeCustomer = $_GET['kode'];
}

$dataModal = array();
?>
<?php include('../templates/header.php') ?>
<script>
    var active = 'header_invoice';
</script>
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Menu Sales Invoice</h3>
                <div class="box-tools pull-right">
                    <?php if (isset($success)) : ?>
                        <a target="_blank" href="sales_invoice/cetak.php?kode=<?= $success['invoice'] ?>" class="btn btn-primary">Cetak Invoice</a>
                        <?php if ($success['kwitansi'] == 1) : ?>
                            <a target="_blank" href="sales_invoice/kwitansi.php?kode=<?= $success['invoice'] ?>" class="btn btn-primary">Cetak Kwitansi</a>
                        <?php endif ?>
                        <?php if ($success['surat_jalan'] == 1) : ?>
                            <a target="_blank" href="sales_invoice/surat_jalan.php?kode=<?= $success['invoice'] ?>" class="btn btn-primary">Cetak Surat Jalan</a>

                        <?php endif; ?>
                    <?php endif; ?>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="POST" id="formInvoice" action="">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="box-body" style="padding: 0 20px 0 20px;">
                                    <div class="form-group">
                                        <h3>BRASCO GRUP</h3>
                                        <img src="profile/images/<?= $profile['logo'] ?>" class="img-fluid" width="100px" height="100px" style="border: solid 1px #ccc; padding: 5px;">
                                    </div>
                                    <div class="form-group">
                                        <div class="bg-primary" style="padding: 10px;">
                                            Ditagih ke
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" readonly value="<?= $profile['chief'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Perusahaan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly value="<?= $profile['nama_cabang'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Alamat 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly value="<?= $profile['alamat'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Alamat 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly value="<?= $profile['alamat2'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Telepon</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" readonly value="<?= $profile['no_hp'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box-body" style="padding: 0 20px 0 20px;">
                                    <div class="form-group">
                                        <h3>SALES INVOICE</h3>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Tanggal Invoice</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="date" name="tanggal" required id="formtanggal" class="form-control">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Nomor Invoice</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?= $no_sales_invoice ?>" class="form-control" name="nomor_invoice" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Kode Customer</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" readonly name="kode_customer" id="kode_customer">
                                        </div>
                                        <div class="col-sm-1">
                                            <i class=" fa fa-search fa-2x" style="cursor:pointer" data-toggle="modal" data-target="#modal2"></i>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <div class="checkbox col-xs-6">
                                            <label class="">
                                                <input type="checkbox" id="suratJalan" name="suratJalan">
                                                Surat Jalan
                                            </label>
                                        </div>
                                        <div class="checkbox col-xs-6">
                                            <label class="">
                                                <input type="checkbox" id="kwitansi" name="kwitansi">
                                                Kwitansi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="bg-primary" style="padding: 10px;">
                                            Dikirim ke
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" readonly id="nama_customer">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Cabang</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly id="cabang_customer">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Alamat 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly id="alamat1_customer">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Alamat 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly id="alamat2_customer">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3">Telepon</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" readonly id="telepon_customer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="box-body">
                                    <a class="btn btn-primary" id="btnTambah">Tambah Item</a>
                                </div>
                            </div>
                        </div>

                        <!-- modal -->
                        <div class="modal fade" id="modal2">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center">Pilih Customer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-data">
                                            <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Customer</th>
                                                            <th>Nama Customer</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        foreach (query("SELECT * FROM customer") as $data) : ?>
                                                            <tr>
                                                                <td><?= $i ?></td>
                                                                <td><?= $data['kode'] ?></td>
                                                                <td><?= $data['nama'] ?></td>
                                                                <td><button type="button" data-dismiss="modal" onclick="tampilkan('<?= $data['kode'] ?>')" class="btn btn-primary" title="Pilih"><i class="fa fa-paper-plane"></i></button></td>
                                                            </tr>
                                                        <?php $i++;
                                                        endforeach ?>
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
                        <?php if (isset($kodeCustomer)) : ?>
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-center">Pilih Item</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-data">
                                                <form class="form-horizontal">
                                                    <div class="">
                                                        <div class="col-xs-7">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label class="col-xs-2 control-label">Tanggal</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="date" name="" class="form-control">
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <button type="submit" class="btn btn-primary">Cek</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <div class="box-body">
                                                                <input type="text" class="form-control" readonly placeholder="Nama Customer" id="nama_customer2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>No Packing</th>
                                                                <th>Tanggal</th>
                                                                <th>Qty</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $i = 1;
                                                                $dataModal = array();
                                                                foreach (query("SELECT * FROM packing") as $data) :
                                                                    $sessData2 = array();

                                                                    $sessData2['nomor_packing'] = $data['nomor_packing'];
                                                                    $sessData2['tanggal'] = $data['tanggal'];
                                                                    $sessData2['id'] = $i;
                                                                    $sessData2['item'] = array();

                                                                    foreach (query("SELECT * FROM packing_item WHERE nomor_packing = '$data[nomor_packing]'") as $data2) {
                                                                        $dataPickingItem  = query("SELECT * FROM picking_item WHERE id = '$data2[id_picking_item]'")[0];
                                                                        $dataInventory = query("SELECT * FROM inventory WHERE barcode = '$dataPickingItem[barcode]'")[0];
                                                                        $dataCustomer = query("SELECT * FROM customer WHERE kode = '$kodeCustomer'")[0];

                                                                        if ($dataCustomer['tipe_customer'] == '1') $hargaSatuan = $dataInventory['harga_jual1'];
                                                                        if ($dataCustomer['tipe_customer'] == '2') $hargaSatuan = $dataInventory['harga_jual2'];
                                                                        if ($dataCustomer['tipe_customer'] == '3') $hargaSatuan = $dataInventory['harga_jual3'];

                                                                        $sessData['quantity'] = $dataInventory['quantity'];
                                                                        $sessData['totalHarga'] = intval($sessData['quantity']) * intval($hargaSatuan);
                                                                        $sessData['harga_satuan'] = $hargaSatuan;
                                                                        $sessData['nama_item'] = $dataInventory['nama_barang'];

                                                                        array_push($sessData2['item'], $sessData);
                                                                    }
                                                                    array_push($dataModal, $sessData2);
                                                                    ?>
                                                                <tr>
                                                                    <td><?= $i ?></td>
                                                                    <td><?= $data['nomor_packing'] ?></td>
                                                                    <td><?= $data['tanggal'] ?></td>
                                                                    <td><?= $data['total'] ?></td>
                                                                    <td>
                                                                        <a data-toggle="modal" href="#myModal<?= $i ?>"><i class=" btn btn-success fa fa-info text-white fa-lg"></i></a>
                                                                        <button type="button" id="btnTambah<?= $i ?>" data-dismiss="modal" onclick="tambahItem('<?= $data['nomor_packing'] ?>','btnTambah<?= $i ?>')" class="btn btn-primary btn" title="Pilih"><i class="fa fa-paper-plane"></i></button>
                                                                    </td>
                                                                </tr>

                                                            <?php $i++;
                                                                endforeach; ?>
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
                                </div>
                            </div>
                            <?php foreach ($dataModal as $data) : ?>
                                <div class="modal fade rotate" id="myModal<?= $data['id'] ?>">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center">Detail</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-xs-6 text-center">
                                                    <h4><b>No Pack : <?= $data['nomor_packing'] ?></b></h4>
                                                </div>
                                                <div class="col-xs-6 text-center">
                                                    <h4><b>Tanggal : <?= $data['tanggal'] ?></b></h4>
                                                </div>
                                                <div class="table-data">
                                                    <div class="box-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Item</th>
                                                                    <th>Qty</th>
                                                                    <th>Harga Satuan</th>
                                                                    <th>Total Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $p = 1;
                                                                        foreach ($data['item'] as $myData) :
                                                                            // $picking_item = query(sprintf("SELECT * FROM picking_item WHERE nomor_picking = '%s'", $data2['id_picking_item']))[0];
                                                                            // $barcode = $picking_item['barcode'];
                                                                            // $nama_item = query("SELECT * FROM inventory WHERE barcode = '$barcode'")[0]['nama_barang'];
                                                                            // $picking = query(sprintf("SELECT * FROM picking WHERE nomor_picking = '%s'", $picking_item['nomor_picking']))[0];
                                                                            // $tanggal = $picking['tanggal'];

                                                                            ?>
                                                                    <tr>
                                                                        <td><?= $p ?></td>
                                                                        <td><?= $myData['nama_item'] ?></td>
                                                                        <td><?= $myData['quantity'] ?></td>
                                                                        <td><?= $myData['harga_satuan'] ?></td>
                                                                        <td><?= $myData['totalHarga'] ?></td>
                                                                    </tr>
                                                                <?php $p++;
                                                                        endforeach; ?>
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
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="data-table">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <th>No Pack</th>
                                        <th>Barcode</th>
                                        <th>Nama Item</th>
                                        <th>Qty</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                    </thead>
                                    <tbody id="tableku">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="box-body">
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group bg-primary" style="padding: 10px;">
                                            Catatan
                                        </div>
                                        <div class="form-group">
                                            <textarea name="catatan" required rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3">Subtotal</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly name="subtotal" class="form-control" id="subtotal">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3">PPN (T/I/E)</label>
                                        <div class="col-sm-3">
                                            <select name="tipe_ppn" class="form-control" id="tipe_ppn">
                                                <option disabled selected>Tipe PPN</option>
                                                <option value="t">T - 0%</option>
                                                <option value="i">I - (Subtotal * 10/11) * 10%</option>
                                                <option value="e">E - Subtotal * 10%</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" readonly class="form-control" name="ppn" id="ppn">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3">Ongkir</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="ongkir" class="form-control" id="ongkir">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3">Total</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly name="total" id="total" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="button">
                                    <div class="box-body">
                                        <div class="pull-right">
                                            <button class="btn btn-default">Close</button>
                                            <button class="btn btn-danger">Reset</button>
                                            <input type="hidden" name="dataJs" id="dataJs">
                                            <button class="btn btn-info" name="kirim" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
<?= jquery() ?>
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="sales_invoice/salesInvoice.js"></script>
<?php include('../templates/footer.php') ?>