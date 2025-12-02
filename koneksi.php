<?php
$db = mysqli_connect('localhost', 'root', '', 'db_akademik');

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
