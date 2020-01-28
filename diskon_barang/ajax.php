<?php $role = "inventory" ?>

<?php

require '../env.php';
header('Content-Type: Application/Json');
if (isset($_GET['request'])) {
    $req = $_GET['request'];
    extract($_GET);
    if ($req == 'nama_cabang') {
        $data = query("SELECT * FROM customer WHERE kode ='$kode'")[0];
        echo json_encode($data);
    }
    if ($req == 'barcode') {
        $data = query("SELECT * FROM inventory WHERE barcode = '$data' ")[0];
        echo json_encode($data);
    }
    if ($req == 'satuan') {
        $data = query("SELECT * FROM satuan WHERE id = '$data'")[0];
        echo json_encode($data);
    }
}
