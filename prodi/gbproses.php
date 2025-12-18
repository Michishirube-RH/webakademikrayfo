<?php 
include ("../koneksi.php");

if (isset($_POST['Submit'])){
    $id = $_POST['id'];
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];
    $sql = "INSERT INTO prodi(id, nama_prodi, jenjang, keterangan) VALUES ('$id','$nama_prodi','$jenjang','$keterangan')";

    $query = $db->query($sql);
    header("Location: list.php");
    exit();
}
?>