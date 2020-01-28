<?php $role = "utility" ?>

<?php
// Load file koneksi.php
include "dbconnect.php";
// Ambil Data yang Dikirim dari Form
$kode_cabang = $_POST['kode_cabang'];
$nama_cabang = $_POST['nama_cabang'];
$alamat = $_POST['alamat'];
$alamat2 = $_POST['alamat2'];
$kota = $_POST['kota'];
$kodepos = $_POST['kodepos'];
$no_telp = $_POST['no_telp'];
$no_hp = $_POST['no_hp'];
$chief = $_POST['chief'];
$logo = $_FILES['logo']['name'];
$tmp = $_FILES['logo']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$logobaru = date('dmYHis') . $logo;
// Set path folder tempat menyimpan fotonya
$path = "images/" . $logobaru;
// Proses upload
if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
  // Proses simpan ke Database
  $query = "INSERT INTO profil(kode_cabang,nama_cabang,alamat,alamat2,kota,kodepos,no_telp,no_hp,chief,logo) VALUES('" . $kode_cabang . "', '" . $nama_cabang . "', '" . $alamat . "', '" . $alamat2 . "', '" . $kota . "', '" . $kodepos . "', '" . $no_telp . "', '" . $no_hp . "', '" . $chief . "', '" . $logobaru . "')";
  $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
  if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: show_profil.php"); // Redirect ke halaman profil
  } else {
    echo mysqli_error($conn);
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='profil.php'>Kembali Ke Form</a>";
  }
} else {
  // Jika gambar gagal diupload, Lakukan :
  echo "Maaf, Gambar tidak sesuai ukuran yang ditentukan";
  echo "<br><a href='profil.php'>Kembali Ke Form</a>";
}
?>





