<?php $title = 'Uang Muka ke Supplier' ?>

<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role);
if (isset($_POST['no_kas_keluar'])) {
	$sess = $_SESSION['admin']['id'];
	extract($_POST);
	$sql = '';
	$bank = query("SELECT * FROM bank WHERE kode_bank = '$kode_bank'")[0];
	$kode2 = explode('-', $_POST['no_kas_keluar'])[1];
	$kurang = intval($bank['saldo_jalan']) - intval($jumlah);
	$sql .= "UPDATE counter SET digit='$kode2',id_edit_admin='$sess' WHERE tabel='no_kas_keluar';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE purchase_order SET uangmuka_beli = '$jumlah',id_edit_admin='$sess' WHERE kode= '$po';";
	$sql .= PHP_EOL;
	$sql .= "UPDATE bank SET saldo_jalan = '$kurang',id_edit_admin='$sess' WHERE kode_bank = '$kode_bank';";
	$sql .= PHP_EOL;
	$sql .= "INSERT INTO bank_input_pembayaran(nomor_kas_keluar,tanggal,id_bank,jenis_biaya,jumlah,keterangan,no_giro,tanggal_giro,id_admin,id_edit_admin) VALUES('$no_kas_keluar','$tanggal','$kode_bank','$bank[nomor_akun]','$jumlah','$keterangan','$giro','$tanggal','$sess','0');";
	$sql .= PHP_EOL;

	$sql .= PHP_EOL;

	$jurnal = query("SELECT * FROM jurnal_referensi")[0];
	$hutang = $jurnal['umbeli'];
	$j_bank = $bank['kode_bank'];
	$j_kas = $bank['kode_bank'];
	$tipe = $bank['tipe'];

	$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,debet,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_kas_keluar','$hutang','$jumlah','Uang Muka Beli Ke Supplier','$tanggal','$sess','0',1);";
	$sql .= PHP_EOL;

	if ($tipe == 'kas') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_kas_keluar','$j_bank','$jumlah','Kas Uang Muka ke Supplier','$tanggal','$sess','0',2);";
	}
	if ($tipe == 'bank') {
		$sql .= "INSERT INTO tr_jurnal(novoucher,kodeakun,kredit,keterangan,tanggal,id_admin,id_edit_admin,nourut) VALUES('$no_kas_keluar','$j_kas','$jumlah','Bank Uang Muka ke Supplier','$tanggal','$sess','0',3);";
	}

	$sql .= PHP_EOL;

	$query = mysqli_multi_query($conn, $sql);
	lanjutkan($query, "Ditambahkan!");
	header('Refresh: 0');
}
?>
<?php include('../templates/header.php'); ?>
<!-- =============================================== -->

<script>
	var active = 'header_bank';
	var active_2 = 'header_bank_uang_muka_ke_supplier';
