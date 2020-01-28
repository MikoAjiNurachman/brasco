<?php $role = "pemasaran" ?>

<?php
session_start();
require '../env.php';
cekAdmin($role);
$sess = $_SESSION['admin']['id'];
if (isset($_GET['kode'])) {
    header('Content-Type: Application/Json');
    $nomor_pack = $_GET['kode'];
    $data_hidden = ['data_packing' => [], 'data_picking_item' => [], 'data_inventory' => [], 'data_picking' => []];
    foreach (query("SELECT * FROM packing_item WHERE nomor_packing = '$nomor_pack'") as $data) {
        $data_picking_item = query(sprintf("SELECT * FROM picking_item WHERE id = '%s' ", $data['id_picking_item']))[0];
        $data_picking = query(sprintf("SELECT * FROM picking WHERE nomor_picking = '%s'", $data_picking_item['nomor_picking']))[0];
        $data_inventory = query(sprintf("SELECT * FROM inventory WHERE barcode = '%s'", $data_picking_item['barcode']))[0];

        array_push($data_hidden['data_packing'], $data);
        array_push($data_hidden['data_picking_item'], $data_picking_item);
        array_push($data_hidden['data_picking'], $data_picking);
        array_push($data_hidden['data_inventory'], $data_inventory);
    }
    echo json_encode($data_hidden);
    exit();
}
if (is_null($_GET['nomor'])) {
    return header('Location: list.php?err=1');
}
$title = "Edit Packing Gudang";
$nomor_pack = $_GET['nomor'];
$data = query("SELECT * FROM packing WHERE nomor_packing = '$nomor_pack'")[0];

if (isset($_POST['submit'])) {
    $query = '';
    $total = 0;
    for ($i = 1; $i <= $_POST['total']; $i++) {
        if (isset($_POST['id_packing_' . $i])) {
            $query .= sprintf("UPDATE packing_item SET id_picking_item ='%s',quantity_packing='%s',id_edit_admin='%s' WHERE id=%s;", $_POST['id_picking_' . $i], $_POST['qty_pack_' . $i], $sess, $_POST['id_packing_' . $i]);
        } else {
            $query .= sprintf("INSERT INTO packing_item(nomor_packing,id_picking_item,quantity_packing,id_admin,id_edit_admin) VALUES('%s',%s,%s,'%s','%s'); ", $_POST['nomor_packing'], $_POST['id_picking_' . $i], $_POST['qty_pack_' . $i], $sess, 0);
        }

        $query .= sprintf("UPDATE picking_item SET quantity_packing = '%s',id_edit_admin = '%s' WHERE id = %s;", $_POST['qty_pack_' . $i], $sess, $_POST['id_picking_' . $i]);
        $total += intval($_POST['qty_pack_' . $i]);
    }
    $query .= sprintf("UPDATE packing SET nomor_packing='%s',kode_customer='%s',tanggal='%s',total='%s',id_edit_admin='%s' WHERE nomor_packing='%s';", $_POST['nomor_packing'], $_POST['customer'], $_POST['tanggal'], $total, $sess, $_POST['nomor_packing']);
    $sql = mysqli_multi_query($conn, $query);
    lanjutkan($sql, "Diedit!");
    $return = true;
}

?>
<script>
    var active = 'header_packing';
    var active_2 = 'header_packing_gudang';
</script>
<?php include('../templates/header.php') ?>
<?php if (isset($return)) : ?>
    <script>
        window.stop();
        window.location.href = 'packing_gudang/list.php';
    </script>
