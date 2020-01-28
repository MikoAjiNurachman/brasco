<?php $role = "procurement" ?>

<?php

require '../env.php';
header('Content-Type: Application/Json');
if (isset($_POST['request'])) {
    $req = $_POST['request'];
    extract($_POST);
}
if (isset($_GET['request'])) {
    $req = $_GET['request'];
    extract($_GET);
    if ($req == 'data_supplier') {
        echo json_encode(query("SELECT * FROM supplier WHERE kode = '$kode'")[0]);
    }
    if ($req == 'data_inventory') {
        echo json_encode(query("SELECT * FROM inventory WHERE barcode = '$data'")[0]);
    }
    if ($req == 'data_inventory_dengan_satuan') {
        $s = query("SELECT * FROM inventory WHERE barcode = '$data'")[0];
        $item = $s['satuan'];
        $p = query("SELECT * FROM satuan WHERE id = '$item'")[0];
        $s['satuan'] = $p['satuan'];
        echo json_encode($s);
    }
}
