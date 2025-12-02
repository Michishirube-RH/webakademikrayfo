<?php 
include ("koneksi.php");

if (isset($_POST['Submit'])){
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $sql = "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat) VALUES ('$nim','$nama_mhs','$tgl_lahir','$alamat')";

    $query = $db->query($sql);
    header("Location: list.php");
    exit();
}
?>