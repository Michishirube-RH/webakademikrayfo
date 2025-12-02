<h2 class="text-center my-4">List Data Akademik</h2>

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
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include("koneksi.php");
          $tampil = mysqli_query($db, "SELECT * FROM mahasiswa");
          if (!$tampil) {
              die("Query Error: " . mysqli_error($db));
          }

          while ($data = mysqli_fetch_array($tampil)) {
          ?>
          <tr>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama_mhs']; ?></td>
            <td><?php echo $data['tgl_lahir']; ?></td>
            <td><?php echo $data['alamat']; ?></td>

            <td>
              <a href="edit.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="hapus.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>

      <p class="mt-3 text-center">
        Klik <a href="gbook.php" class="link-primary fw-bold">di sini</a> untuk proses input buku tamu
      </p>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
