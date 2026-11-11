<?php
session_start();

// Jika admin sudah terlanjur login, langsung arahkan ke data.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: data.php");
    exit();
}

$error = "";
if (isset($_POST['login'])) {
    $password = $_POST['password'];
    
    // Password admin sesuai yang kita tentukan sebelumnya
    if ($password === 'mgm2026ajwlm') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: data.php");
        exit();
    } else {
        $error = "Password admin salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AJWLM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .login-card {
            max-width: 420px;
            width: 100%;
        }
        .card-header {
            background-color: rgba(33, 37, 41, 0.95) !important;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">
    <div class="card shadow-sm login-card border-0">
        <div class="card-header text-white text-center py-4">
            <img src="logomerapi.png" alt="Logo Museum Gunungapi Merapi" style="max-height: 60px;" class="mb-3 p-1 rounded">
            <h4 class="mb-0 fw-bold">Login Admin</h4>
            <p class="text-white-50 small mb-0">Asosiasi Jeep Wisata Lereng Merapi</p>
        </div>
        
        <div class="card-body p-4">
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger py-2 small text-center"><?php echo $error; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Password Admin</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required autofocus>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" name="login" class="btn btn-dark">Masuk</button>
                </div>
                <div class="text-center">
                    <a href="index.php" class="text-decoration-none small text-muted">← Kembali ke Beranda Formulir</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>