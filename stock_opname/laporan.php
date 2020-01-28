<?php $role = "inventory" ?>

<?php
session_start();
$title = "Laporan Stock Opname";
$id = $_SESSION['admin']['id'];
include '../env.php';
cekAdmin($role);
if (isset($_GET['barcode1'])) {
    extract($_GET);
    $query = "SELECT * FROM inventory WHERE barcode BETWEEN '$barcode1' AND '$barcode2'";
    $result = query($query);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <base href="<?= $base_url ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title id="title">Laporan Stock Opname</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Nama Item</th>
                    <th scope="col">Satuan</th>
                    <th class="text-center" scope="col">Quantity Opname</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($result)) : ?>
                    <?php $i = 1;
                        foreach ($result as $res) :
                            $satuan = query("SELECT satuan FROM satuan WHERE id='$res[satuan]'");
                            foreach ($satuan as $asSatuan) {
                                ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $res['barcode'] ?></td>
                                <input type="hidden" name="barcode[]" value="<?= $res['barcode'] ?>">
                                <td><?= $res['nama_barang'] ?></td>
                                <td><?= $asSatuan['satuan'] ?></td>
                                <td></td>
                            </tr>
                    <?php $i++;
                            }
                        endforeach; ?>
                    <input type="hidden" name="total" value="<?= --$i ?>">
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(() => {
            window.print();
            window.onafterprint = window.close;

        })
    </script>

</body>

</html>