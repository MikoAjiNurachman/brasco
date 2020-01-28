<?php
include '../env.php';
if (isset($_GET['kode_bank'])) {
    $kode_bank = $_GET['kode_bank'];
    $query = mysqli_query($conn, "DELETE FROM bank WHERE kode_bank = '$kode_bank'");
    if ($query) {
        header('Location: master_bank.php'); ?>
        <script type="text/javascript">
            alert("Data Berhasil Dihapus !")
        </script>
    <?php
        } else {
            header('Location: master_bank.php'); ?>
        <script type="text/javascript">
            alert("Data Gagal Dihapus !")
        </script>
<?php }
} ?>