<?php endif; ?>
<form id="fo" class="form-horizontal" action="" method="POST">

    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Packing Gudang</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="box-body">
                            <form method class="form-horizontal">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-xs-3">No Packing</label>
                                        <div class="col-xs-9">
                                            <input type="text" name="nomor_packing" id="nomor_packing" class="form-control" value="<?= $nomor_pack ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3">Tanggal</label>
                                        <div class="col-xs-9">
                                            <div class="input-group">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" readonly>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3">Pilih Customer</label>
                                        <div class="col-xs-9">
                                            <select name="customer" id="customer" class="form-control">
                                                <?php foreach (query("SELECT * FROM customer") as $cust) : ?>
                                                    <option value="0">- Pilih Customer -</option>
                                                    <option <?= ($cust['kode'] == $data['kode_customer']) ? 'selected'  : '' ?> value="<?= $cust['kode'] ?>"><?= $cust['nama'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#modal3" class="btn btn-info">Tambah Item</button>

                                    <!-- modal ketiga -->
                                    <div class="modal fade" id="modal3">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center">Pilih Item</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-data">
                                                        <div class="box-body">
                                                            <table id="example1" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>tanggal</th>
                                                                        <th>Kode Cust</th>
                                                                        <th>No Pick</th>
                                                                        <th>Nama Item</th>
                                                                        <th>Qty Pick</th>
                                                                        <th>Pack</th>
                                                                        <th>Jml</th>
                                                                        <th>Pilih</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i2 = 1;
                                                                    foreach (query("SELECT * FROM picking_item") as $pick) :
                                                                        $d  = query(sprintf("SELECT * FROM picking WHERE nomor_picking = '%s'", $pick['nomor_picking']))[0];
                                                                        $bar = query(sprintf("SELECT * FROM inventory WHERE barcode = '%s'", $pick['barcode']))[0];
                                                                        ?>
                                                                        <tr id="tr_<?= $i2 ?>">
                                                                            <td id="i_"><?= $i2 ?></td>
                                                                            <td><?= $d['tanggal'] ?></td>
                                                                            <td><?= $d['kode_customer'] ?></td>
                                                                            <td><?= $pick['nomor_picking'] ?></td>
                                                                            <td><?= $bar['nama_barang'] ?></td>
                                                                            <td><?= $pick['quantity_picking'] ?></td>
                                                                            <td><?= $pick['quantity_packing'] ?></td>
                                                                            <td><?= intval($pick['quantity_picking']) - intval($pick['quantity_packing']) ?></td>
                                                                            <td><button onclick="pilih_item(<?= $i2 ?>)" type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check text-light"></i></button></td>
                                                                            <input type="hidden" id="tr_barcode_<?= $i2 ?>" value="<?= $pick['barcode'] ?>">
                                                                            <input type="hidden" id="tr_id_<?= $i2 ?>" value="<?= $pick['id'] ?>">
                                                                        </tr>
                                                                    <?php $i2++;
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
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <!-- /modal ketiga -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Item</th>
                                        <th>Jml</th>
                                        <th>Qty Pack</th>
                                    </tr>
                                </thead>
                                <tbody id="table_show">
                                    <!-- <tr>
                                    <td>1</td>
                                    <td>111111111</td>
                                    <td>Jaket Batik</td>
                                    <td>15</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <label class="col-xs-2">Total Qty</label>
                                <div class="col-xs-5">
                                    <input type="text" id="total_qty_pick" readonly class="form-control">
                                </div>
                                <div class="col-xs-5">
                                    <input type="text" id="total_qty_pack" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-danger">Reset</button>
                        <input type="hidden" name="total" id="totall">
                        <button class="btn btn-info" type="submit" name="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var i = 1;
    var total = {
        pick: 0,
        pack: ['', ],
    }
    var savedData = ['', ]
    $(document).ready(() => {
        $.get(document.location.href, {
            kode: $('#nomor_packing').val()
        }, (data) => {
            var tot = 0;
            var temp = {}
            data = JSON.parse(data)
            for (it in data.data_inventory) {
                temp.tanggal = data.data_picking[it].tanggal
                temp.kode_customer = data.data_picking[it].kode_customer
                temp.no_pick = data.data_picking[it].nomor_picking
                temp.nama = data.data_inventory[it].nama_barang
                temp.id = data.data_picking_item[it].id
                temp.id_packing = data.data_packing[it].id
                temp.qty_pick = data.data_picking_item[it].quantity_picking
                temp.qty_pack = data.data_packing[it].quantity_packing
                temp.barcode = data.data_inventory[it].barcode
                temp.jumlah = parseInt(temp.qty_pick) - parseInt(temp.qty_pack)
                total.pick += parseInt(temp.qty_pick)
                total.pack.push(temp.qty_pack)

                $('#total_qty_pack').val(tot)
                $('#total_qty_pick').val(total.pick)
                $('#table_show').append(
                    '<tr>' +
                    '<td>' + i + '</td>' +
                    '<td>' + temp.barcode + '</td>' +
                    '<td>' + temp.nama + '</td>' +
                    '<td>' + temp.qty_pick + '</td>' +
                    '<td>' + '<input type="number" value="' + temp.qty_pack + '" id="qty_pack" onkeyup="press(this.value,' + i + ')"  name="qty_pack_' + i + '" class="form-control">' + '</td>' +
                    '<input type="number" value="' + temp.qty_pack + '" id="qty_pack" onkeyup="press(this.value,' + i + ')"  name="qty_pack_' + i + '" class="form-control">' +
                    '</tr>' +
                    '<input type="hidden" name="id_picking_' + i + '" value="' + temp.id + '">' +
                    '<input type="hidden" name="id_packing_' + i + '" value="' + temp.id_packing + '">'

                )
                i++
                savedData.push(temp)


            }
            for (a in total.pack) {
                if (total.pack[a] == '') {
                    total.pack[a] = 0
                }
                tot += parseInt(total.pack[a])
            }
            $('#total_qty_pack').val(tot)

        })
    })

    function pilih_item(is) {
        var tot = 0;
        var temp = {}
        $('#tr_' + is).each(function(i, el) {
            var $now = $(this).find('td')

            temp.i = $now.eq(0).text()
            temp.tanggal = $now.eq(1).text()
            temp.kode_customer = $now.eq(2).text()
            temp.no_pick = $now.eq(3).text()
            temp.nama = $now.eq(4).text()
            temp.qty_pick = $now.eq(5).text()
            temp.qty_pack = $now.eq(6).text()
            temp.jumlah = $now.eq(7).text()

        })
        total.pick += parseInt(temp.qty_pick)
        temp.barcode = $('#tr_barcode_' + is).val()
        temp.id = $('#tr_id_' + is).val()
        total.pack[i] = temp.qty_pack
        for (a in total.pack) {
            if (total.pack[a] == '') {
                total.pack[a] = 0
            }
            tot += parseInt(total.pack[a])
        }
        $('#total_qty_pack').val(tot)
        $('#table_show').append(
            '<tr>' +
            '<td>' + i + '</td>' +
            '<td>' + temp.barcode + '</td>' +
            '<td>' + temp.nama + '</td>' +
            '<td>' + temp.qty_pick + '</td>' +
            '<td>' + '<input type="number" value="' + temp.qty_pack + '" id="qty_pack" onkeyup="press(this.value,' + i + ')"  name="qty_pack_' + i + '" class="form-control">' + '</td>' +
            '<input type="number" value="' + temp.qty_pack + '" id="qty_pack" onkeyup="press(this.value,' + i + ')"  name="qty_pack_' + i + '" class="form-control">' +
            '</tr>' +
            '<input type="hidden" name="id_picking_' + i + '" value="' + temp.id + '">'
        )
        i++

        $('#total_qty_pick').val(total.pick)
        savedData.push(temp)

    }
    $('#fo').submit((e) => {
        if ($('#customer').children('option:selected').val() == '0') {
            e.preventDefault()
            alert("Tolong dipilih customernya")
            return false;
        }
        $('#totall').val(--i)

    })

    function press(val, i) {
        var tot = 0;
        for (var p = 0; p <= savedData.length; p++) {
            if (p == i) {
                total.pack[p] = val
            }
        }
        for (a in total.pack) {
            if (total.pack[a] == '') {
                total.pack[a] = 0
            }
            tot += parseInt(total.pack[a])
        }
        $('#total_qty_pack').val(tot)
    }
</script>

<?php include('../templates/footer.php') ?>