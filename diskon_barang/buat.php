<?php $role = "inventory" ?>
<?php
require '../env.php';
cekAdmin($role);
if (isset($_POST['kirim'])) {
    $dataSemua = json_decode($_POST['dataSemua'], true);
    $p = query("SELECT * FROM counter WHERE tabel = 'diskon_barang_reject'")[0];
    $id = $p['header'] . "-" . (intval($p['digit']) + 1);
    $data = explode("-", $id)[1];
    $id_admin = $_SESSION['admin']['id'];
    $sql = '';
    $sql .= "UPDATE counter SET digit = '$data', id_edit_admin = '$id_admin' WHERE tabel = 'diskon_barang_reject';";
    $dataSemua = array_filter($dataSemua);
    foreach ($dataSemua as $data) {
        $word = "INSERT INTO diskon_barang_reject(kode_reject,kode_customer,barcode,barcode_reject,quantity,diskon, id_admin, id_edit_admin) VALUES('%s','%s','%s','%s','%s','%s','%s','%s');";
        $array = [
            $id, //kode reject
            $data['customer']['kode'], // kode customer
            $data['barang']['barcode'], // barcode
            $data['input']['barcodeReject'], // barcode reject
            $data['input']['quantityInput'], // Quantity 
            $data['input']['diskon'], // Diskon
            $id_admin,
            '0'
        ];
        print_r($data);exit();
        $sql .= vsprintf($word, $array);
    }
    $last = mysqli_multi_query($conn, $sql);
    lanjutkan($last, "Disimpan!");
    $return = true;
}
$title = "Diskon Barang Reject";
?>
<?php if (isset($return)) : ?>
    <script>
        window.stop();
        window.location.href = 'buat.php';
    </script>
<?php endif; ?>
<script>
    var active = 'header_diskon';
    var active_2 = 'header_diskon_buat';
</script>

<?php include('../templates/header.php') ?>

