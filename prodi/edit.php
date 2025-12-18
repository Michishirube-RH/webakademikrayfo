<?php
// Koneksi ada di folder atas, jadi naik satu level
include("../koneksi.php");

if (isset($_POST['Submit'])) {
    $id = $_POST['id'];
    $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);
    $jenjang = mysqli_real_escape_string($db, $_POST['jenjang']);
    $keterangan = mysqli_real_escape_string($db, $_POST['keterangan']);
    
    $update = mysqli_query($db, "UPDATE prodi SET 
        nama_prodi = '$nama_prodi',
        jenjang = '$jenjang',
        keterangan = '$keterangan'
        WHERE id = '$id'");
    
    if ($update) {
        header("Location: list.php");  // PERBAIKAN: Hapus <prodi>
        exit;
    } else {
        echo "Error update: " . mysqli_error($db);
    }
}

if (!isset($_GET['id'])) {
    die("Error: Id tidak ditemukan.");
}

$id = $_GET['id'];
$edit = mysqli_query($db, "SELECT * FROM prodi WHERE id = '$id'");
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
    <title>Edit Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container mt-5">
      <div class="card shadow-sm">
        <div class="card-header text-center">
          <h3 class="mb-0">Edit Prodi</h3>
        </div>
        <div class="card-body">
          <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <div class="mb-3">
              <label for="nama_prodi" class="form-label">Nama Prodi</label>
              <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" 
                     value="<?php echo htmlspecialchars($data['nama_prodi']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="jenjang" class="form-label">Jenjang</label>
              <select class="form-select" id="jenjang" name="jenjang" required>
                  <option value="" disabled>Pilih Jenjang</option>
                  <option value="D2" <?php if($data['jenjang'] == 'D2') echo 'selected'; ?>>D2</option>
                  <option value="D3" <?php if($data['jenjang'] == 'D3') echo 'selected'; ?>>D3</option>
                  <option value="D4" <?php if($data['jenjang'] == 'D4') echo 'selected'; ?>>D4</option>
                  <option value="S2" <?php if($data['jenjang'] == 'S2') echo 'selected'; ?>>S2</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan"
                     value="<?php echo htmlspecialchars($data['keterangan']); ?>">
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="Submit">Update</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
              <a href="list.php" class="btn btn-warning">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>