<?php
session_start();
include("../koneksi.php");

// Cek koneksi
if (!isset($db) || !$db) {
    die("ERROR: Koneksi database gagal!");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = "Email dan password harus diisi!";
    } else {
        $query = "SELECT * FROM pengguna WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                
                // Redirect langsung ke edit profil
                header("Location: edit_profil.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Email tidak terdaftar!";
        }
    }
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; }
        .required::after { content: " *"; color: red; }
        .login-container { margin-top: 100px; }
    </style>
</head>
<body class="bg-light">
    

    <div class="container login-container">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3 class="mb-0">Login Sistem</h3>
            </div>
            <div class="card-body">
                <!-- Tampilkan error jika ada -->
                <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <!-- Form Login -->
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="masukkan email anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label required">Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="masukkan password" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="Submit">Login</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    
                    <!-- Info login demo -->
                    <div class="mt-3 text-center">
                       
                    </div>
                    
                    <!-- Info setelah login -->
                    <div class="mt-3 alert alert-info">
                        <small>
                            <i class="bi bi-info-circle"></i> 
                            Setelah login, Anda akan langsung diarahkan ke halaman Edit Profil.
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>