<?php
include("koneksi.php");
$hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim = $_GET[nim]");
if ($hapus) {
    header("location: list.php");
} else {
    print "Gagal menghapus data";
}
?>