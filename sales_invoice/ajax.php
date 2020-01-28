<?php $role = "pemasaran" ?>

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
}
if (isset($_GET['request'])) {
    $req = $_GET['request'];
    extract($_GET);
    if ($req == 'cari_customer') {
        $query = query("SELECT * FROM customer WHERE kode = '$data'")[0];
        echo json_encode($query);
    }
    if ($req == 'hasil_packing') {
        $dataModal = array();
        $kodeCustomer = $kode_customer;
        foreach (query("SELECT * FROM packing WHERE nomor_packing = '$nomor_packing'") as $data) {
            foreach (query("SELECT * FROM packing_item WHERE nomor_packing = '$data[nomor_packing]'") as $data2) {
                $dataPickingItem  = query("SELECT * FROM picking_item WHERE id = '$data2[id_picking_item]'")[0];
                $dataInventory = query("SELECT * FROM inventory WHERE barcode = '$dataPickingItem[barcode]'")[0];
                $dataCustomer = query("SELECT * FROM customer WHERE kode = '$kodeCustomer'")[0];

                if ($dataCustomer['tipe_customer'] == '1') $hargaSatuan = $dataInventory['harga_jual1'];
                if ($dataCustomer['tipe_customer'] == '2') $hargaSatuan = $dataInventory['harga_jual2'];
                if ($dataCustomer['tipe_customer'] == '3') $hargaSatuan = $dataInventory['harga_jual3'];

                $sessData['barcode'] = $dataPickingItem['barcode'];
                $sessData['nomor_packing'] = $data['nomor_packing'];
                $sessData['quantity_packing'] = $dataPickingItem['quantity_packing'];
                $sessData['quantity'] = $dataInventory['quantity'];
                $sessData['totalHarga'] = intval($sessData['quantity']) * intval($hargaSatuan);
                $sessData['harga_satuan'] = $hargaSatuan;
                $sessData['nama_item'] = $dataInventory['nama_barang'];

                array_push($dataModal, $sessData);
            }
        }
        echo json_encode($dataModal);
    }
}
