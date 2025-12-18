<?php
include("../koneksi.php");

// PROSES UPDATE
if (isset($_POST['Submit'])) {
    $nim = $_POST['nim'];
    $nama_mhs = mysqli_real_escape_string($db, $_POST['nama_mhs']);
    $tgl_lahir = mysqli_real_escape_string($db, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $prodi_id = mysqli_real_escape_string($db, $_POST['prodi_id']);
    
    // PERBAIKAN: gunakan prodi_id bukan id_prodi
    $update = mysqli_query($db, "UPDATE mahasiswa SET 
        nama_mhs = '$nama_mhs',
        tgl_lahir = '$tgl_lahir',
        alamat = '$alamat',
        prodi_id = " . ($prodi_id ? "'$prodi_id'" : "NULL") . "
        WHERE nim = '$nim'");
    
    if ($update) {
        header("Location: list.php");
        exit;
    } else {
        echo "Error update: " . mysqli_error($db);
    }
}
?>

<select class="form-select" name="prodi_id">
    <option value="">-- Pilih Prodi --</option>
    <?php
    $query_prodi = mysqli_query($db, "SELECT id, nama_prodi, jenjang FROM prodi ORDER BY nama_prodi");
    while ($prodi = mysqli_fetch_array($query_prodi)) {
        // PERBAIKAN: gunakan prodi_id bukan id_prodi
        $selected = ($data['prodi_id'] == $prodi['id']) ? 'selected' : '';
        echo '<option value="' . $prodi['id'] . '" ' . $selected . '>' 
             . $prodi['nama_prodi'] . ' (' . $prodi['jenjang'] . ')' 
             . '</option>';
    }
    ?>
</select>