<div class="content-wrapper">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>INPUT DISKON BARANG REJECT</h1>

        </div>
        <div class="panel-body">
            <form action="" method="POST">
                <div class="alert alert-info alert-dismissible">
                    <i class="icon fa fa-info"></i><b>Informasi !</b>
                    <p>Jumlah Barang yang akan diproses tidak bisa lebih dari jumlah stok</p>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="kode_cabang" name="kode_cabang">
                                <option value="0">Pilih Cabang</option>
                                <?php foreach (query("SELECT * FROM customer") as $data) : ?>
                                    <option value="<?= $data['kode'] ?>">
                                        <?= $data['kode'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" id="nama_cabang" readonly placeholder="Cabang" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control " id="barcode" name="barcode">
                                <option value="0">Pilih Barcode</option>
                                <?php foreach (query("SELECT * FROM inventory") as $data) : ?>
                                    <?php if (is_numeric($data['barcode'])) : ?>
                                        <option value="<?= $data['barcode'] ?>"><?= $data['barcode'] ?> - <?= $data['nama_barang'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" id="quantity" placeholder="Quantity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" readonly id="stok" placeholder="Stok" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="display: inline-flex;">
                                <input type="number" id="diskon" placeholder="Diskon" class="form-control">
                                <label style="margin-left: 5px; padding-top: 5px">%</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <i style="font-size: 30px;cursor:pointer" id="tambah" class=" fa fa-plus"></i>
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
                                    <center>Barcode Reject</center>
                                </th>
                                <th>
                                    <center>Nama Item</center>
                                </th>
                                <th>
                                    <center>Jumlah</center>
                                </th>
                                <th>
                                    <center>Sat</center>
                                </th>
                                <th>
                                    <center>Harga Jual Normal</center>
                                </th>
                                <th>
                                    <center>Diskon</center>
                                </th>
                                <th>
                                    <center>Harga Jual Diskon</center>
                                </th>
                                <th>
                                    <center>Aksi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody align="center" id="table">
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <!-- <div class="form-group">
                            <button class="btn btn-light">Copy</button>
                            <button class="btn btn-light">CSV</button>
                            <button class="btn btn-light">Excel</button>
                            <button class="btn btn-light">PDF</button>
                            <button class="btn btn-light">Print</button>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="hidden" name="dataSemua" id="dataSemua">
                            <button class="btn btn-primary" type="submit" name="kirim">Proses</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var nomor = 1;
    var link = 'diskon_barang/ajax.php';
    var saveData = [];
    var sessData = {
        input: {}
    };
    $.ajaxSetup({
        async: false
    })
    $('#kode_cabang').change(() => {
        var kodes = document.getElementById('kode_cabang').value;
        $.get(link, {
            request: 'nama_cabang',
            kode: kodes
        }, function(data) {
            data = JSON.parse(data);
            $('#nama_cabang').val(data.nama)
            sessData.customer = data
        })
    })
    $('#barcode').on('change', () => {
        var barcode = document.getElementById('barcode').value;
        $.get(link, {
            request: 'barcode',
            data: barcode
        }, function(data) {
            data = JSON.parse(data)
            $('#stok').val(data.quantity)
            sessData.barang = data
            $.get(link, {
                request: 'satuan',
                data: sessData.barang.satuan
            }, (res) => {
                res = JSON.parse(res);
                sessData.input.satuan = res.satuan
            })
        })
    })

    function hapus(nomor) {
        $('#tr' + nomor).remove()
        delete saveData[--nomor]
        fix_iteration('#table')

        $('#dataSemua').val(JSON.stringify(saveData));
    }

    $('#tambah').click(() => {
        sessData.input.quantityInput = $('#quantity').val();
        sessData.input.diskon = $('#diskon').val();
        sessData.input.stok = $('#stok').val()
        sessData.input.barcodeReject = sessData.barang.barcode + "R";

        if (parseInt(sessData.barang.quantity) < parseInt(sessData.input.quantityInput)) {
            alert("Jumlah barang yang diproses tidak bisa lebih dari stok!");
            return false;
        }

        if (sessData.input.quantity <= 0) {
            alert("Angka tidak boleh kurang dari 0");
            return false;
        }
        if ($('#nama_cabang').val() == '') {
            alert('Tolong dipilih cabangnya!');
            return false;
        }
        if (sessData.input.quantity == '' || sessData.input.diskon == '' || sessData.input.stok == '') {
            alert("Tolong diisi semua inputnya!");
            return false;
        }

        if (parseInt(sessData.customer.tipe_customer) == 1) {
            sessData.input.hargaNormal = sessData.barang.harga_jual1
        }
        if (parseInt(sessData.customer.tipe_customer) == 2) {
            sessData.input.hargaNormal = sessData.barang.harga_jual2
        }
        if (parseInt(sessData.customer.tipe_customer) == 3) {
            sessData.input.hargaNormal = sessData.barang.harga_jual3
        }

        sessData.input.hargaJualDiskon = sessData.input.hargaNormal - (sessData.input.hargaNormal * (parseInt(sessData.input.diskon) / 100))

        $('#barcode').promise().done(function() {
            $('#table').append(`
            <tr id="tr${nomor}">
                <td id="icr"></td>
                <td>${sessData.barang.barcode}</td>
                <td>${sessData.input.barcodeReject}</td>
                <td>${sessData.barang.nama_barang}</td>
                <td>${sessData.input.quantityInput}</td>
                <td>${sessData.input.satuan}</td>
                <td>${sessData.input.hargaNormal}</td>
                <td>${sessData.input.diskon}%</td>
                <td>${sessData.input.hargaJualDiskon}</td>
                <td><button type="button" class="btn btn-link" onclick="hapus(${nomor})"><i class="fa fa-trash text-red fa-lg "></i></button></td>
            </tr>
            `)
            fix_iteration('#table');
        })
        saveData.push(sessData)
        nomor++;
        $('#dataSemua').val(JSON.stringify(saveData));
    })
</script>
<?php include('../templates/footer.php') ?>