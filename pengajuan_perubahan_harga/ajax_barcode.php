<?php $role = "inventory" ?>

<?php

require('../env.php');
cekAdmin($role);
$id_admin = $_SESSION['admin']['id'];
if (isset($_POST['barcode'])) {
    $barcode = $_POST['barcode'];
    header('Content-Type: Application/Json');
    $sql = mysqli_query($conn, "SELECT * FROM inventory WHERE barcode = '$barcode'");
    $data = mysqli_fetch_assoc($sql);
    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(['msg' => 'Tidak Ditemukan Data', 'err' => mysqli_error($conn)]);
    }
    mysqli_close($conn);
}

if (isset($_POST['simpan'])) {
    header('Content-Type: Application/Json');
    $input = $_POST['data'];
    $inti = $_POST['inti'];
    $nomor_pengajuan = $inti['nomor_pengajuan'];
    $tipe_customer  = $inti['tipe_customer'];
    $tanggal = $inti['tanggal'];



    $sql = "INSERT INTO pengajuan_perubahan_harga(nomor_pengajuan,tipe_customer,tanggal_pengajuan,id_admin, id_edit_admin) VALUES('$nomor_pengajuan','$tipe_customer',CAST('$tanggal' AS DATE),'$id_admin','0');";
    foreach ($input as $data) {
        $barcode = $data['barcode'];
        $harga_lama = $data['harga_jual_lama'];
        $harga_baru = $data['harga_jual_baru'];
        $ket = $data['keterangan'];

        $sql .= "INSERT INTO pph_item(nomor_pengajuan,tanggal,tipe_customer,barcode_inventory,harga_jual_lama,harga_jual_baru,keterangan,id_admin, id_edit_admin) VALUES('$nomor_pengajuan',CAST('$tanggal' AS DATE),'$tipe_customer','$barcode','$harga_lama','$harga_baru','$ket','$id_admin','0');";
    }
    $dataW = explode("-", $nomor_pengajuan)[1];
    $sql .= "UPDATE counter SET digit = '$dataW' WHERE tabel = 'pengajuan_perubahan_harga';";
    $query2 = mysqli_multi_query($conn, $sql);
    if ($query2) {
        echo json_encode(['msg' => 'berhasil']);
    } else {
        echo json_encode([
            'err' => mysqli_error($conn)
        ]);
    }
}

if (isset($_POST['request'])) {
    extract($_POST);
    if ($request == "cari") {
    }
    if ($request == 'kirim') {
    }
}
