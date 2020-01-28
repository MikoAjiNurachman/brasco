<?php include('../../env.php') ?>
<?php $query = $conn->query("SELECT * FROM purchase_order WHERE kode = '$_GET[kode]'");
foreach ($query as $p) {
	$kode = $p["kode"];
	$keterangan = $p['keterangan'];
	$kode_sup = $p['kode_supplier'];
}
$query2 = $conn->query("SELECT * FROM purchase_order_item WHERE kode_po = '$kode'");
$query3 = $conn->query("SELECT * FROM supplier WHERE kode='$kode_sup'");
foreach ($query3 as $supp) {
	$nama_supp = $supp['nama'];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Cetak Label Barcode</title>
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../../assets/bower_components/font-awesome/css/font-awesome.min.css">

	<!-- folder instead of downloading all of them to reduce the load. -->
	<!-- <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css"> -->
	<!-- Date Picker -->
	<link rel="stylesheet" href="../../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="../../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		thead {
			background: #B8DAFF;
		}
	</style>
</head>

<body>

	<div class="content-wrapper">
		<section class="content-header text-center">
			<h2>PERMINTAAN CETAK LABEL BARCODE</h2>
			<hr>
		</section>
		<section class="content">
			<div class="box">
				<div class="box-body">
					<form>
						<?php foreach ($query as $form) : ?>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="col-xs-4 col-form-label">Kode PO</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" name="" value="<?= $form['kode'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-4 col-form-label">Tanggal PO</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" name="" value="<?= $form['tanggal'] ?>">
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="col-xs-4 col-form-label">Kode Supplier</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" name="" value="<?= $form['kode_supplier'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-4 col-form-label">Nama Supplier</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" name="" value="<?= $nama_supp ?>">
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</form>

					<div class="data-table" style="padding: 30px;">
						<div class="box-body">
							<table class="table table table-bordered table-hover" style="margin-top: 70px;">
								<thead>
									<tr class="table-primary">
										<th scope="col">No</th>
										<th scope="col">Barcode</th>
										<th scope="col">Quantity</th>
										<th scope="col">Sat</th>
										<th scope="col">Harga Jual</th>
										<th scope="col">Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totalS = 0;
									$no = 1;
									foreach ($query2 as $tabel) :
									?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $tabel['barcode_inventory'] ?> </td>
											<td><?= $tabel['quantity'] ?></td>
											<td><?php
												$id = $tabel["satuan"];
												$satuan = $conn->query("SELECT * FROM satuan WHERE id = '$id'");
												foreach ($satuan as $sat) {
													echo $sat['satuan'];
												}
												?></td>
											<td>Rp. 160.000</td>
											<td><?= $keterangan ?></td>
										</tr>
										<?php
										$totalS += intval($tabel['quantity']);
										?>
										<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td>TOTAL QTY</td>
										<td><?= $totalS ?></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>

							<div class="col-xs-7">
								<div class="col-xs-6 text-center">
									<p>Prepared By</p>
									<br>
									<br>
									<br>
									<br>
									<p>(...................)</p>
								</div>
								<div class="col-xs-6 text-center">
									<p>Approve</p>
									<br>
									<br>
									<br>
									<br>
									<p>(...................)</p>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</section>
	</div>

	<script>
		// function printWindow() {
		// 	window.print();
		// 	CheckWindowState();
		// }

		// function CheckWindowState() {
		// 	if (document.readyState == "complete") {
		// 		window.close();
		// 	} else {
		// 		setTimeout("CheckWindowState()", 11000);
		// 	}
		// }
		// printWindow();
	</script>
</body>

</html>