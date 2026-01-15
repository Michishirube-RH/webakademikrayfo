<?php
// create_user.php - untuk membuat user demo
include("koneksi.php");

echo "<!DOCTYPE html>
<html>
<head>
    <title>Create User Demo</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { padding: 20px; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class='container mt-5'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card shadow'>";

// Cek koneksi database
if (!$db) {
    echo "<div class='alert alert-danger'>❌ Koneksi database gagal!</div>";
    exit();
}

// Data user demo
$email = "admin@email.com";
$password_plain = "password123";
$nama_lengkap = "Administrator";

// Hash password
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Cek apakah user sudah ada
$check_sql = "SELECT * FROM pengguna WHERE email = '$email'";
$check_result = mysqli_query($db, $check_sql);

if (!$check_result) {
    echo "<div class='alert alert-danger'>
            <h5>❌ Error query:</h5>
            <p>" . mysqli_error($db) . "</p>
            <p>SQL: " . $check_sql . "</p>
          </div>";
} else if (mysqli_num_rows($check_result) > 0) {
    // User sudah ada
    echo "<div class='alert alert-warning'>
            <h5>⚠️ User sudah terdaftar!</h5>
            <p><strong>Email:</strong> " . $email . "</p>
            <p><strong>Status:</strong> Sudah ada di database</p>
            <p><a href='User/login.php' class='btn btn-primary'>Login Sekarang</a></p>
          </div>";
} else {
    // Insert user baru
    $insert_sql = "INSERT INTO pengguna (email, password, nama_lengkap) 
                   VALUES ('$email', '$password_hash', '$nama_lengkap')";
    
    if (mysqli_query($db, $insert_sql)) {
        echo "<div class='alert alert-success'>
                <h5>✅ User demo berhasil dibuat!</h5>
                <hr>
                <p><strong>Email:</strong> " . $email . "</p>
                <p><strong>Password:</strong> " . $password_plain . "</p>
                <p><strong>Nama Lengkap:</strong> " . $nama_lengkap . "</p>
                <hr>
                <a href='User/login.php' class='btn btn-success'>Login Sekarang</a>
              </div>";
    } else {
        echo "<div class='alert alert-danger'>
                <h5>❌ Gagal membuat user:</h5>
                <p>" . mysqli_error($db) . "</p>
                <p>SQL: " . $insert_sql . "</p>
              </div>";
    }
}

// Tampilkan semua user yang ada di database
echo "<div class='card mt-4'>
        <div class='card-header'>
            <h6>📋 Data Pengguna di Database</h6>
        </div>
        <div class='card-body'>";

$list_sql = "SELECT id, email, nama_lengkap FROM pengguna";
$list_result = mysqli_query($db, $list_sql);

if (!$list_result) {
    echo "<p class='text-danger'>Error: " . mysqli_error($db) . "</p>";
} else if (mysqli_num_rows($list_result) == 0) {
    echo "<p class='text-muted'>Tidak ada data pengguna</p>";
} else {
    echo "<table class='table table-sm table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                </tr>
            </thead>
            <tbody>";
    
    while ($row = mysqli_fetch_assoc($list_result)) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['nama_lengkap'] . "</td>
              </tr>";
    }
    
    echo "</tbody></table>";
}

echo "</div></div>"; // tutup card

echo "</div></div></div></body></html>";
?>