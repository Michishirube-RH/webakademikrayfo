<?php
// Konfigurasi
$host = 'localhost';
$user = 'root';
$pass = '';  // String kosong, tanpa spasi
$database = 'db_akademik';

// Koneksi
$db = mysqli_connect($host, $user, $pass, $database);

// Cek error
if (mysqli_connect_errno()) {
    echo "Error Code: " . mysqli_connect_errno() . "<br>";
    echo "Error Message: " . mysqli_connect_error() . "<br>";
    die("Koneksi database gagal!");
}

// Optional: Set charset
mysqli_set_charset($db, "utf8");

// Optional: Test query
$test = mysqli_query($db, "SELECT 1");
if (!$test) {
    die("Database error: " . mysqli_error($db));
}

// echo "Koneksi berhasil!"; // Bisa dihapus setelah testing
?>