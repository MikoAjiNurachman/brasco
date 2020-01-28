<?php
require '../env.php';
if (isset($_GET)) {
	$kode = $_GET['kode'];
	$invoice = query("SELECT * FROM sales_invoice WHERE nomor_invoice = '$kode'")[0];

	$profil = query("SELECT * FROM profil")[0];
	$foto = $profil['logo'];
	print_r($foto);
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Cetak Surat jalan</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
	<style type="text/css">
		.pt-5 {
			padding-top: 15px;
		}

		.pr-5 {
			padding-right: 20px;
		}
	</style>
</head>

<body>

	<div class="content pt-5">
		<div class="row">
			<div class="col-xs-4">
				<div class="col-xs-3">
					<img src="../profile/images/<?= $foto ?>" width="50px">
				</div>
				<div class="col-xs-9">
					PT. Nocole Pangan Indonesia <br>
					Jl. Raya Hanjawar No. 1 Cipanas Cianjur <br>
					Ph. +62 878 0012 5750 <br>
					e : n.chocolaterie@gmail.com
				</div>
			</div>
			<div class="col-xs-4">
				<h2 class="text-center text-primary">Surat Jalan</h2>
			</div>
			<div class="col-xs-4">
				<div class="pull-right pr-5">
					<p>No SI : SF12345678</p>
					<p>Tgl SI : dd-mm-yyyy</p>
				</div>
			</div>
		</div>
		<hr>

		<div class="row">
			<div class="col-xs-6">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-xs-2 control-label">Kepada</label>
						<div class="col-xs-10">
							<input type="text" readonly="" name="" class="form-control" value="Tujuan Pengiriman">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 control-label">Alamat</label>
						<div class="col-xs-10">
							<div class="">
								<input type="text" readonly="" name="" class="form-control">
							</div>
							<div class="pt-5">
								<input type="text" readonly="" name="" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-6">
							<div class="row">
								<label class="col-xs-4 control-label">Kota</label>
								<div class="col-xs-8">
									<input type="text" readonly="" name="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<label class="col-xs-4 control-label">Kd Pos</label>
								<div class="col-xs-8">
									<input type="text" readonly="" name="" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-6">
							<div class="row">
								<label class="col-xs-4 control-label">Telp</label>
								<div class="col-xs-8">
									<input type="text" readonly="" name="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<label class="col-xs-4 control-label">HP</label>
								<div class="col-xs-8">
									<input type="text" readonly="" name="" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-6">
				<div class="pull-right pr-5">
					<p>No SI : IF12345678</p>
					<p>No PO : PNC1000001</p>
				</div>
				<div style="border: solid 1px #000; display: inline-block; margin-top: 70px;" class="pad pr-5">
					<p>**Perhatian**</p>
					<p>Cek kondisi barang, apabila sudah di tanda tangan SJ ini kami tidak menerima complain. Terimakasih</p>
				</div>
			</div>
		</div>

		<div class="tabel pt-5">
			<table class="table table-bordered table-striped">
				<thead style="background: #1863f9;">
					<tr>
						<th>No</th>
						<th>Nama Item</th>
						<th>Qty</th>
						<th>Sat</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>3</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="row">
			<div class="col-xs-4 text-center">
				Dikirim Oleh
				<br>
				<br>
				<br>
				<br>
				(....................)
			</div>
			<div class="col-xs-4 text-center">
				Manager
				<br>
				<br>
				<br>
				<br>
				(....................)
			</div>
			<div class="col-xs-4 text-center">
				Diterima Oleh
				<br>
				<br>
				<br>
				<br>
				(....................)
			</div>
		</div>

	</div>

</body>

</html>