<?php $role = "inventory" ?>

<?php

require 'functions.php';

$barcode = $_POST["barcode"];

$querys = "SELECT * FROM inventory WHERE barcode='$barcode'";
$find = mysqli_query($conn,$querys);
$row = mysqli_num_rows($find);


header("Content-Type: Application/Json");

echo json_encode(['result'=>$row]);