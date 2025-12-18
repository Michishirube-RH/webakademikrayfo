<?php
include("../koneksi.php");

// Cek koneksi
if (!isset($db) || !$db) {
    die("ERROR: Koneksi database gagal!");
}

// Cek apakah ada data prodi
$query_prodi = mysqli_query($db, "SELECT id, nama_prodi, jenjang FROM prodi ORDER BY nama_prodi");
$jumlah_prodi = mysqli_num_rows($query_prodi);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 800px; }
        .required::after { content: " *"; color: red; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="list.php">Data Mahaiswa</a>
            </li>
            <li class="nav-item">
            </li> <a class="nav-link" href="../prodi/list.php">Data Prodi</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3 class="mb-0">Mahasiswa</h3>
            </div>
            <div class="card-body">
                <!-- Peringatan jika tidak ada data prodi -->
                <?php if ($jumlah_prodi == 0): ?>
                <div class="alert alert-warning">
                    <strong>Perhatian!</strong> Belum ada data Program Studi. 
                    <a href="../prodi/gbook.php">Input data prodi terlebih dahulu</a>.
                </div>
                <?php endif; ?>
                
                <form method="post" action="gbproses.php">
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label required">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_mhs" class="form-label required">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" required>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label required">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label required">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="prodi_id" class="form-label required">Prodi</label>
                        <select class="form-select" id="prodi_id" name="prodi_id" required>
                            <option value="" selected disabled>Pilih Prodi</option>
                            <?php
                            if ($jumlah_prodi == 0) {
                                echo '<option value="" disabled>-- Tidak ada data prodi --</option>';
                            } else {
                                // Reset pointer hasil query
                                mysqli_data_seek($query_prodi, 0);
                                while ($prodi = mysqli_fetch_array($query_prodi)) {
                                    echo '<option value="' . $prodi['id'] . '">' 
                                         . $prodi['nama_prodi'] . ' (' . $prodi['jenjang'] . ')' 
                                         . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="list.php" class="btn btn-warning">Lihat Data</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>