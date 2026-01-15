<?php
// koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_akademik";

$db = mysqli_connect($host, $user, $pass, $dbname);

if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>