<?php $role = "procurement" ?>

<?php
require '../env.php';
cekAdmin($role);
$title = 'Input Barang Masuk';
$total = 0;
$query = query("SELECT * FROM purchase_order WHERE status = 'Approve'");

$jurnal_referensi = query("SELECT * FROM jurnal_referensi")[0];
$persediaan = $jurnal_referensi['persediaan'];
$ppn_masuk = $jurnal_referensi['ppnmasuk'];
$hutang = $jurnal_referensi['hutang'];
$uang_muka_jurnal = $jurnal_referensi['umbeli'];

if (isset($_GET['kode_po'])) {
    if (!isset($reload)) {
        $kode = $_GET['kode_po'];
        $query_po = query("SELECT * FROM purchase_order WHERE kode='$kode'");
        $counter = query("SELECT * FROM counter WHERE tabel='purchasing'")[0];
        $see = intval($counter['digit']) + 1;
        $see = sprintf('%08s', $see);
        $no_retur = $counter['header'] . "-" . $see;

        $query_po_saja = query("SELECT * FROM purchase_order WHERE kode='$kode'")[0];

        $purchase_order = query("SELECT * FROM purchase_order WHERE kode='$kode'")[0];
        $ini_kode = $query_po_saja['kode_supplier'];
        $supplier = query("SELECT * FROM supplier WHERE kode='$ini_kode'")[0];

        $ppn = $query_po_saja['tipe_ppn_input'];
        $ppn_harga = $query_po_saja['total_harga'];

        if (!isset($query_po[0])) {
            alert('Data tidak ditemukan!');
        } else {
            $query_po = $query_po[0];
            $query_item = query("SELECT * FROM purchase_order_item WHERE kode_po='$kode'");
            $accept = true;
        }
        $kode_supplier = $query_po_saja['kode_supplier'];
        $data_supplier = query("SELECT * FROM supplier WHERE kode = '$kode_supplier'")[0];
        $top = $data_supplier['top'];
        $tanggal_now = date("Y-m-d");
        $tanggal_jatuh_tempo = date('Y-m-d', strtotime('+' . $top . ' days'));
    }
}
if (isset($_POST['submit'])) {
    extract($_POST);
    $sql = '';
    $total_quantity = 0;
    $total_harga = 0;
    $id_admin = $_SESSION['admin']['id'];
    $switch = false; // untuk bikin closed atau tidaknya pembelian, 1 lunas, 0 tidak
    for ($i = 1; $i <= $total_item; $i++) {
        $id_item = $_POST['id_' . $i];
        $quantity_terima = $_POST['quantity_terima_' . $i];
        $quantity_order = $_POST['quantity_order_' . $i];
        $barcode = $_POST['barcode_' . $i];

        $quantity_selisih = intval($quantity_order) - intval($quantity_terima);

        if ($quantity_selisih <= 0) {
            $switch = true;
        }

        $sql .= "UPDATE purchase_order_item SET quantity_purchasing = '$quantity_selisih' WHERE id = '$id_item';";
        $sql .= PHP_EOL;

        $inven = query("SELECT * FROM inventory WHERE barcode = '$barcode'")[0];
        $quantity_inven  =  intval($inven['quantity']) + intval($quantity_terima);
        $harga_satuan = $_POST['harga_satuan_' . $i];
        $quantity_order = $_POST['quantity_order_' . $i];
        $sql .= "UPDATE inventory SET quantity = '$quantity_inven',harga_beli = '$harga_satuan' WHERE barcode = '$barcode';";
        $sql .= PHP_EOL;
        $sql .= "INSERT INTO purchasing_item(kode_pu,barcode,quantity_order,quantity_terima,harga_satuan, id_admin, id_edit_admin) VALUES('$nomor_invoice','$barcode','$quantity_order','$quantity_terima','$harga_satuan', '$id_admin', '0');";
        $sql .= PHP_EOL;

        $hpp = $harga_satuan * $quantity_inven;
        $sql .= "INSERT INTO intrn(tanggal,kode_item,quantity,satuan,harga_beli,hpp,harga_jual,discount,keterangan,tipe_transaksi,kode_user) 
        VALUES('$tanggal_terima','$barcode','$quantity_terima','$quantity_inven','$harga_satuan','$hpp','0','0','Purchasing','PU','$id_admin');";
        // Bentar maksudnya satuan = quantity_inven apa?
        $sql .= PHP_EOL;


        $total_quantity += intval($quantity_terima);
        $total_harga += intval($harga_satuan * $quantity_terima);
    }
    $hutang_all = $total_harga + $ppn;

    $outstanding = $hutang_all - $uang_muka;

    $sql .= "INSERT INTO purchasing(kode,no_invoice,nomor_surat_jalan,kode_supplier,diterima_oleh,tanggal_terima,tanggal_jatuh_tempo,total_quantity, id_admin, id_edit_admin,kode_po,total,outstanding) VALUES('$kode_pu','$nomor_invoice','$nomor_surat_jalan','$kode_supplier','$diterima_oleh',CAST('$tanggal_terima' AS DATE),CAST('$tanggal_jatuh_tempo' AS DATE),'$total_quantity', '$id_admin', '0','$kode_po','$total_harga','$outstanding');";

    $sql .= PHP_EOL;

    if ($switch == true) {
        $sql .= "UPDATE purchase_order SET status = 'Closed' WHERE kode = '$kode_po';";
        $sql .= PHP_EOL;
    }


    $sql .= "UPDATE supplier SET tanggal_beli_akhir = CAST('$tanggal_terima' AS DATE) WHERE kode = '$kode_supplier';";
    $sql .= PHP_EOL;

    $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,keterangan,tanggal,userid) VALUES('$kode_pu','1','$persediaan','$total_harga','Persediaan Purchasing','$tanggal_terima','$id_admin');";

    $sql .= PHP_EOL;

    $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debet,keterangan,tanggal,userid) VALUES('$kode_pu','2','$ppn_masuk','$ppn','PPN Purchasing','$tanggal_terima','$id_admin');";

    $sql .= PHP_EOL;

    $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,kredit,keterangan,tanggal,userid) VALUES('$kode_pu','4','$hutang','$hutang_all','Hutang Purchasing','$tanggal_terima','$id_admin');";

    $sql .= PHP_EOL;

    if ($uang_muka > 0) {
        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,debit,keterangan,tanggal,userid) VALUES('$kode_pu','1','$hutang','$hutang_all','Hutang Uang Muka','$tanggal_terima','$id_admin');";

        $sql .= PHP_EOL;

        $sql .= "INSERT INTO tr_jurnal(novoucher,nourut,kodeakun,kredit,keterangan,tanggal,userid) VALUES('$kode_pu','2','$uang_muka_jurnal','$uang_muka','Uang Muka Beli','$tanggal_terima','$id_admin');";

        $sql .= PHP_EOL;
    }

    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Dimasukkan");
    $reload = true;
}
?>

