<?php
include("../koneksi.php");

if (isset($_GET['nim'])) {
    $nim = mysqli_real_escape_string($db, $_GET['nim']);
    
    $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim = '$nim'");
    
    if ($hapus) {
        header("Location: list.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
} else {
    echo "NIM tidak ditemukan!";
}
?>