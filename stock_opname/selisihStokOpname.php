<?php $role = 'inventory' ?>
<?php $title = "Selisih Stock Opname" ?>
<?php
session_start();
include('../env.php');
cekAdmin($role);
include '../templates/header.php';
?>
<?php
if (isset($_POST['search'])) {
	extract($_POST);
	$arr = array();
	$hasil_cari = array();
	$kodeku = $kode;
	$cari_stock = query("SELECT * FROM stock_opname WHERE barcode_inventory BETWEEN '$barcode1' AND '$barcode2' AND kode='$kode' AND MONTH(CAST(created_at AS DATE))='$bulan'");
	foreach ($cari_stock as $opname) {
		$arr['kode'] = $kode;
		$arr['barcode'] = $opname['barcode_inventory'];
		$arr['qty_opname'] = $opname['quantity_opname'];
		$arr['qty_selisih'] = $opname['quantity_selisih'];
		$barcode = $arr['barcode'];
		$quin = query("SELECT * FROM inventory WHERE barcode='$barcode'");
		foreach ($quin as $inventory) {
			$arr['nama_item'] = $inventory['nama_barang'];
			$arr['satuan'] = $inventory['satuan'];
			$arr['jumlah_selisih'] = $arr['qty_selisih'] * $inventory['harga_beli'];
		}
		array_push($hasil_cari, $arr);
	}
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Adjust Selisih Stok Opname</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="">
					<div class="row">
						<div class="col-sm-10">
							<div class="box-body">
								<div class="form-group">
									<div class="col-sm-3">
										<select name="kode" class="form-control">
											<option selected disabled>No Bukti</option>
											<?php
											$kodes = query("SELECT * FROM stock_opname GROUP BY kode HAVING COUNT(id) >= 1");
											foreach ($kodes as $kode) {
												?>
												<option value="<?= $kode['kode'] ?>"><?= $kode['kode'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-4">
										<select name="bulan" class="form-control">
											<option selected disabled>Pilih Bulan</option>
											<option value="1">Januari</option>
											<option value="2">Februari</option>
											<option value="3">Maret</option>
											<option value="4">April</option>
											<option value="5">Mei</option>
											<option value="6">Juni</option>
											<option value="7">Juli</option>
											<option value="8">Agustus</option>
											<option value="9">September</option>
											<option value="10">Oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
									</div>

								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<select name="barcode1" class="form-control">
											<option selected disabled>Kode Barcode</option>
											<?php
											$query = query("SELECT barcode_inventory FROM stock_opname GROUP BY barcode_inventory HAVING COUNT(id) >= 1");
											foreach ($query as $data) {
												?>
												<option value="<?= $data['barcode_inventory'] ?>"><?= $data['barcode_inventory'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-1">
										<label class="control-label">to</label>
									</div>
									<div class="col-sm-3">
										<select name="barcode2" class="form-control">
											<option selected disabled>Kode Barcode</option>
											<?php
											$query = query("SELECT barcode_inventory FROM stock_opname GROUP BY barcode_inventory HAVING COUNT(id) >= 1");
											foreach ($query as $data) {
												?>
												<option value="<?= $data['barcode_inventory'] ?>"><?= $data['barcode_inventory'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-1">
										<button name="search" type="submit" class="btn btn-info">Cari</button>
									</div>


								</div>
							</div>
						</div>
					</div>
				</form>

				<!-- data-table -->
				<div class="table-data">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<th>No</th>
								<th>Barcode</th>
								<th>Nama Item</th>
								<th>Sat</th>
								<th>Qty Opname</th>
								<th>Qty Selisih</th>
								<th>Jumlah Selisih</th>
							</thead>
							<tbody>
								<?php
								if (isset($hasil_cari)) {
									$no = 1;
									foreach ($hasil_cari as $data) {
										?>
										<tr>
											<td><?= $no++ ?></td>
											<input type="hidden" id="nobukti" value="<?= $data['kode'] ?>">
											<td><?= $data['barcode'] ?></td>
											<td><?= $data['nama_item'] ?></td>
											<?php
											$query = mysqli_query($conn,"SELECT * FROM satuan WHERE id='$data[satuan]'");
											foreach ($query as $sat) {
											?>
											<td><?= $sat['satuan']?></td>
											<?php } ?>	
											<td><?= $data['qty_opname'] ?></td>
											<td><?= $data['qty_selisih'] ?></td>
											<td><?= $data['jumlah_selisih'] ?></td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- formkedua -->
				<div class="form2">
					<form class="form-horizontal" method="POST" action="">
						<div class="col-sm-10">
							<div class="box-body">
								<div class="form-group">
									<div class="col-sm-3">
										<select id="kode_akun" class="form-control">
											<option selected disabled>Kode Akun</option>
											<?php
											$query = mysqli_query($conn,"SELECT * FROM ms_akun");
											foreach ($query as $data) {
												?>
												<option value="<?= $data['kodeakun'] ?>"><?= $data['kodeakun'] ?> - <?= $data['namaakun'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3">
										<input type="text" class="form-control" readonly="" id="nama_akun" placeholder="Nama Akun">
									</div>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="debet" placeholder="Debet">
									</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" id="kredit" placeholder="Kredit">
									</div>
									<div class="col-sm-2">
										<i id="add" class="fa fa-plus fa-2x"></i>
									</div>
								</div>
							</div>
						</div>

				</div>
			</div>

		</div>

		<div class="box box-info">
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<th>No</th>
							<th>No Akun</th>
							<th>Nama Akun</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th></th>
						</thead>
						<tbody id="kaeritai">

						</tbody>
					</table>
				</div>

				<div class="pull-right">
					<button id="save" type="button" class="btn btn-info">Save</button>
					<button id="reset" type="button" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</div>

</div>

</section>
</div>
<!-- /.content-wrapper -->
<?= jquery() ?>
<script>
	$('#reset').click(function() {
		window.location.reload()
	})
	var active = 'header_stock'
	var active_2 = 'header_stock_selisih'
	var simpanData = []
	var no = 1
	$('#kode_akun').change(function() {
		 $.post('stock_opname/save.php', {
		 	'params': 1,
		 	'kode_akun': $(this).val()
		 }, (res) => {
		 	element = JSON.parse(res)
		 	$('#nama_akun').val(element.namaakun)
		 })
	})
	$('#add').click(function() {
		var kode_akun = $('#kode_akun').val()
		var nama_akun = $('#nama_akun').val()
		var debet = $('#debet').val()
		var kredit = $('#kredit').val()
		simpanData.push({
			'kode_akun': kode_akun,
			'nama_akun': nama_akun,
			'debet': debet,
			'kredit': kredit
		})

		$('#kaeritai').append(`
			<tr id="tr${no}">
				<td id="icr">${no}</td>
				<td>${kode_akun}</td>
				<td>${nama_akun}</td>
				<td>${debet}</td>
				<td>${kredit}</td>
				<td><button onclick="deleteAll('${no}')" class="btn btn-danger">Hapus</button></td>	
			</tr>
		`)
		no++;
		fix_iteration('#kaeritai')
	})

	function deleteAll(parno) {
		$('#tr' + parno).remove()
		delete simpanData[--parno]
		fix_iteration('#kaeritai')
	}
	$('#save').click(function() {
		$.post('stock_opname/save.php', {
			'params': 2,
			'no_bukti': $('#nobukti').val(),
			simpanData
		}, (res) => {
			ress = JSON.parse(res)
			alert(ress)
			window.location.reload(true)
		})
	})
</script>
<?php include('../templates/footer.php') ?>