<?php $role = "pemasaran" ?>

<?php include('../templates/header.php') ?>

<div class="content-wrapper">
	<section class="content">
		<div class="box box-primary">
			<div class="box-header text-center">
				<h3>INPUT SALES ORDER</h3>
			</div>
			<div class="box-body">
				<form action="" method="" class="form-horizontal">
					<!-- form grid ke 1 -->
					<div class="col-sm-6">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">Tanggal</label>
								<div class="col-sm-6">
									<div class="input-group">
										<input type="date" required name="tanggal" class="form-control">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">No Order</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Cari SO</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="">
								</div>
								<div class="col-sm-2">
									<i class="fa fa-search fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<p><b>Kirim Ke</b></p>
						<div class="box-body">
							<div class="form-group">
								<div class="col-xs-6">
									<input type="text" class="form-control" name="" placeholder="Kode Customer">
								</div>
								<div class="col-xs-2">
									<i class="fa fa-search fa-2x"></i>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-10">
									<input type="text" class="form-control" name="" placeholder="Nama Customer">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-10">
									<textarea class="form-control" placeholder="Alamat"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-8">
									<input type="text" class="form-control" name="" placeholder="Kota">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-4">
									<input type="text" class="form-control" name="" placeholder="No Telepon">
								</div>
								<div class="col-xs-5">
									<input type="text" class="form-control" name="" placeholder="No Handphone">
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-body">
				<div class="col-xs-3">
					<div class="form-group">
						<div style="display: inline-flex">
							<input style="margin-right: 20px;" type="text" id="barcode_so" placeholder="Barcode" class="form-control">
							<i style="font-size: 30px;cursor:pointer" class="fa fa-search" id="cari_barcode"></i>
						</div>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<div>
							<input type="text" id="nama_item" placeholder="Nama Item" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group">
						<input type="text" id="satuan" placeholder="Satuan" class="form-control">
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group">
						<input type="text" id="quantity" placeholder="Qty" class="form-control">
					</div>
				</div>
				<div class="col-xs-1">
					<div class="form-group">
						<i style="font-size: 30px;cursor:pointer" id="masuk_data" class="fa fa-plus"></i>
					</div>
				</div>

				<!-- table -->
				<div class="data-table">
					<div class="box-body">
						<table class="table table-bordered table-striped text-center">
							<thead align="center">
								<tr>
									<th>
										<center>No</center>
									</th>
									<th>
										<center>Barocde</center>
									</th>
									<th>
										<center>Nama Item</center>
									</th>
									<th>
										<center>QTY</center>
									</th>
									<th>
										<center>Satuan</center>
									</th>
									<th>
										<center>Harga Jual Satuan</center>
									</th>
									<th>
										<center>Jumlah</center>
									</th>
									<th>
										<center>Aksi</center>
									</th>
								</tr>
							</thead>
							<tbody align="center" id="table_so">
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><a href="#"><i class="fa fa-trash fa-lg text-red"></i></a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div style="padding-top: 10px;">
					<div class="col-sm-6">
						<div class="form-group">
							<textarea class="form-control" rows="3" placeholder="Keterangan"></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group pull-right">
							<button type="" class="btn btn-default">Close</button>
							<button class="btn btn-danger">Reset</button>
							<button type="submit" name="" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</div>
				</form>
			</div>
	</section>
</div>