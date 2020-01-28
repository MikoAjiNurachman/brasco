<?php $role = "utility" ?>
<?php
// Load file koneksi.php
include "../env.php";
$logo = $_FILES['logo']['name'];
if (empty($logo)) {
    print_r("UPDATE profil SET id= '{$_POST['id']}',
    kode_cabang = '{$_POST['kode_cabang']}',
    nama_cabang = '{$_POST['nama_cabang']}',
    alamat = '{$_POST['alamat']}',
    alamat2 = '{$_POST['alamat2']}',
    kota = '{$_POST['kota']}',
    kodepos = '{$_POST['kodepos']}',
    no_telp = '{$_POST['no_telp']}',
    no_hp = '{$_POST['no_hp']}',
    chief = '{$_POST['chief']}',
    WHERE id = '{$_POST['id']}'");
    exit();
} else {


    $hapus = mysqli_query($conn, "SELECT * FROM profil where id='{$_POST['id']}'");
    // menghapus gambar yang lama
    $nama_gambar = mysqli_fetch_assoc($hapus);
    // nama field gambar
    $lokasi = $nama_gambar['logo'];
    // alamat tempat foto
    $hapus_gambar = "images/{$lokasi}";
    // script untuk menghapus gambar dari folder
    unlink($hapus_gambar);
    move_uploaded_file($_FILES['logo']['tmp_name'], 'images/' . $logo);
    // Proses ubah data ke Database
    print_r("UPDATE profil SET
    id ='{$_POST['id']}',
    kode_cabang = '{$_POST['kode_cabang']}',
    nama_cabang = '{$_POST['nama_cabang']}',
    alamat = '{$_POST['alamat']}',
    alamat2 = '{$_POST['alamat2']}',
    kota = '{$_POST['kota']}',
    kodepos = '{$_POST['kodepos']}',
    no_telp = '{$_POST['no_telp']}',
    no_hp = '{$_POST['no_hp']}',
    chief = '{$_POST['chief']}',
    logo = '$logo' WHERE id='{$_POST['id']}'");
    exit();
}
//if($sql){ // Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: show_profil.php"); // Redirect ke halaman profil.php
