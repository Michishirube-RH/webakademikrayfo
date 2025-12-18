<?php
include("../koneksi.php");
?>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../mahasiswa/list.php">Data Mahaiswa</a>
            </li>
            <li class="nav-item">
            </li> <a class="nav-link" href="../prodi/list.php">Data Prodi</a>
            </li>
        </ul>
    </nav>
<h2 class="text-center my-4">Data Prodi</h2>

<div class="container">
  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th scope="col">Nama Prodi</th>
            <th scope="col">Jenjang</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $tampil = mysqli_query($db, "SELECT * FROM prodi");
          if (!$tampil) {
              die("Query Error: " . mysqli_error($db));
          }

          while ($data = mysqli_fetch_array($tampil)) {
          ?>
          <tr>
            <td><?php echo $data['nama_prodi']; ?></td>
            <td><?php echo $data['jenjang']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
              <!-- PERBAIKAN: Tambah parameter id -->
              <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>

      <p class="mt-3 text-center">
        Klik <a href="gbook.php" class="link-primary fw-bold">di sini</a> untuk proses input data Prodi
      </p>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>