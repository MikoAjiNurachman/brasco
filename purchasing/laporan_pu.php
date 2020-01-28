<?php $role = "procurement" ?>

<?php
require '../env.php';
$title = "Laporan Barang Masuk";
$done = true;
$query = "SELECT * FROM purchasing";
if (isset($_GET['err'])) if (intval($_GET['err']) == 1) alert('Tidak diperbolehkan!');
if (isset($_POST['submit'])) {
    extract($_POST);
    if ($kode == '' && $tanggal1 == '' && $tanggal2 == '') {
        alert('Tolong diisi semua');
        $done = false;
    } else if ($tanggal1 == '' && $tanggal2 == '') {
        $query = query("SELECT * FROM purchasing_item WHERE kode_pu = '$kode' ");
        if (is_null($query[0])) {
            alert('Tidak ditemukan kode!');
            $done = false;
        }
    } else if ($tanggal2 == '' && $kode == '') {
        $query1 = query("SELECT * FROM purchasing WHERE tanggal_terima = CAST('$tanggal1' AS DATE)");
        if (is_null($query1[0])) {
            alert('Tidak ditemukan tanggal!');
            $done = false;
        }
        if ($done) {
            $kode = $query1[0]['kode'];
            $query = query("SELECT * FROM purchasing_item WHERE kode_pu = '$kode'");
        }
    } else if ($kode == '') {
        $query1 = query("SELECT * FROM purchasing WHERE tanggal_terima BETWEEN CAST('$tanggal1' AS DATE) AND CAST('$tanggal2' AS DATE)");
        if (is_null($query1[0])) {
            alert('Tidak ditemukan tanggal!');
            $done = false;
        }
        if ($done) {
            $kode = $query1[0]['kode'];
            $query = query("SELECT * FROM purchasing_item WHERE kode_pu = '$kode'");
        }
    }
    if ($done) {
        $myData = array();
        foreach ($query as $data) {
            $kode = $data['kode_pu'];
            $barcode = $data['barcode'];
            $primaryData = query("SELECT * FROM purchasing WHERE kode = '$kode'")[0];
            $data['tanggal_terima'] = $primaryData['tanggal_terima'];
            $data_inven = query("SELECT * FROM inventory WHERE barcode = '$barcode'")[0];
            $data['nama_barang'] = $data_inven['nama_barang'];
            $satuan = $data_inven['satuan'];
            $data['satuan'] = query("SELECT * FROM satuan WHERE id = '$satuan'")[0]['satuan'];
            array_push($myData, $data);
        }
    }
}
?>
<script>
    var active = 'header_purchasing';
    var active_2 = 'header_purchasing_masuk';
</script>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<style>
    .dt-button.color {
        background: #3A80D5;
        color: #fff;
        border-color: #3A80D5;
    }

    .dt-button.color:hover {
        color: #000;
        background-color: tomato;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Barang Masuk
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="box-header with-border">
                    <h3 class="box-title text-bold">Cari Berdasar</h3>
                </div>
                <div class="row pad">
                    <form action="" method="POST">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" class="col-sm-6">Tanggal Terima</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="date" name="tanggal1" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 text-center">
                            <label>s/d</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="date" name="tanggal2" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Nomor Invoice</label>
                                <div class="col-sm-3" style="margin-left: 35px;">
                                    <input type="text" name="kode" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 button-cari">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info pull-right" value="Cari" style="margin-right: 280px;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
        <?php if (isset($myData)) : ?>
            <div class="box box-info">
                <div class="box-body">
                    <div class="data-table table-responsive table" style="margin-top: 30px;">
                        <table id="data-table" class="table table-responsive  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Nama Item</th>
                                    <th>Nomor Invoice</th>
                                    <th>Tgl Terima</th>
                                    <th>QTY Terima</th>
                                    <th>Sat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                    foreach ($myData as $data) : extract($data); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $barcode ?></td>
                                        <td><?= $nama_barang ?></td>
                                        <td><?= $kode_pu ?></td>
                                        <td><?= $tanggal_terima ?></td>
                                        <td><?= $quantity_terima ?></td>
                                        <td><?= $satuan ?></td>
                                        <td><a href="purchasing/detail.php?id=<?= $id ?>" target="_blank" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                <?php $i++;
                                    endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="button-grup">
                        <div class="button1" style="margin-top: 10px;">
                            <a href="#" class="btn btn-default">Copy</a>
                            <a href="#" class="btn btn-default">CSV</a>
                            <a href="#" class="btn btn-default">Excel</a>
                            <a href="#" class="btn btn-default">PDF</a>
                            <a href="#" class="btn btn-default">Print</a>
                            <a href="#" class="btn btn-default pull-right">Close</a>
                        </div>
                    </div> -->
                </div>
            </div>
        <?php endif; ?>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- script buat button print copy csv excel pdf -->
<script>
    $(function() {
        $('#example1').DataTable()
        $('#data-table').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    className: 'color',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    className: 'color',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'excel',
                    className: 'color',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'color',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    className: 'color',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ]
        })
    })
</script>
<?php include('../templates/footer.php') ?>