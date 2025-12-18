<?php
include("../koneksi.php");
?>
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
<h2 class="text-center my-4">Data Mahasiswa</h2>

<div class="container">
  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th scope="col">NIM</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Alamat</th>
            <th scope="col">Prodi</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //  gunakan prodi_id 
          $sql = "SELECT m.*, p.nama_prodi, p.jenjang 
                  FROM mahasiswa m 
                  LEFT JOIN prodi p ON m.prodi_id = p.id 
                  ORDER BY m.nim";
          $tampil = mysqli_query($db, $sql);
          
          if (!$tampil) {
              die("Query Error: " . mysqli_error($db));
          }

          if (mysqli_num_rows($tampil) == 0) {
              echo '<tr><td colspan="6" class="text-center">Tidak ada data mahasiswa</td></tr>';
          } else {
              while ($data = mysqli_fetch_array($tampil)) {
              ?>
              <tr>
                <td><?php echo htmlspecialchars($data['nim']); ?></td>
                <td><?php echo htmlspecialchars($data['nama_mhs']); ?></td>
                <td><?php echo date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
                <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                <td>
                  <?php 
                  if (!empty($data['nama_prodi'])) {
                      echo htmlspecialchars($data['nama_prodi']) . ' (' . $data['jenjang'] . ')';
                  } else {
                      echo '<span class="text-muted">-</span>';
                  }
                  ?>
                </td>
                <td>
                  <a href="edit.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="hapus.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-danger" 
                     onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
              </tr>
              <?php
              }
          }
          ?>
        </tbody>
      </table>

      <p class="mt-3 text-center">
        Klik <a href="gbook.php" class="link-primary fw-bold">di sini</a> untuk input data Mahasiswa
      </p>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>