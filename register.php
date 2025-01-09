<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "webdailyjurnal");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } elseif (strlen($password) < 8) {
        $error = "Password harus memiliki minimal 8 karakter!";
    } else {
        // Enkripsi password
        $password_hashed = md5($password);

        // Query untuk memasukkan data pengguna
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password_hashed);

        if ($stmt->execute()) {
            $success = "Akun berhasil dibuat! Silakan <a href='login.php'>login</a>.";
        } else {
            $error = "Gagal membuat akun!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card small shadow p-4">
                    <div class="card-body">
                        <!-- <h3 class="text-center">Daftar Akun</h3> -->
                        <div class="d-flex flex-column align-items-center mb-4 text-dark">
                            <i class="bi bi-person-plus fs-1"></i>
                            <span class="fw-bold fs-5">
                                Sign-up
                            </span>
                        </div>
                        <!-- Menampilkan Pesan Error -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <!-- Menampilkan Pesan Sukses -->
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $success ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form Register -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <small class="form-text text-muted">Minimal 8 karakter</small>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>

                            <div class="w-100">
                                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            </div>
                        </form>

                        <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
