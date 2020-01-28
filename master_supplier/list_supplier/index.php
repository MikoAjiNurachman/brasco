<?php $role = "procurement" ?>

<?php
$title = 'List Supplier';
$tampilkan = true;
$i = 1;
include '../../env.php';
$result = query("SELECT * FROM supplier");

if (isset($_POST['show'])) {
    extract($_POST);
    if ($kode2 == '') {
        $query = "SELECT * FROM supplier WHERE $sort_by = '$kode1'";
    } else {
        $query = "SELECT * FROM supplier WHERE $sort_by BETWEEN '$kode1' AND '$kode2'";
    }
    $tampilkan = true;
    $result = query($query);
}

?>

<script>
    var active = 'header_supplier';
    var active_2 = 'header_supplier_list'
</script>



<?php include('../../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">List Supplier</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="box-body">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-xs-10">
                                                <input type="text" name="kode1" placeholder="KODE SUPLIER..." class="form-control">
                                            </div>
                                            <label class="control-label col-xs-2"><i class="fa fa-search fa-2x"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="text-center">
                                            <label class="contorl-label">s/d</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-xs-10">
                                                <input type="text" name="kode2" placeholder="KODE SUPLIER..." class="form-control">
                                            </div>
                                            <label class="col-xs-2 control-label"><i class="fa fa-search fa-2x"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class=" control-label">Urut Berdasarkan</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="sort_by">
                                            <option value="kode">Kode</option>
                                            <option value="nama">Nama</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="">
                                <button type="submit" name="show" class="btn btn-primary">Tampilkan</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="data-table">
                <?php if ($tampilkan) : ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Kode Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Kode Pos</th>
                                        <th>No telepon</th>
                                        <th>Fax</th>
                                        <th>Handphone</th>
                                        <th>Contact Name</th>
                                        <th>Email</th>
                                        <th>Kredit</th>
                                        <th>TOP</th>
                                        <th>PKP</th>
                                        <th>Tanggal Entry</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $data) : extract($data); ?>
                                        <tr>
                                            <td class="text-center"><a href="master_supplier/saldo.php?kode=<?= $kode ?>" target="_blank" title="Lihat Supplier dengan Saldo"><i class="fa fa-info-circle fa-lg"></i></a></td>
                                            <td><?= $i++ ?></td>
                                            <td><?= $kode ?></td>
                                            <td><?= $nama ?></td>
                                            <td><?= $alamat ?></td>
                                            <td><?= $kota ?></td>
                                            <td><?= $kodepos ?></td>
                                            <td><?= $telepon ?></td>
                                            <td><?= $fax ?></td>
                                            <td><?= $handphone ?></td>
                                            <td><?= $contact_name ?></td>
                                            <td><?= $email ?></td>
                                            <td><?= $kredit ?></td>
                                            <td><?= $top ?></td>
                                            <td><?= $pkp ?></td>
                                            <td><?= $created_at ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.box-footer-->
</div>
<!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- button print csv excel pdf copy -->
<script type="text/javascript">
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
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
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
                    text: 'Excel',
                    exporOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV'
                },
                {
                    extend: 'copy',
                    text: 'Copy'
                }
            ]
        })
    })
</script>

<?php include('../../templates/footer.php') ?>