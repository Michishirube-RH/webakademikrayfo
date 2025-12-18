<?php
// Tambahkan koneksi
include("../koneksi.php");
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <h3 class="mb-0">Prodi</h3>
        </div>
        <div class="card-body">
          <form method="post" action="gbproses.php">
            
            <div class="mb-3">
              <label for="name" class="form-label">Nama Prodi</label>
              <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
            </div>

            <div class="mb-3">
              <label for="jenjang" class="form-label">Jenjang</label>
              <select class="form-select" id="jenjang" name="jenjang" required>
                  <option value="" selected disabled>Pilih Jenjang</option>
                  <!-- PERBAIKAN: Gunakan huruf besar sesuai ENUM -->
                  <option value="D2">D2</option>
                  <option value="D3">D3</option>
                  <option value="D4">D4</option>
                  <option value="S2">S2</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
              <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>