<!-- =============================================== -->
<?php if (isset($reload)) : ?>
    <script>
        window.stop();
        window.location.href = 'input_pu.php';
    </script>
<?php endif ?>
<script>
    var active = 'header_purchasing';
    var active_2 = 'header_purchasing_input';
</script>
<?php include('../templates/header.php') ?>

<!-- `Content` Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Input Barang Masuk
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Input Barang Masuk</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- Setelah ada GET -->
            <?php if (isset($accept)) : ?>
                <form action="" method="POST" class="form-horizontal">

                    <div class="box-body">
                        <div class="form">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="text" name="kode_po" readonly value="<?= $query_po['kode'] ?>" class="form-control col-md-7" placeholder="KODE PO" style="width: 60%;">
                                        <i class="fa fa-search text-dark fa-2x col-md-4"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="kode_pu" class="form-control" value="" style="width: 80%" placeholder="Kode Purchasing">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nomor_surat_jalan" class="form-control" placeholder="Nomor Surat Jalan" style="width: 80%">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nomor_invoice" class="form-control" placeholder="Nomor Invoice" style="width: 80%">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="form-group" style="padding-right: 10px;">
                                                <input type="text" class="form-control" name="kode_supplier" readonly value="<?= $query_po['kode_supplier'] ?>" placeholder="KODE SUPP">
                                                <input type="hidden" name="uang_muka" value="<?= $purchase_order["uangmuka_beli"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nama_supplier" readonly value="<?= $supplier['nama'] ?>" placeholder="SUPPLIER">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="ALAMAT" readonly><?= $supplier['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Diterima oleh</label>
                                        <div class="col-md-8">
                                            <input type="text" name="diterima_oleh" class="form-control" placeholder="DITERIMA OLEH">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Tanggal Terima</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" required id="formtanggal" name="tanggal_terima" class="form-control" readonly value="<?= $tanggal_now ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Tgl Jatuh Tempo</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" required id="formtanggal" name="tanggal_jatuh_tempo" readonly value="<?= $tanggal_jatuh_tempo ?>" class="form-control">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive" style="margin-top: 20px">
                            <table id="table_pu" class="table table-bordered table-striped">
                                <thead class="thead-dark" align="center">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Item</th>
                                        <th>QTY Order</th>
                                        <th>QTY Terima</th>
                                        <th>Sat</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Harga</th>
                                    </tr>
                                </thead>
                                <tbody align="center" class="text-center">
                                    <?php $i = 1;
                                    foreach ($query_item as $data) :
                                        $id_s = $data['satuan'];
                                        $satuan = query("SELECT * FROM satuan WHERE id = '$id_s'")[0] ?>
                                        <tr class="text-center">
                                            <td><?= $i ?></td>
                                            <td><?= $data['barcode_inventory'] ?></td>
                                            <td><?= $data['nama_inventory'] ?></td>
                                            <td><?= $data['quantity_purchasing'] ?></td>
                                            <td><input style="width:3em;" type="number" name="quantity_terima_<?= $i ?>"></td>
                                            <td><?= $satuan['satuan'] ?></td>
                                            <td><?= $data['harga_satuan'] ?></td>
                                            <td><?= intval($data['quantity']) * intval($data['harga_satuan']) ?></td>
                                            <input type="hidden" name="id_<?= $i ?>" value="<?= $data['id'] ?>">
                                            <input type="hidden" name="barcode_<?= $i ?>" value="<?= $data['barcode_inventory'] ?>">
                                            <input type="hidden" name="nama_inventory_<?= $i ?>" value="<?= $data['nama_inventory'] ?>">
                                            <input type="hidden" name="quantity_order_<?= $i ?>" value="<?= $data['quantity'] ?>">
                                            <input type="hidden" name="satuan_<?= $i ?>" value="<?= $data['satuan'] ?>">
                                            <input type="hidden" name="harga_satuan_<?= $i ?>" value="<?= $data['harga_satuan'] ?>">

                                        </tr> <?php
                                                $i++;
                                                $total += intval($data['quantity']);
                                            endforeach; ?> </tbody>
                            </table>
                        </div>
                        <div class="form-group pull-right">
                            <input type="hidden" name="total_item" value="<?= --$i ?>">
                            <button type="submit" name="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </form>
                <!-- Sebelum ada GET -->
            <?php else : ?>

                <div class="box-body">
                    <div class="form">
                        <form action="" method="GET" class="form-horizontal">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="text" name="kode_po" class="form-control col-md-7" placeholder="KODE PO" style="width: 60%;">
                                        <button type="submit" class="btn" style="background-color:transparent"><i class="fa fa-search text-dark fa-2x col-md-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Purchase Order</th>
                                    <th>Tanggal Approve</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($query as $data) :
                                    extract($data); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $kode ?></td>
                                        <td><?= $tanggal ?></td>
                                        <td><?= ($tanggal_approve == '') ? 'Unknown' : $tanggal_approve ?></td>
                                        <td><?= $status ?></td>
                                        <td> <?= ($keterangan !== '') ? $keterangan : $keterangan_approve ?></td>
                                        <td><a href="purchasing/input_pu.php?kode_po=<?= $kode ?>" class="btn btn-info">Pilih</a></td>

                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>