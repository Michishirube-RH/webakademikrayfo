<?php 
include("../koneksi.php");

if (isset($_POST['Submit'])){
    $nim = mysqli_real_escape_string($db, $_POST['nim']);
    $nama_mhs = mysqli_real_escape_string($db, $_POST['nama_mhs']);
    $tgl_lahir = mysqli_real_escape_string($db, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
    
    // Validasi: jika prodi_id kosong, set NULL
    if (empty($prodi_id) || $prodi_id == "") {
        $prodi_id = "NULL";  // String NULL untuk SQL
    }
    
    // Gunakan nama kolom yang benar: prodi_id
    if ($prodi_id === "NULL") {
        $sql = "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat) 
                VALUES ('$nim','$nama_mhs','$tgl_lahir','$alamat')";
    } else {
        $sql = "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat, prodi_id) 
                VALUES ('$nim','$nama_mhs','$tgl_lahir','$alamat','$prodi_id')";
    }
    
    $query = mysqli_query($db, $sql);
    
    if($query) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($db);
        echo "<br>SQL: " . $sql;
    }
} else {
    echo "Form tidak disubmit dengan benar!";
}
?>