<?php $title = 'Uang Muka Dari Customer' ?>
<?php $role = 'pemasaran';
include '../env.php';
cekAdmin($role);
?>
<?php include('../templates/header.php'); ?>
<!-- =============================================== -->

<script>
	var active = 'header_bank';
	var active_2 = 'header_bank_uang_muka_dari_customer';
</script>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
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
				<h3 class="box-title">Form Uang Muka Dari Customer</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<form class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2">Kode Customer</label>
							<div class="col-sm-3">
								<select class="form-control">
									<option value="">P</option>
									<option value="">P</option>
									<option value="">P</option>
								</select>
							</div>
							<label>
								<!-- ngasih spasi di form input saat responsive --></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Alamat</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="" placeholder="Alamat Suplier">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2"></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="" placeholder="Alamat Supplier">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2"></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="" placeholder="Kota">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2"></label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="Kode Pos">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">No. Telepon</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">No. HP</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">TOP</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2"> Tgl Beli Akhir</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<div class="box-body">
					<form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-2">No Transaksi</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="" placeholder="">
								</div>
								<label></label>
								<label class="col-sm-2">SO No</label>
								<div class="col-sm-2">
									<select class="form-control">
										<option value="">P</option>
										<option value="">P</option>
										<option value="">P</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2">Tanggal</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="" placeholder="">
								</div>
								<label></label>
								<label class="col-sm-2">Jumlah SO</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2">Kd Kas / Bank</label>
								<div class="col-sm-3">
									<select class="form-control">
										<option value="">P</option>
										<option value="">P</option>
										<option value="">P</option>
									</select>
								</div>
								<label></label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="" placeholder="">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Giro No.</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
							<label></label>
							<label class="col-sm-1">Jumlah</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-9">
								<textarea class="form-control" placeholder="Keterangan"></textarea>
							</div>
						</div>
						<div class="box-body">
							<div class="button pull-right">
								<button type="button" class="btn btn-danger">Keluar</button>
								<button type="button" class="btn btn-info">Simpan</button>
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