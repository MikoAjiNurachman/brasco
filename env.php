<?php
// $base_url = "http://192.168.0.100:8080/brasco/";
$base_url = "http://localhost/brasco/";
// $base_url = "http://192.168.56.1:8080/brasco/";

// $base_url = 'http://192.168.0.112:8080/brasco/';
$host = "localhost";
$user = "root";
$password = "";
$dbname = "brasco_pusat";
$conn = mysqli_connect($host, $user, $password, $dbname);
function cekAdmin($role)
{
  global $base_url;
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['is_admin'])) {
    return header("Location: " . $base_url . "login.php?err=1  ");
  }
  if ($_SESSION['admin']['groupType'] == 'superadmin') {
    $role = 'superadmin';
  } elseif ($_SESSION['admin']['groupType'] !== $role) {
    // if (is_null($role_index)) {
    //   return header("Location: " . $base_url . "index.php?err=1  ");
    // } else {
    $role = $_SESSION['admin']['groupType'];
    // }

  }
}

function jquery()
{
  echo '<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>';
}
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  if (mysqli_affected_rows($conn) < 1) {
    return false;
    exit();
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
function checkId($table, $id, $prefix)
{
  $query = "SELECT * FROM ${table} ORDER BY ${id} DESC LIMIT 1";
  $query = query($query);
  if (!isset($query[0][$id])) {
    $id = $prefix . '-001';
  } else {
    $id = tambahId(strval($query[0][$id]), $prefix);
  }
  return $id;
}
/** 	tambahID
 * 	
 *	Untuk menambah ID secara Otomatis
 *	@param $id ID yang akan diganti
 * @return $id ID yang sudah diganti
 */
function tambahId($id, $prefix)
{
  $id = intval(substr($id, -3));
  if ($id < 9) {
    $id = $prefix . '-00' . ++$id;
  } else if ($id == 9) {
    $id = $prefix . '-010';
  } else if ($id < 99) {
    $id = $prefix . '-0' . ++$id;
  } else if ($id == 99) {
    $id = $prefix . '-100';
  } else {
    $id = $prefix . '-' . ++$id;
  }
  return $id;
}
function alert($word)
{
  echo "<script>alert('" . $word . "')</script>";
}

function lanjutkan($sql, $word)
{
  global $conn;
  if ($sql) {
    alert('Data berhasil ' . $word . '!');
  } else {
    alert('Data gagal ' . $word . '!');
    echo mysqli_error($conn);
    exit();
  }
}
function status($st)
{
  if ($st == 'belum_approve') {
    return 'Belum Diapprove';
  }
  if ($st == 'approve') {
    return 'Approve';
  }
  if ($st == 'batal') {
    return 'Batal';
  }
}

function show_invoice($kode_customer, $nomor_packing)
{
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
      $sessData['quantity'] = $dataInventory['quantity'];
      $sessData['totalHarga'] = intval($sessData['quantity']) * intval($hargaSatuan);
      $sessData['harga_satuan'] = $hargaSatuan;
      $sessData['nama_item'] = $dataInventory['nama_barang'];

      array_push($dataModal, $sessData);
    }
  }
  return $dataModal;
}


function penyebut($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}

function terbilang($nilai)
{
  if ($nilai < 0) {
    $hasil = "minus " . trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }
  return $hasil;
}
