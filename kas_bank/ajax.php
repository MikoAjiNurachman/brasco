<?php
include '../env.php';
session_start();
$sess = $_SESSION['admin']['id'];
$parameter = $_POST['params'];
if ($parameter == 1) {
	$kode_bank = $_POST['kode_bank'];
	$query = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM bank WHERE kode_bank = '$kode_bank'"));
	echo json_encode($query);
} else if ($parameter == 2) {
	$kode_akun = $_POST['kode_akun'];
	$query = mysqli_fetch_array(mysqli_query($conn, "SELECT namaakun as nama_akun FROM ms_akun WHERE kodeakun = '$kode_akun'"));
	echo json_encode($query);
} else if ($parameter == 3) {
	$no_kas = $_POST['no_kas'];
	$tanggal_now = $_POST['tanggal_now'];
	$kode_bank = $_POST['kode_bank'];
	$nama_bank = $_POST['nama_bank'];
	$no_giro = $_POST['no_giro'];
	$tanggal_giro = $_POST['tanggal_giro'];
	$kode_akun = $_POST['kode_akun'];
	$nama_akun = $_POST['nama_akun'];
	$jumlah = $_POST['jumlah'];
	$ket = $_POST['ket'];
	$query = array();
	$kode = explode('-', $no_kas)[1];
	$qsaldo = mysqli_fetch_array(mysqli_query($conn, "SELECT saldo_jalan FROM bank WHERE kode_bank='$kode_bank'"));
	$saldo = $qsaldo['saldo_jalan'];
	$saldoInsert = $saldo - $jumlah;
	$query[1] = mysqli_query($conn, "UPDATE counter SET digit='$kode',id_edit_admin='$sess' WHERE tabel='no_kas_keluar'");
	$query[2] = mysqli_query($conn, "UPDATE bank SET saldo_jalan='$saldoInsert',id_edit_admin='$sess' WHERE kode_bank='$kode_bank'");
	$query[3] = mysqli_query($conn, "INSERT INTO bank_input_pembayaran(nomor_kas_keluar,tanggal,id_bank,no_giro,tanggal_giro,jenis_biaya,jumlah,keterangan,id_admin,id_edit_admin) VALUES('$no_kas','$tanggal_now','$kode_bank','$no_giro','$tanggal_giro','$kode_akun','$jumlah','$ket','$sess','0')");
	$query[4] = mysqli_query($conn, "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas','$kode_bank','$jumlah','Uang Keluar Dari Pembayaran','$tanggal_now','$sess','0')");
	$query[5] = mysqli_query($conn, "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas','$kode_akun','$jumlah','Uang Keluar Dari Pembayaran','$tanggal_now','$sess','0')");
	if ($query) {
		echo json_encode(['response' => "Data Tersimpan !"]);
	} else {
		echo json_encode(['response' => "Tidak Tersimpan !"]);
	}
} else if ($parameter == 4) {
	$no_kas = $_POST['no_kas'];
	$tanggal_now = $_POST['tanggal_now'];
	$kode_bank = $_POST['kode_bank'];
	$nama_bank = $_POST['nama_bank'];
	$no_giro = $_POST['no_giro'];
	$tanggal_giro = $_POST['tanggal_giro'];
	$kode_akun = $_POST['kode_akun'];
	$nama_akun = $_POST['nama_akun'];
	$jumlah = $_POST['jumlah'];
	$ket = $_POST['ket'];
	$query = array();
	$kode = explode('-', $no_kas)[1];
	$qsaldo = mysqli_fetch_array(mysqli_query($conn, "SELECT saldo_jalan FROM bank WHERE kode_bank='$kode_bank'"));
	$saldo = $qsaldo['saldo_jalan'];
	$saldoInsert = $saldo + $jumlah;
	$query[1] = mysqli_query($conn, "UPDATE counter SET digit='$kode',id_edit_admin='$sess' WHERE tabel='no_kas_masuk'");
	$query[2] = mysqli_query($conn, "UPDATE bank SET saldo_jalan='$saldoInsert',id_edit_admin='$sess' WHERE kode_bank='$kode_bank'");
	$query[3] = mysqli_query($conn, "INSERT INTO bank_input_penerimaan(nomor_kas_masuk,tanggal,id_bank,no_giro,tanggal_giro,jenis_pendapatan,jumlah,keterangan,id_admin,id_edit_admin) VALUES('$no_kas','$tanggal_now','$kode_bank','$no_giro','$tanggal_giro','$kode_akun','$jumlah','$ket','$sess','0')");
	$query[4] = mysqli_query($conn, "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas','$kode_bank','$jumlah','Uang Masuk Dari Penerimaan','$tanggal_now','$sess','0')");
	$query[5] = mysqli_query($conn, "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas','$kode_akun','$jumlah','Uang Masuk Dari Penerimaan','$tanggal_now','$sess','0')");
	if ($query) {
		echo json_encode(['response' => "Data Tersimpan !"]);
	} else {
		echo json_encode(['response' => "Tidak Tersimpan !"]);
	}
} elseif ($parameter == 5) {
	$kode_bank = $_POST['kode_bank'];
	$nama_bank = $_POST['nama_bank'];
	$saldo_awal = $_POST['saldo_awal'];
	$saldo_jalan = $_POST['saldo_jalan'];
	$nomor_akun = $_POST['nomor_akun'];
	$tipe = $_POST['tipe'];
	$query = mysqli_query($conn, "INSERT INTO bank(kode_bank,nama_bank,saldo_awal,saldo_jalan,tipe,nomor_akun,id_admin,id_edit_admin) VALUES('$kode_bank','$nama_bank','$saldo_awal','$saldo_jalan','$tipe','$nomor_akun','$sess','0')");
	if ($query) {
		echo json_encode("Data Tersimpan !");
	} else {
		echo json_encode("Tidak Tersimpan !");
	}
} elseif ($parameter == 6) {
	$kode_bank = $_POST['kode_bank'];
	$query = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_bank,saldo_jalan FROM bank WHERE kode_bank = '$kode_bank'"));
	echo json_encode($query);
} elseif ($parameter == 7) {
	extract($_POST);
	$kode1 = explode('-', $no_kas_keluar)[1];
	$kode2 = explode('-', $no_kas_masuk)[1];
	$kurang = $saldo1 - $jumlah;
	$tambah = $saldo2 + $jumlah;
	$query = array();
	$sql = "UPDATE counter SET digit='$kode1',id_edit_admin='$sess' WHERE tabel='no_kas_keluar';";
	$sql .= "UPDATE counter SET digit='$kode2',id_edit_admin='$sess' WHERE tabel='no_kas_masuk';";
	$sql .= "UPDATE bank SET saldo_jalan = '$kurang',id_edit_admin='$sess' WHERE kode_bank = '$kode_bank1';";
	$sql .= "UPDATE bank SET saldo_jalan = '$tambah',id_edit_admin='$sess' WHERE kode_bank = '$kode_bank2';";
	$sql .= "INSERT INTO bank_input_pembayaran(nomor_kas_keluar,tanggal,id_bank,jenis_biaya,jumlah,keterangan,id_admin,id_edit_admin) VALUES('$no_kas_keluar','$tanggal_now','$kode_bank1','$kode_bank2','$jumlah','$keterangan','$sess','0');";
	$sql .= "INSERT INTO bank_input_penerimaan(nomor_kas_masuk,tanggal,id_bank,jenis_pendapatan,jumlah,keterangan,id_admin,id_edit_admin) VALUES('$no_kas_masuk','$tanggal_now','$kode_bank2','$kode_bank1','$jumlah','$keterangan','$sess','0');";
	$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas_keluar','$kode_bank1','$jumlah','$keterangan','$tanggal_now','$sess','0');";
	$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin) VALUES('$no_kas_masuk','$kode_bank2','$jumlah','$keterangan','$tanggal_now','$sess','0');";
	$query = mysqli_multi_query($conn, $sql);
	if ($query) {
		echo json_encode("Data Berhasil Disimpan !");
	} else {
		echo json_encode("Data Gagal Disimpan !");
	}
} elseif ($parameter == 8) {
	extract($_POST);
	$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE kode='$kode_customer'"));
	$tahun = date('Y');
	$totals = query("SELECT * FROM `sales_invoice` WHERE YEAR(CAST(created_at AS DATE))=$tahun AND kode_customer = '$kode_customer'");
	$data['total'] = 0;
	if (count($totals) > 1) {
		foreach ($totals as $total) {
			$data['total'] += intval($total['total']);
		}
		$data['item_all'] = $totals;
	}
	echo json_encode($data);
} elseif ($parameter == 9) {
	extract($_POST);
	$query = query("SELECT * FROM supplier WHERE kode='$kode_supplier'")[0];
	$tahun = date('Y');
	$totals = query("SELECT * FROM `purchasing` WHERE YEAR(CAST(created_at AS DATE))=$tahun AND kode_supplier= '$kode_supplier'");
	$query['total'] = 0;
	if ($totals !== false) {
		foreach ($totals as $total) {
			$query['total'] += intval($total['total']);
		}
		$query['item_all'] = $totals;
	}
	echo json_encode($query);
} elseif ($parameter == 10) {
	extract($_POST);
	$query = array();
	$sql = '';
	$kode_bank = $_POST['kode_bank'];
	$nomor_akun = $_POST['nomor_akun'];
	$kode2 = explode('-', $_POST['no_transaksi'])[1];
	$outstanding = intval($_POST['outstanding']) - intval($_POST['bayar']);
	$tambah = intval($_POST['saldo_jalan']) + intval($_POST['bayar']);
	$sql .= "UPDATE counter SET digit='$kode2',id_edit_admin='$sess' WHERE tabel='no_kas_masuk';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE sales_invoice SET outstanding = '$outstanding',id_edit_admin='$sess' WHERE nomor_invoice = '$kode';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE bank SET saldo_jalan = '$tambah',id_edit_admin WHERE kode_bank = '$kode_bank';";
	$sql .= PHP_EOL;
	$sql .= "INSERT INTO bank_input_penerimaan(nomor_kas_masuk,tanggal,id_bank,jenis_biaya,jumlah,keterangan,no_giro,tanggal_giro,id_admin,id_edit_admin) VALUES('$no_transaksi','$tanggal','$kode_bank','$nomor_akun','$bayar','$keterangan','$giro','$tanggal','$sess','0');";
	$sql .= PHP_EOL;
	$jurnal = query("SELECT * FROM jurnal_referensi")[0];
	$hutang = $jurnal['hutang'];
	$j_kas = $jurnal['kas'];
	$j_bank = $jurnal['bank'];

	$sql .= PHP_EOL;
	if ($tipe == 'bank') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_transaksi','$j_kas','$bayar','Bank Pelunasan Customer','$tanggal','$sess','0',2);";
	}
	if ($tipe == 'kas') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_transaksi','$j_bank','$bayar','Kas Pelunasan Customer','$tanggal','$sess','0',1);";
	}
	$sql .= PHP_EOL;

	$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_transaksi','$hutang','$bayar','Hutang Pelunasan Customer','$tanggal','$sess','0',3);";
	$query = mysqli_multi_query($conn, $sql);
	if ($query) {
		$s = [
			'status' => 201,
			'msg' => 'Data Berhasil Disimpan!',
			'err_code' => 'successful'
		];
		echo json_encode($s);
	} else {
		$s = [
			'status' => 400,
			'msg' => 'Data gagal disimpan!',
			'err_code' => mysqli_error($conn)
		];
		echo json_encode($s);
	}
} elseif ($parameter == 11) {
	extract($_POST);
	$query = array();
	$sql = '';
	$kode_bank = $_POST['kode_bank'];
	$nomor_akun = $_POST['nomor_akun'];
	$kode2 = explode('-', $_POST['no_transaksi'])[1];
	$outstanding = intval($_POST['outstanding']) - intval($_POST['bayar']);
	$kurang = intval($_POST['saldo_jalan']) - intval($_POST['bayar']);
	$sql .= "UPDATE counter SET digit='$kode2',id_edit_admin='$sess' WHERE tabel='no_kas_keluar';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE purchasing SET outstanding = '$outstanding',id_edit_admin='$sess' WHERE kode= '$kode';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE bank SET saldo_jalan = '$kurang',id_edit_admin WHERE kode_bank = '$kode_bank';";
	$sql .= PHP_EOL;
	$sql .= "INSERT INTO bank_input_pembayaran(nomor_kas_keluar,tanggal,id_bank,jenis_biaya,jumlah,keterangan,no_giro,tanggal_giro,id_admin,id_edit_admin) VALUES('$no_transaksi','$tanggal','$kode_bank','$nomor_akun','$bayar','$keterangan','$giro','$tanggal','$sess','0');";
	$sql .= PHP_EOL;

	$jurnal = query("SELECT * FROM jurnal_referensi")[0];
	$hutang = $jurnal['hutang'];
	$j_kas = $jurnal['kas'];
	$j_bank = $jurnal['bank'];
	$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,userid,nourut) VALUES('$no_transaksi','$hutang','$bayar','PIUTANG Pelunasan Supplier','$tanggal','$sess',1);";
	$sql .= PHP_EOL;

	if ($tipe == 'bank') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,userid,nourut) VALUES('$no_transaksi','$j_kas','$bayar','Bank Pelunasan Supplier','$tanggal','$sess',3);";
	}
	if ($tipe == 'kas') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,userid,nourut) VALUES('$no_transaksi','$j_bank','$bayar','Kas Pelunasan Supplier','$tanggal','$sess',2);";
	}
	$sql .= PHP_EOL;

	$query = mysqli_multi_query($conn, $sql);
	if ($query) {
		$s = [
			'status' => 201,
			'msg' => 'Data Berhasil Disimpan!',
			'err_code' => 'successful'
		];
		echo json_encode($s);
	} else {
		$s = [
			'status' => 400,
			'msg' => 'Data gagal disimpan!',
			'err_code' => mysqli_error($conn)
		];
		echo json_encode($s);
	}
} elseif ($parameter == 12) {
	extract($_POST);
	$query = query("SELECT * FROM supplier WHERE kode='$kode_supplier'")[0];
	$tahun = date('Y');
	$totals = query("SELECT * FROM `purchasing` WHERE YEAR(CAST(created_at AS DATE))=$tahun AND kode_supplier= '$kode_supplier'");
	$query['total'] = 0;
	if ($totals !== false) {
		foreach ($totals as $total) {
			$query['total'] += intval($total['total']);
		}
		$query['item_all'] = $totals;
	}
	echo json_encode($query);
} elseif ($parameter == 13) {
	extract($_POST);
	$query = query("SELECT * FROM purchase_order WHERE kode_supplier = '$kode_supplier'");
	echo json_encode($query);
} elseif ($parameter == 14) {
	extract($_POST);
	$query = query("SELECT *  purchase_order WHERE kode = '$kode'")[0];
	echo json_encode($query);
} elseif ($parameter == 15) {
	extract($_POST);
	$query = mysqli_query($conn, "SELECT * FROM bank WHERE kode_bank = '$kode'");
	if ($query) {
		$row = mysqli_num_rows($query);
		echo json_encode($row);
	} else {
		echo json_encode(mysqli_error($conn));
	}
}
