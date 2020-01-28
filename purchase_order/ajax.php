<?php $role = "procurement" ?>

<?php

require '../env.php';
header('Content-Type: Application/Json');
if (isset($_POST['request'])) {
    $req = $_POST['request'];
    extract($_POST);
    if ($req == 'data_barcode') {
        $query = query("SELECT * FROM inventory");
        echo json_encode($query);
    }
    if ($req == 'data_inventory') {
        $query = "SELECT * FROM profil WHERE id = 1";
        $sql = mysqli_fetch_assoc(mysqli_query($conn, $query));
        echo json_encode($sql);
    }
    if ($req == 'kode_po') {
        $query = query("SELECT * FROM counter WHERE tabel = 'purchase_order'")[0];
        $id = $query['header'] . "-" . (sprintf('%08s', intval($query['digit']) + 1));
        echo json_encode($id);
    }
    if ($req == 'data_supplier') {
        $query = "SELECT * FROM supplier WHERE kode = '$data' ";
        $sql = mysqli_fetch_assoc(mysqli_query($conn, $query));
        echo json_encode($sql);
    }
    if ($req == 'cari_barcode') {
        $query = "SELECT * FROM inventory WHERE barcode = '$data' ";
        $sql = mysqli_fetch_assoc(mysqli_query($conn, $query));
        echo json_encode($sql);
    }
    if ($req == 'cari_satuan') {
        $query = "SELECT * FROM satuan WHERE id = '$data' ";
        $sql = mysqli_fetch_assoc(mysqli_query($conn, $query));
        echo json_encode($sql);
    }
    if ($req == "data_po") {
        $kode = $_POST['kode'];
        $query = "SELECT * FROM purchase_order_item WHERE kode_po = '$kode'";
        $sql = query($query);
        echo json_encode($sql);
    }
    if ($req == "data_label") {
        $kode = $_POST['kode'];
        $query = "SELECT * FROM label_barcode WHERE kode_po = '$kode'";
        $sql = query($query);
        echo json_encode($sql);
    }
    if ($req == 'close') {
        $kode = $_POST['kode'];
        $query = "UPDATE purchase_order SET status = 'Closed' WHERE kode = '$kode'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo json_encode(['msg' => 'ok!']);
        } else {
            echo json_encode(['msg' => mysqli_error($conn)]);
        }
    }
}
