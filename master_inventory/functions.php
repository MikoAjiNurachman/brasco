<?php $role = "inventory" ?>

<?php
include '../env.php';
cekAdmin($role);
$conn = mysqli_connect($host, $user, $password, $dbname);


function tambah($data)
{
	global $conn;
	$id_admin = $_SESSION['admin']['id'];
	$barcode = htmlspecialchars($data['barcode']);
	$nama_barang = htmlspecialchars($data['nama_barang']);
	$satuan = htmlspecialchars($data['satuan']);
	$id_tipe_barang = htmlspecialchars($data['id_tipe_barang']);
	$harga_jual1 = htmlspecialchars($data['harga_jual1']);
	$harga_jual2 = htmlspecialchars($data['harga_jual2']);
	$harga_jual3 = htmlspecialchars($data['harga_jual3']);
	$query = " INSERT INTO inventory(barcode,nama_barang,satuan,id_tipe_barang,harga_jual1,harga_jual2,harga_jual3, id_admin, id_edit_admin)         
	VALUES 
	('$barcode','$nama_barang','$satuan','$id_tipe_barang','$harga_jual1','$harga_jual2','$harga_jual3', '$id_admin', '0')";
	$thread = mysqli_query($conn, $query);
	if (!$thread) {
		echo mysqli_error($conn);
		exit();
	}
	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM inventory WHERE id=$id");
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;
	$id_admin = $_SESSION['admin']['id'];
	$barcode = htmlspecialchars($data['barcode']);
	$nama_barang = htmlspecialchars($data['nama_barang']);
	$satuan = htmlspecialchars($data['id_satuan']);
	$id_tipe_barang = htmlspecialchars($data['id_tipe_barang']);
	$harga_jual1 = htmlspecialchars($data['harga_jual1']);
	$harga_jual2 = htmlspecialchars($data['harga_jual2']);
	$harga_jual3 = htmlspecialchars($data['harga_jual3']);
	$id = $data['id'];
	$query = " UPDATE inventory SET
	barcode = '$barcode',
	nama_barang = '$nama_barang',
	satuan = '$satuan',
	id_tipe_barang = '$id_tipe_barang',
	harga_jual1 = '$harga_jual1',
	harga_jual2 = '$harga_jual2',
	harga_jual3 = '$harga_jual3',
	id_edit_admin = '$id_admin'
	WHERE id='$id'
	";
	$thread = mysqli_query($conn, $query);
	if (!$thread) {
		echo mysqli_error($conn);
		exit();
	}
	return mysqli_affected_rows($conn);
}

function cariBarang()
{
	global $conn;
	$return = query('SELECT * FROM tipe_barang');
	return $return;
}
