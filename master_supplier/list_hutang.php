<?php $role = "procurement";
$title = "List Hutang" ?>

<script>
    var active = 'header_supplier';
    var active_2 = 'header_supplier_hutang';
</script>

<?php include('../templates/header.php');
include '../env.php'; ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            List Hutang
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">LIST HUTANG</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="">
                    <form style="margin-top: 10px;">

                        <div class="box-body">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select id="kode_supplier1" class="form-control">
                                        <option selected disabled>Kode Supplier</option>
                                        <?php
                                        $query = query("SELECT kode,nama FROM supplier");
                                        foreach ($query as $data) {
                                            ?>
                                            <option value="<?= $data['kode'] ?>"><?= $data['kode'] ?> - <?= $data['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group"><i>s.d.</i></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select id="kode_supplier2" class="form-control">
                                        <option selected disabled>Kode Supplier</option>
                                        <?php
                                        $query = query("SELECT kode,nama FROM supplier");
                                        foreach ($query as $data) {
                                            ?>
                                            <option value="<?= $data['kode'] ?>"><?= $data['kode'] ?> - <?= $data['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="button" id="search" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- form end -->
                </div>
                <!-- table -->
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Suplier</th>
                            <th>Nama Suplier</th>
                            <th>Saldo Awal</th>
                            <th>Saldo Jalan</th>
                            <th>Jumlah Beli</th>
                            <th>JML beli Tahun Lalu</th>
                            <th>JML beli 2 Tahun Lalu</th>
                            <th>JML beli 3 Tahun Lalu</th>
                        </tr>
                    </thead>
                    <tbody id="tables">

                    </tbody>
                </table>
                <!-- <div class="box-body pad">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default">Copy</a>
                        <a href="#" class="btn btn-default">Print</a>
                        <a href="#" class="btn btn-default">CSV</a>
                        <a href="#" class="btn btn-default">PDF</a>
                        <a href="#" class="btn btn-default">Excel</a>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-default">Close</a>
                    </div>
                </div> -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= jquery() ?>
<script type="text/javascript">
    $('#search').click(function() {
        $('#tables').html('')
        $.post('master_supplier/backend.php', {
            'params': 2,
            'kode_sup1': $('#kode_supplier1').val(),
            'kode_sup2': $('#kode_supplier2').val()
        }, function(response) {
            res = JSON.parse(response)
            no = 1
            res.forEach(element => {
                $('#tables').append(`
            <tr>
            <td>${no++}</td>
            <td>${element.kode_supplier}</td>
            <td>${element.nama_supplier}</td>
            <td>${element.saldo_awal}</td>
            <td>${element.saldo_jalan}</td>
            <td>${(!element.nol_tahun)? "-" :element.nol_tahun}</td>
            <td>${(!element.satu_tahun)? "-" :element.satu_tahun}</td>
            <td>${(!element.dua_tahun)? "-" :element.dua_tahun}</td>
            <td>${(!element.tiga_tahun)? "-" :element.tiga_tahun}</td>
            </tr>
            `)
            })
        })
    })
</script>
<?php include('../templates/footer.php') ?>