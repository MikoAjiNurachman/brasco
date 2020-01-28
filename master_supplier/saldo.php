<?php $role = "procurement" ?>

<script>
    var active = 'header_supplier';
    var active_2 = 'header_supplier_saldo';
</script>
<?php
$title = "Master Supplier Dengan Saldo";
?>

<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Supplier dengan saldo
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
                <h3 class="box-title">Supplier dengan Saldo</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <h4>LIHAT MASTER SUPPLIER DENGAN SALDO</h4>
                <form style="margin-top: 20px;" class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-xs-4">Kode Supplier</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Nama Supplier</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Alamat</label>
                            <div class="col-xs-8">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Kota</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">kode Pos</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">PKP</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Telepon</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Fax</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Handphone</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Contact Name</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Email</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-xs-4">Kredit</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">TOP</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Saldo Awal</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Saldo Jalan</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun 1</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun 2</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun 3</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun 4</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Jumlah Beli Tahun 5</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4">Tanggal Beli Akhir</label>
                            <div class="col-xs-8">
                                <div class="input-group">
                                    <input type="date" id="formtanggal" class="form-control">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="data-table">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Jumlah</th>
                                <th>Outstanding</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Inv-000001</td>
                                <td>dd/mm/yy</td>
                                <td>dd/mm/yy</td>
                                <td>1500000000</td>
                                <td>1000000000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UM-000001</td>
                                <td>dd/mm/yy</td>
                                <td>dd/mm/yy</td>
                                <td>1500000000</td>
                                <td>500000000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>