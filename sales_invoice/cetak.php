<?php $role = "pemasaran" ?>

<?php
require '../env.php';

$profile = query("SELECT * FROM profil")[0];
$invoice = query("SELECT * FROM sales_invoice WHERE nomor_invoice = '$_GET[kode]'")[0];
$show_packing = implode(',', json_decode($invoice['data']));
$customer = query("SELECT * FROM customer WHERE kode = '$invoice[kode_customer]'")[0];
$packing = array();
foreach (json_decode($invoice['data']) as $data) {
	$datas = show_invoice($invoice['kode_customer'], $data);
	foreach ($datas as $owo) {
		array_push($packing, $owo);
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Cetak Sales Invoice</title>

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

		.pt-5 {
			margin-top: 20px;
		}
	</style>
</head>

<body>

	<div class="content pt-5">
		<div class="row">
			<div class="col-xs-6">
				<h1>BRASCO GROUP</h1>
				<div class="img">
					<img class="pt-5" style="border: solid 1px #ccc;" src="../profile/images/<?= $profile['logo'] ?>" width="100px" height="100px">
				</div>
			</div>
			<div class="col-xs-6">
				<h2 class="text-primary text-center">Sales Invoice</h2>
				<form class="form-horizontal pt-5">
					<div class="form-group">
						<label class="col-xs-5">Tanggal</label>
						<div class="col-xs-6">
							<p><?= $invoice['tanggal'] ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-5">Nomor Invoice</label>
						<div class="col-xs-6">
							<p><?= $invoice['nomor_invoice'] ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-5">Kode Customer</label>
						<div class="col-xs-6">
							<p><?= $invoice['kode_customer'] ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-5">Nomor Purchase Order / Packing</label>
						<div class="col-xs-6">
							<p><?= $show_packing ?></p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row pt-5">
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-10">
						<div class="bg-primary" style="padding: 10px 0 10px 10px;">
							Ditagih ke :
						</div>
						<div class="text pt-5">
							<div class="col-xs-4 text-bold">
								<p>Nama</p>
								<p>Perusahaan</p>
								<p>Alamat 1</p>
								<p>Alamat 2</p>
								<p>Telepon</p>
							</div>
							<div class="col-xs-8">
								<p>: <?= $profile['chief'] ?></p>
								<p>: <?= $profile['nama_cabang'] ?></p>
								<p>: <?= $profile['alamat'] ?></p>
								<p>: <?= $profile['alamat2'] ?></p>
								<p>: <?= $profile['no_telp'] ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-10">
						<div class="bg-primary" style="padding: 10px 0 10px 10px;">
							Dikirim ke :
						</div>
						<div class="text pt-5">
							<div class="col-xs-3 text-bold">
								<p>Nama</p>
								<p>Cabang</p>
								<p>Alamat </p>
								<p>Telepon</p>
							</div>
							<div class="col-xs-9">
								<p>: <?= $customer['nama'] ?></p>
								<p>: <?= $customer['kota'] ?></p>
								<p>: <?= $customer['alamat'] ?></p>
								<p>: <?= $customer['telepon'] ?></p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="data-table pt-5">
			<table class="table table-border table-striped">
				<thead class="bg-primary">
					<th>Kode Item</th>
					<th>Nama Item</th>
					<th>Qty</th>
					<th>Harga Satuan</th>
					<th>Total Harga</th>
				</thead>
				<tbody>
					<?php foreach ($packing as $row) : extract($row); ?>
						<tr>
							<td><?= $barcode ?></td>
							<td><?= $nama_item ?></td>
							<td><?= $quantity ?></td>
							<td><?= $harga_satuan ?></td>
							<td><?= $totalHarga ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="row pt-5">
			<div class="col-xs-6">
				<div class="bg-primary" style="padding: 3px 0 3px 3px;">
					Catatan
				</div>
				<textarea class="form-control" rows="4" disabled><?= $invoice['catatan'] ?></textarea>
			</div>
			<div class="col-xs-5">
				<div class="form-group">
					<label class="col-xs-4">Subtotal</label>
					<div class="col-xs-8">
						<p>Rp. <?= number_format($invoice['subtotal'], 3) ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4">PPN(<?= strtoupper($invoice['tipe_ppn']) ?>)</label>
					<div class="col-xs-8">
						<p>Rp. <?= number_format($invoice['ppn'], 3) ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4">Ongkir</label>
					<div class="col-xs-8">
						<p>Rp. <?= number_format($invoice['ongkir'], 3) ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-4">Total</label>
					<div class="col-xs-8">
						<p>Rp. <?= number_format($invoice['total'], 3) ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>