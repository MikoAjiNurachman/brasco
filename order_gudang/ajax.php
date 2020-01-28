<?php $role = "pemasaran" ?>

<?php
include '../env.php';
if (isset($_POST)) {
    header('Content-Type: Application/Json');
    extract($_POST);
    if (isset($request)) {
        if ($request == "cari_customer") {
            $sql = "SELECT * FROM customer WHERE kode = '$data'";
        }
        if ($request == 'cari_barcode') {
            $sql = "SELECT * FROM inventory WHERE barcode = '$data'";
        }
        if ($request == 'cari_satuan') {
            $sql = "SELECT * FROM satuan WHERE id = '$data'";
        }
        if ($request == 'cari_item') {
            $sql = "SELECT * FROM sales_order_item WHERE nomor_so = '$data'";
        }
        if ($request == 'cari_so') {
            $sql = "SELECT * FROM sales_order WHERE tanggal_so = '$data'";
        }
        if ($request == 'cari_item_gudang') {
            $sql = "SELECT * FROM order_gudang_item WHERE nomor_order = '$data'";
        }
        $query = query($sql);
        echo json_encode($query);
    }
    if (isset($find)) {
        if ($find == 'cari_so_item') {
            $array = [];
            foreach (query("SELECT * FROM sales_order_item WHERE nomor_so = '$data'") as $item_so) {
                $inventory = query("SELECT * FROM inventory WHERE barcode = '$item_so[barcode]'")[0];
                $satuan = query("SELECT * FROM satuan WHERE id = '$inventory[satuan]'")[0];
                $data_cust = query("SELECT * FROM customer WHERE kode = '$customer'")[0];
                $string = "harga_jual" . $data_cust['tipe_customer'];
                $inside_array = [
                    "so_item" => $item_so,
                    "inventory" => $inventory,
                    "satuan" => $satuan,
                    "harga_jual" => $inventory[$string]
                ];
                array_push($array, $inside_array);
            }
            echo json_encode($array);
        }
    }
}
if (isset($_GET['nomor'])) {
    $kode = $_GET['nomor'];
    $sql = "DELETE FROM sales_order WHERE nomor_so = '$kode';";
    $sql .= "DELETE FROM sales_order_item WHERE nomor_so = '$kode';";
    $query2 = mysqli_multi_query($conn, $sql);
    lanjutkan($query2, "Dihapus");
    sleep(1.5);
    header("Location: laporanSalesOrder.php");
}
