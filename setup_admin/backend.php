<?php
$role = "utility";
require '../env.php';
extract($_POST);

if ($params == 2) {
    delete($id); 
}
if ($params == 3) {
    tambah($_POST);
}
function delete($id)
{
    global $conn;
    $sql = "DELETE FROM admin WHERE id = '$id'";
    mysqli_query($conn, $sql);
}
function tambah($data)
{
    global $conn;
    extract($data);
    $password_buat = password_hash($password_buat, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin(username,password,nomor_hp,groupType,alamat) VALUES ('$username_buat','$password_buat','$nomor_hp_buat','$group_buat','$alamat_buat') ";
    mysqli_query($conn, $sql);
}
