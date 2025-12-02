<?php
    // Koneksi database
    $db = mysqli_connect('localhost', 'root', '', 'db_akademik');
    
    // Cek koneksi
    if (!$db) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akademik</title>
    <!-- Link ke Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container mt-5">
      <div class="card shadow-sm">
        <div class="card-header text-center">
          <h3 class="mb-0">Akademik</h3>
        </div>
        <div class="card-body">
          <form method="post" action="gbproses.php">
            
            <div class="mb-3">
              <label for="name" class="form-label">nim</label>
              <input type="text" class="form-control" id="nim" name="nim" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">nama_mhs</label>
              <input type="text" class="form-control" id="nama_mhs" name="nama_mhs">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat">
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
