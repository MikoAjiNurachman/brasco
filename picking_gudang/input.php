<?php $role = "pemasaran" ?>

<?php
require '../env.php';
cekAdmin($role);
$title = "Input Picking Gudang";
$query = query('SELECT * FROM counter WHERE tabel = "picking"')[0];
$nomor_order = '';
$kode_customer = '';
$update = true; // penanda update atau tidak
$item = array();
$nomor_pick = $query['header'] . "-" . (intval($query['digit']));

if (isset($_GET['nomor'])) {
    $nomor_order = $_GET['nomor'];
    $checking_picking = query("SELECT  * FROM picking WHERE nomor_picking = '$nomor_pick'")[0];
    if ($checking_picking['nomor_order'] !== $nomor_order) {
        $nomor_pick++;
        $update = false;
    }
    $data = query("SELECT * FROM order_gudang WHERE nomor_order = '$nomor_order'")[0];
    $kode_customer = $data['kode_customer'];
    $item = array();
    $query = query("SELECT * FROM order_gudang_item WHERE nomor_order = '$nomor_order'");
    foreach ($query as $blaa) {
        $barcode = $blaa['barcode'];
        $inven = query("SELECT * FROM inventory WHERE barcode = '$barcode'")[0];
        $sat = $inven['satuan'];
        $satuan = query("SELECT * FROM satuan WHERE id = '$sat'")[0];
        $blaa['satuan'] = $satuan['satuan'];
        $blaa['nama_item'] = $inven['nama_barang'];
        array_push($item, $blaa);
    }
}
if (isset($_POST['submit'])) {
    $sql = '';
    $totalQuantity = 0;
    $sess = $_SESSION['admin']['id'];
    extract($_POST);
    $time = strtotime($tanggal);
    $tanggal  = date('Y-m-d', $time);
    for ($i2 = 1; $i2 <= $total; $i2++) {
        foreach ($item as $now) {
            $id = $_POST['id_' . $i2];
            if (intval($now['id']) == intval($id)) {
                $quantity_pick = $_POST['quantity_pick_' . $i2];
                extract($now);
                if ($update) {
                    $selisih = query("SELECT * FROM picking_item WHERE id_order_item = '$id'")[0];
                    $quantity_pick = intval($selisih['quantity_picking']) + intval($quantity_pick);
                    $sql .= "UPDATE picking_item SET quantity_picking = '$quantity_pick', id_edit_admin = '$sess' WHERE id_order_item = '$id';";
                } else {
                    $sql .= "INSERT INTO picking_item(nomor_picking,barcode,id_order_item,quantity_picking,quantity_order,id_admin,id_edit_admin) VALUES('$nomor_picking','$barcode','$id','$quantity_pick','$quantity','$sess','0');";
                }

                $totalQuantity += intval($quantity_pick);
            }
        }
    }

    if ($update) {
        $sql .= "UPDATE picking SET status = '$status',total = '$totalQuantity' ,id_edit_admin  = '$sess' WHERE nomor_order = '$nomor_order';";
    } else {
        $data = explode("-", $nomor_picking)[1];
        $sql .= "UPDATE counter SET digit = '$data' WHERE tabel = 'picking';";

        $sql .= "INSERT INTO picking(nomor_picking,nomor_order,kode_customer,status,total,tanggal,id_admin,id_edit_admin) VALUES('$nomor_picking','$nomor_order','$kode','$status','$totalQuantity','$tanggal','$sess','0');";
    }

    $query = mysqli_multi_query($conn, $sql);
    lanjutkan($query, "Dibuat!");
    $return = true;
}
?>
<?php if (isset($return)) : ?>
    <script>
        window.stop();
        window.location.href = 'input.php';
    </script>
<?php endif; ?>
<script>
    var active = 'header_picking';
    var active_2 = 'header_picking_gudang';
</script>

<?php include('../templates/header.php') ?>
<form action="" method="POST" id="picki" class="form-horizontal">
    <div class="content-wrapper">

        <!-- M ain content -->
        <section class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Picking Gudang</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3">Tanggal</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" readonly value="<?= date('Y-m-d') ?>" name="tanggal" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">No Pick</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" readonly value="<?= $nomor_pick ?>" name="nomor_picking" id="pick">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-3">No Order</label>
                                <div class="col-sm-6 col-xs-6">
                                    <input type="text" class="form-control" id="nomor_order" readonly name="nomor_order" value="<?= $nomor_order ?>">
                                </div>
                                <div class="col-sm-1 col-xs-1">
                                    <a data-toggle="modal" data-target="#modal2" style="cursor : pointer; color: #000;"><i class="fa fa-search fa-2x"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Kode Customer</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="kode" readonly id="kode_customer" value="<?= $kode_customer ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3">Status</label>
                                <div class="col-sm-6">
                                    <select id="select" name="status" class="form-control">
                                        <option value="0"> - Pilih Status - </option>
                                        <option>Selesai</option>
                                        <option>Proses</option>
                                    </select>
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
                                        <h4 class="modal-title text-center">Pilih Order</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-data">
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
                                            <div class="box-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Order</th>
                                                            <th>Kode Customer</th>
                                                            <th>Qty Order</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="cari_so_tabel">
                                                        <?php $i_m1 = 1;
                                                        foreach (query("SELECT * FROM order_gudang") as $data_so) : $so =  $data_so['nomor_order'];
                                                            $ko = $data_so['kode_customer'];
                                                        ?>
                                                            <tr>
                                                                <td><?= $i_m1 ?></td>
                                                                <td><?= $data_so['nomor_order'];  ?></td>
                                                                <td><?= $data_so['kode_customer'] ?></td>
                                                                <td><?= $data_so['total'] ?></td>
                                                                <td><a class="btn btn-primary" href="picking_gudang/input.php?nomor=<?= $so ?>">Pilih</button></td>
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
                            </div>
                        </div>
                        <!-- /. modal done -->
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark" align="center">
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Item</th>
                                        <th>Satuan</th>
                                        <th>Qty Order</th>
                                        <?php if ($update) : ?>
                                            <th>Qty Sudah Dipicking</th>
                                        <?php endif; ?>
                                        <th>Qty Pick</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php $i = 1;
                                    foreach ($item as $now) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $now['barcode'] ?></td>
                                            <td><?= $now['nama_item'] ?></td>
                                            <td><?= $now['satuan'] ?></td>
                                            <td><?= $now['quantity'] ?></td>
                                            <?php if ($update) {
                                                $qty = query("SELECT * FROM picking_item WHERE id_order_item = '$now[id]'")[0];
                                                $qty_sudah_pick =  intval($qty['quantity_picking']);
                                                echo "<td>" . $qty_sudah_pick . "</td>";
                                            } ?>
                                            <td>
                                                <input type="text" class="form-control" name="quantity_pick_<?= $i ?>"></td>
                                            <input type="hidden" name="id_<?= $i ?>" value="<?= $now['id'] ?>">
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group pull-right">
                            <input type="hidden" name="total" value="<?= --$i ?>">
                            <button class="btn btn-danger">Reset</button>
                            <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</form>
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $("#picki").submit(e => {
        var is = $('#select').children('option:selected').val();
        if (parseInt(is) == 0) {
            alert("Tolong dipilih Statusnya");
            e.preventDefault();
            return false;
        }
    })

    function cari_so(kode, customer) {
        $('#nomor_order').val(kode)
        $('#kode_customer').val(customer)
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