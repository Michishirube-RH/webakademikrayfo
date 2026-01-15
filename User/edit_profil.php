<?php
session_start();
include("../koneksi.php");

// Cek login - jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cek koneksi
if (!isset($db) || !$db) {
    die("ERROR: Koneksi database gagal!");
}

$success = '';
$error = '';

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$nama_lengkap = $_SESSION['nama_lengkap'];

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_baru = mysqli_real_escape_string($db, $_POST['nama_lengkap']);
    $password_baru = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi_password'];
    
    // Validasi
    if (empty($nama_baru)) {
        $error = "Nama lengkap harus diisi!";
    } elseif (!empty($password_baru)) {
        if (strlen($password_baru) < 6) {
            $error = "Password minimal 6 karakter!";
        } elseif ($password_baru !== $konfirmasi) {
            $error = "Konfirmasi password tidak cocok!";
        } else {
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $query = "UPDATE pengguna SET nama_lengkap = '$nama_baru', password = '$password_hash' WHERE id = $user_id";
            
            if (mysqli_query($db, $query)) {
                $_SESSION['nama_lengkap'] = $nama_baru;
                $success = "Profil berhasil diperbarui!";
                $nama_lengkap = $nama_baru;
            } else {
                $error = "Gagal: " . mysqli_error($db);
            }
        }
    } else {
        $query = "UPDATE pengguna SET nama_lengkap = '$nama_baru' WHERE id = $user_id";
        
        if (mysqli_query($db, $query)) {
            $_SESSION['nama_lengkap'] = $nama_baru;
            $success = "Nama berhasil diperbarui!";
            $nama_lengkap = $nama_baru;
        } else {
            $error = "Gagal: " . mysqli_error($db);
        }
    }
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 800px; }
        .required::after { content: " *"; color: red; }
        .readonly-field {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
        .welcome-message {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Edit Profil</a>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../mahasiswa/list.php">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../prodi/list.php">Data Prodi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="#"><?php echo $_SESSION['nama_lengkap']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Welcome Message -->
        <div class="welcome-message text-center">
            <h4>Selamat Datang, <?php echo htmlspecialchars($nama_lengkap); ?>!</h4>
            <p class="mb-0">Silakan lengkapi atau perbarui profil Anda sebelum melanjutkan</p>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3 class="mb-0">Edit Profil Pengguna</h3>
            </div>
            <div class="card-body">
                <!-- Tampilkan pesan sukses/error -->
                <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <!-- Info penting -->
                <div class="alert alert-info mb-4">
                    <strong>Perhatian!</strong> Alamat email tidak dapat diubah setelah registrasi.
                </div>
                
                <!-- Form Edit Profil -->
                <form method="post" action="">
                    <!-- Email (Read Only) -->
                    <div class="mb-3">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" class="form-control readonly-field" id="email" 
                               value="<?php echo htmlspecialchars($email); ?>" 
                               readonly>
                        <div class="form-text text-muted">Email tidak dapat diubah</div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label required">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                               value="<?php echo htmlspecialchars($nama_lengkap); ?>" required>
                    </div>

                    <!-- Password Baru (Opsional) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        <div class="form-text">Minimal 6 karakter</div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" 
                               placeholder="Konfirmasi password baru">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="Submit">Simpan Perubahan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="../mahasiswa/list.php" class="btn btn-success">Lanjut ke Dashboard</a>
                    </div>
                </form>
                
                <!-- Info akun -->
                <div class="mt-4 pt-3 border-top">
                    <h6>Informasi Akun:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>User ID:</strong> <?php echo $user_id; ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($nama_lengkap); ?></p>
                            <p><strong>Status Login:</strong> 
                                <span class="badge bg-success">Berhasil</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">
                    Setelah memperbarui profil, klik "Lanjut ke Dashboard" untuk mengakses data mahasiswa
                </small>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Validasi Client-side -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const konfirmasi = document.getElementById('konfirmasi_password').value;
            
            if (password !== '' && password.length < 6) {
                alert('Password minimal 6 karakter!');
                e.preventDefault();
                return false;
            }
            
            if (password !== '' && password !== konfirmasi) {
                alert('Konfirmasi password tidak cocok!');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
        
        // Auto-focus ke field nama lengkap saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nama_lengkap').focus();
        });
    </script>
</body>
</html>