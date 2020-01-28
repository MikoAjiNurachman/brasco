<?php


// $base_url = "http://192.168.100.3:8080/brasco/";

// $base_url = 'http://192.168.0.112:8080/brasco/';
// $base_url = "http://192.168.56.1:8080/brasco/";
$base_url = "http://localhost/brasco/";


$host = "localhost";
$user = "root";
$password = "";
$dbname = "brasco_pusat";
$conn = mysqli_connect($host, $user, $password, $dbname);


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function alert($word)
{
    echo "<script>alert('" . $word . "')</script>";
}
