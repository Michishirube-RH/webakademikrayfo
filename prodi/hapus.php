<?php
include("../koneksi.php");
$hapus = mysqli_query($db, "DELETE FROM prodi WHERE id = $_GET[id]");
if ($hapus) {
    header("location: list.php");
} else {
    print "Gagal menghapus data";
}
?>