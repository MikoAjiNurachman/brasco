<?php $role = "pemasaran" ?>

<?php
require '../env.php';

$profile = query("SELECT * FROM profil")[0];
$invoice = query("SELECT * FROM sales_invoice WHERE nomor_invoice = '$_GET[kode]'")[0];
$foto = $profile['logo'];

// no faktur
$counter = query("SELECT * FROM counter WHERE tabel = 'faktur'")[0];
$data = $counter['header'] . "-" . $counter['digit'];
// no kwitansi
$kounter = query("SELECT * FROM counter WHERE tabel = 'kwitansi_invoice'")[0];
$data2 = $kounter['header'] . "-" . $kounter['digit'];

$harga_total = $invoice['total'];
// terbilang harga
$harga = terbilang(intval($invoice['total']));
// contact name
$kode_cus = $invoice['kode_customer'];

$cust = query("SELECT * FROM customer WHERE kode = '$kode_cus'")[0];
$kontak_name = $cust['contact_name'];
$nama_pt = $cust['nama'];

$phone = $profile['no_telp'];
$alamat = $profile['alamat'];
$cabang_mana = $profile['nama_cabang'];
$kota = $profile['kota'];
$tanggal = $invoice['tanggal'];
$tanggal2 = date("d-m-Y", strtotime($tanggal));

?>
<!DOCTYPE html>
<html>

<head>
	<title>Kwitansi</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
	<style type="text/css">
		.pt-10 {
			padding-top: 50px;
		}

		.pr-5 {
			padding-right: 30px;
			padding-left: 30px;
		}
	</style>
</head>

<body>

	<div class="content pt-5">
		<div class="container">
			<div class="row">
				<div class="col-xs-4 text-center">
					<img src="../profile/images/<?= $foto ?>" width="30%">
				</div>
				<div class="col-xs-4">
					<h4><?= $cabang_mana ?></h4>
					<p><?= $alamat ?><br>
						ph. <?= $phone ?></p>
				</div>
				<div class="col-xs-4">
					<h2 class="text-primary">Kwitansi</h2>
					<p>No Kwitansi : <?= $data2 ?></p>
				</div>
			</div>

			<div class="row pt-10">
				<div class=" ">
					<div class="col-xs-3">
						<p>Sudah Terima Dari</p>
						<p>Banyaknya Uang</p>
						<p>Untuk Melunasi Faktur</p>
					</div>
					<div class="col-xs-9">
						<p><?= $kontak_name ?> (<?= $nama_pt ?>)</p>
						<p># <?= $harga ?> # </p>
						<p><?= $data ?></p>
					</div>
				</div>
			</div>
			<div class="">
				<div class="row pad">
					<div class="col-xs-6 form-horizontal">
						<div class="form-group text-center">
							<label class="col-xs-3 control-label">Rp. </label>
							<div class="col-xs-5">
								<input type="text" class="form-control" readonly value="<?= number_format($harga_total) ?>">
							</div>
						</div>
					</div>
					<div class="col-xs-6 form-horizontal">
						<div class="form-group" style="padding-top: 6px;">
							<p><?= $kota ?>, <span><?= $tanggal2 ?></span></p>
						</div>
					</div>
				</diV>
			</div>
			<div class="" style="padding-top: 20px;">
				<div class="col-xs-6" style="border: solid 1px #000;">
					<h4>** PERHATIAN **</h4>
					<p>Pembayaran di lakukan dengan cheque/Giro/Wesel dsb, belum dianggap lunas sebelum dicairkan</p>
				</div>
			</div>
		</div>
	</div>

	<script>
		function printWindow() {
			window.print();
			CheckWindowState();
		}

		function CheckWindowState() {
			if (document.readyState == "complete") {
				window.close();
			} else {
				setTimeout("CheckWindowState()", 11000);
			}
		}
		printWindow();
	</script>

</body>

</html>