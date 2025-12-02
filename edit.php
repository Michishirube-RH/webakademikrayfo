<?php
include("koneksi.php");

if (!isset($_GET['nim'])) {
    die("Error: Parameter NIM tidak ditemukan.");
}

$nim = $_GET['nim'];
$edit = mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
if (!$edit) {
    die("Query Error: " . mysqli_error($db));
}

$data = mysqli_fetch_array($edit);
if (!$data) {
    die("Error: Data tidak ditemukan.");
}
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
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header text-center">
      <h3 class="mb-0">Edit Data Akademik</h3>
    </div>

    <div class="card-body">
      <form method="post" action="">

        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" class="form-control" name="nim" value="<?= $data['nim']; ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" class="form-control" name="nama_mhs" value="<?= $data['nama_mhs']; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" name="tgl_lahir" value="<?= $data['tgl_lahir']; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-control" name="alamat" value="<?= $data['alamat']; ?>">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary" name="Submit">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>
</body>
</html>

<?php
if (isset($_POST['Submit'])) {

    $nama = $_POST['nama_mhs'];
    $tgl  = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($db, "
        UPDATE mahasiswa SET 
            nama_mhs  = '$nama',
            tgl_lahir = '$tgl',
            alamat    = '$alamat'
        WHERE nim = '$nim'
    ");

    if ($update) {
        header("Location: list.php");
        exit;
    } else {
        echo "Maaf, data gagal diubah: " . mysqli_error($db);
    }
}
?>
