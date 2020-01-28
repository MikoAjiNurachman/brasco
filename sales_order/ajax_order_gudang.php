<?php
$conn = mysqli_connect('localhost','root','','brasco_pusat');
if ($_POST['params'] == 1) {
    $data = $_POST['data'];
    $q = mysqli_query($conn,"SELECT * FROM customer WHERE kode = '$data'");
    $f = mysqli_fetch_assoc($q);
    echo json_encode($f);
}
elseif ($_POST['params'] == 2) {
	$data = $_POST['data'];
	$q = mysqli_query($conn,"SELECT * FROM sales_order WHERE nomor_so = '$data'");
	$f = mysqli_fetch_assoc($q);
	echo json_encode($f);
}
?>