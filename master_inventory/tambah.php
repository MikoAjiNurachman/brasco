<?php $role = "inventory" ?>

<?php
require 'functions.php';

if (isset($_POST["submit"])) {

	if (tambah($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan!');
			document.location.href = 'index.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan!');
			document.location.href = 'index.php';
		</script>
		";
	}
}
?>
<!DOCTYPE html>
<html>

<head>

	<title>Halaman Tambah Data</title>
</head>

<body>
	<h1>Tambah Data</h1>


	<form action="" method="post">
		<ul>
			<li>
				<label for="barcode">Barcode : </label>
				<input type="text" name="barcode" id="isi_barcode" autocomplete="off">
				<button type="button" id="barcode">Cek Barcode</button>
			</li>
			<li>
				<label for="nama_barang">Nama Barang : </label>
				<input type="text" name="nama_barang" id="nama_barang" autocomplete="off">
			</li>
			<li>
				<label for="satuan">Satuan : </label>
				<input type="text" name="satuan" id="satuan" autocomplete="off">
			</li>
			<li>
				<label for="id_tipe_barang">Tipe Barang : </label>

				<select name="id_tipe_barang" id="id_tipe_barang" class="form-control">
					<?php
					$data = cariBarang();
					foreach ($data as $datas) :
						?>
						<option value="<?= $datas['id'] ?>"><?= $datas['nama_barang'] ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="harga_jual1">Harga Jual 1 : </label>
				<input type="text" name="harga_jual1" id="harga_jual1" autocomplete="off">
			</li>
			<li>
				<label for="harga_jual2">Harga Jual 2 : </label>
				<input type="text" name="harga_jual2" id="harga_jual2" autocomplete="off">
			</li>
			<li>
				<label for="harga_jual3">Harga Jual 3 : </label>
				<input type="text" name="harga_jual3" id="harga_jual3" autocomplete="off">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data!</button>
			</li>
		</ul>



	</form>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script>
		$('#barcode').on('click', function() {
			$.ajax({
				url: 'cekBarcode.php',
				type: 'POST',
				data: {
					"barcode": $('#isi_barcode').val()
				},
				complete: function(response, textStatus, jqXHR) {
					var respon = JSON.parse(response.responseText);
					if (respon.result == 1) {
						alert("Barcode tidak bisa digunakan!");
					} else {
						alert("Barcode bisa digunakan!");
					}


				},
				error: function(jqXHR, textStatus, err) {
					console.log(textStatus + err + jqXHR);
				}
			});
		});
	</script>
</body>

</html>