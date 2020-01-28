<?php $role = "utility" ?>

<?php require_once("../env.php"); ?>
<?php
$title = "Setting Counter";
cekAdmin($role);
$sess = $_SESSION['admin']['id'];
if (isset($_POST['simpan'])) {
    $sql = '';
    extract($_POST);
    if (count(array_unique($_POST['header'])) < count($_POST['header'])) {
        alert("Header ada yang sama!");
    } else {
        for ($i = 0; $i < count($_POST['header']); $i++) {
            $sql .= "UPDATE counter SET header = '$header[$i]', digit = '$digit[$i]',id_edit_admin = '$sess' WHERE tabel = '$tabel[$i]';" . PHP_EOL;
        }
        lanjutkan(mysqli_multi_query($conn, $sql), "Diubah!");
        header('Refresh:0');
    }
}

?>

<?php include('../templates/header.php') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-pinfo">
            <div class="box-header with-border">
                <h3 class="box-title">Setting No Counter</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Informasi!</h4>
                    Format no counter ini bisa di setting bulanan atau bulanan, jadi andai bulanan setiap bulan di edit untuk reset no counter kembali
                </div>
                <form action="" method="POST">
                    <div class="data-table">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped ">
                                <thead>
                                    <th>Nama Counter</th>
                                    <th>Header 2(digit)</th>
                                    <th>No Counter 8(digit)</th>
                                </thead>
                                <tbody>
                                    <?php foreach (query("SELECT * FROM counter") as $data) : ?>
                                        <tr>
                                            <td><?= $data['nama'] ?></td>
                                            <td><input type="text" name="header[]" value="<?= $data['header'] ?>" class="form-control"> </td>
                                            <td><input type="number" name="digit[]" value="<?= $data['digit'] ?>" class="form-control"></td>
                                            <input type="hidden" name="tabel[]" value="<?= $data['tabel'] ?>">
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pull-right pad">
                        <button class="btn btn-danger">Reset</button>
                        <button class="btn btn-info" name="simpan" type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
<script>
    var active = 'header_counter'
</script>
<?php include('../templates/footer.php') ?>