</script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Title
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">Blank page</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Form Uang Muka Supplier</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<form class="form-horizontal" action="" method="POST">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-7">
								<div class="box-body">
									<!-- #1 -->
									<div class="form-group">
										<label class="col-sm-3">Kode Supplier</label>
										<div class="col-sm-4">
											<select id="kode_supplier" class="form-control">
												<option selected="" disabled="">Kode Supplier</option>
												<?php
												$query = query("SELECT kode FROM supplier");
												foreach ($query as $data) {
													?>
													<option value="<?= $data['kode'] ?>"><?= $data['kode'] ?></option>
												<?php } ?>
											</select>
										</div>
										<label></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="nama_supplier" readonly="">
										</div>
									</div>
									<!-- #2.1 -->
									<div class="form-group">
										<label class="col-sm-3">Alamat</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="alamat" readonly="">
										</div>
									</div>
									<!-- #2.2 -->
									<div class="form-group">
										<label class="col-sm-3"></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="kota" readonly="">
										</div>
									</div>
									<!-- #3 -->
									<div class="form-group">
										<label class="col-sm-3">Saldo Awal</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="saldo_awal" readonly="">
										</div>
									</div>
									<!-- #4 -->
									<div class="form-group">
										<label class="col-sm-3">Saldo Jalan</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="saldo_jalan" readonly="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="box-body">
									<!-- #1 -->
									<div class="form-group">
										<label class="col-sm-3">No Telepon</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="telepon" readonly="">
										</div>
									</div>
									<!-- #2 -->
									<div class="form-group">
										<label class="col-sm-3">No HP</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="hp" readonly="">
										</div>
									</div>
									<!-- #3 -->
									<div class="form-group">
										<label class="col-sm-3">TOP</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="top" readonly="">
										</div>
									</div>
									<!-- #4 -->
									<div class="form-group">
										<label class="col-sm-3">Tgl Beli Akhir</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input type="text" name="tanggal1" id="tanggal_beli_akhir" readonly="" class="form-control">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
											</div>
										</div>
									</div>
									<!-- #5 -->
									<div class="form-group">
										<label class="col-sm-3">Jml Beli 1 thn</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="jumlah_beli_satu" placeholder="Belum ada Pembelian" readonly="">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<div class="box-body">
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label class="col-sm-2">No Transaksi</label>
											<div class="col-sm-3">
												<?php
												$query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT header FROM counter WHERE tabel='no_kas_keluar'"));
												$kk = $query['header'];
												$digit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max(digit) as digie FROM counter WHERE tabel='no_kas_keluar'"));
												$angka = $digit['digie'];
												$angka++;
												$char = "$kk-";
												$no = $char . sprintf("%08s", $angka);
												?>
												<input type="text" class="form-control" value="<?= $no ?>" readonly id="no_kas_keluar" name="no_kas_keluar" required>
											</div>
											<label></label>
											<label class="col-sm-2">Pilih PO</label>
											<div class="col-sm-2">
												<select class="form-control" id="pilih_po" name="po" required>
													<option value="">Pilih Supplier Dahulu</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2">Tanggal</label>
											<div class="col-sm-3">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="date" class="form-control" name="tanggal">
												</div>
											</div>
											<label></label>
											<label class="col-sm-2">Jumlah PO</label>
											<div class="col-sm-2">
												<input type="text" class="form-control" id="jumlah_po" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2">Kd Kas / Bank</label>
											<div class="col-sm-3">
												<select class="form-control" id="kode_bank" name="kode_bank">
													<option value="0" disabled selected>Pilih Kode Bank</option>
													<?php
													$query = query("SELECT kode_bank FROM bank");
													foreach ($query as $data) {
														?>
														<option value="<?= $data['kode_bank'] ?>"><?= $data['kode_bank'] ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control" required id="nama_bank" readonly="">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2">Giro No.</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" required name="giro">
										</div>
										<label></label>
										<label class="col-sm-1">Jumlah</label>
										<div class="col-sm-3">
											<input type="number" class="form-control" required name="jumlah">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-9">
											<textarea class="form-control" required placeholder="Keterangan" name="keterangan"></textarea>
										</div>
									</div>
									<div class="box-body">
										<div class="button pull-right">
											<button type="submit" class="btn btn-info">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.box-footer-->
</div>
<!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../templates/footer.php') ?>
<script>
	$('#kode_bank').change(function() {
		var kode_bank = $(this).val()
		$.post('kas_bank/ajax.php', {
			'params': 1,
			'kode_bank': kode_bank
		}, function(response) {
			res = JSON.parse(response)
			$('#nama_bank').val(res.nama_bank)
		})
	})

	$('#kode_supplier').change(function() {
		var kode_supplier = $(this).val()

		$.post('kas_bank/ajax.php', {
			'params': 9,
			'kode_supplier': kode_supplier
		}, function(response) {
			res = JSON.parse(response)
			$('#nama_supplier').val(res.nama)
			$('#alamat').val(res.alamat)
			$('#kota').val(res.kota)
			$('#saldo_awal').val(res.saldo_awal)
			$('#saldo_jalan').val(res.saldo_jalan)
			$('#telepon').val(res.telepon)
			$('#hp').val(res.handphone)
			$('#top').val(res.top)
			$('#tanggal_beli_akhir').val((res.tanggal_beli_akhir == '0000-00-00') ? 'Belum ada pembelian' : res.tanggal_beli_akhir)
			$('#jumlah_beli_satu').val(res.total)
		})

		$.post('kas_bank/ajax.php', {
			'params': 13,
			'kode_supplier': kode_supplier
		}, (res) => {
			$('#pilih_po').html('');
			$('#jumlah_po').val('')
			res = JSON.parse(res)
			if (res.length > 0) {

				$('#pilih_po').append('<option selected disabled value="0">Pilih PO</option>');
				res.forEach((resp) => {
					$('#pilih_po').append(`
					<option value="${resp.kode}">${resp.kode}</option>
				`);

				})
			} else {
				$('#pilih_po').append('<option selected disabled value="0">Tidak ditemukan PO</option>');
			}
		})

		$('#pilih_po').change(() => {
			$.post('kas_bank/ajax.php', {
				'params': 14,
				'kode': $('#pilih_po').val()
			}, (res) => {
				res = JSON.parse(res)
				$('#jumlah_po').val(parseInt(res.total_harga))
			})
		})
	})
</script>