<?php p
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require_once 'config/koneksi.php';

$error = false;

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // QUERY DATABASE ASLI TIM KELOMPOK
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Membaca kueri password database asli secara langsung
        if ($password === $row['password']) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Investasi Barang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Tombol Sakelar Tema -->
    <div style="text-align: right; padding: 20px;">
        <button id="theme-toggle" class="theme-switch-btn">🌙 Dark Mode</button>
    </div>

    <div class="login-container" style="max-width: 400px; margin: 40px auto; padding: 30px; border-radius: 8px;">
        <h2 style="margin-top: 0; text-align: center;">Masuk Sistem IB</h2>

        <?php if ($error) : ?>
            <p class="error-msg" style="color: #ef4444; font-weight: bold; text-align: center;">Username atau password salah!</p>
        <?php endif; ?>

        <form action="" method="post">
            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; margin-bottom: 5px; font-weight: 600;">Username</label>
                <input type="text" name="username" id="username" required autocomplete="off">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: 600;">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" name="submit" style="width: 100%; padding: 12px; font-size: 16px;">Login</button>
        </form>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html>