<?php $role = "pemasaran" ?>

<?php
include '../env.php';
$title = "Laporan Sales Order";
if (isset($_POST['cari'])) {
    extract($_POST);
    $sql = "SELECT * FROM sales_order WHERE ";
    if ($customer !== '') {
        $customer = rtrim($customer);
        $sql .= "kode_customer = '$customer' ";
    }
    if ($tanggal1 !== '') {
        if ($customer !== '') {
            $sql .= " AND ";
        }
        $sql2 = "tanggal_so = '$tanggal1'";
        if ($tanggal2 !== '') {
            $sql2 = "tanggal_so BETWEEN CAST('$tanggal1' AS DATE) AND CAST('$tanggal2' AS DATE)";
        }
        $sql .= $sql2;
    }
    if ($customer == 'sen') {
        $sql = "SELECT * FROM sales_order ";
    }
    $query = query($sql);
}

?>
<script>
    var active = 'header_sales';
    var active_2 = 'header_sales_laporan';
</script>

<?php include('../templates/header.php') ?>

<div class="content-wrapper">

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3>LAPORAN SALES ORDER</h3>
            </div>
            <div class="box-body">

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tanggal </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="display: inline-flex; ">
                                    <input type="date" name="tanggal1" class="form-control">
                                    <i style="font-size: 30px; margin-left: 30px;" class="fa fa-calendar"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label style="max-width: 100%; text-align: center;">s/d</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="display: inline-flex; ">
                                    <input type="date" name="tanggal2" class="form-control">
                                    <i style="font-size: 30px; margin-left: 30px" class="fa fa-calendar"></i>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Customer</label>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="customer">
                                    <option value="sen">-Semua Customer-</option>
                                    <?php $s = query("SELECT * FROM customer");
                                    foreach ($s as $d) : ?>
                                        <option value="<?= $d['kode'] ?>"><?= $d['nama'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="">-Tidak pilih-</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary" name="cari" type="submit">Search</button>
                            </div>
                        </div>
                </form>
            </div>
            <?php if (isset($query)) : ?>
                <!-- <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <button class="btn btn-light">Excel</button>
                        <button class="btn btn-light">PDF</button>
                        <button class="btn btn-light">Print</button>

                    </div>
                </div>
            </div> -->

                <div style="margin-top: 5px">

                    <table id="data-table" class="table table-bordered ">
                        <thead align="center">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>No Sales Order</center>
                                </th>
                                <th>
                                    <center>Tanggal Sales Order</center>
                                </th>
                                <th>
                                    <center>Customer</center>
                                </th>
                                <th>
                                    <center>Total Item</center>
                                </th>
                                <th>
                                    <center>Keterangan</center>
                                </th>
                                <th>
                                    <center>Aksi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php $i = 1;
                                foreach ($query as $t) : extract($t);
                                    $src = query("SELECT * FROM customer WHERE kode='$kode_customer'")[0]; ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $nomor_so ?></td>
                                    <td><?= $tanggal_so ?></td>
                                    <td><?= $src['nama'] ?></td>
                                    <td><?= $total ?></td>
                                    <td><?= $keterangan ?></td>
                                    <td>
                                        <a title="Edit" href="sales_order/edit_so.php?nomor=<?= $nomor_so ?>"><i style="color: blue;font-size:24px;" class="fa fa-pencil"></i></a>
                                        <a title="Hapus" onclick="return confirm('Yakin ingin menghapus?')" href="sales_order/ajax.php?nomor=<?= $nomor_so ?>"><i style="color: red;font-size:24px;" class="fa fa-trash"></i></a>
                                        <a title="Detail" target="_blank" href="sales_order/detail.php?nomor=<?= $nomor_so ?>"><i style="color: green;font-size:24px;" class="fa fa-info"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
</div>

</section>

</div>

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>

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
                    orientation: 'potrait',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }
            ]
        })
    })
</script>

<?php include('../templates/footer.php') ?>