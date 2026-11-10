<?php p
session_start();

// Proteksi Sesi Ketat
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Mekanisme Keamanan: Hancurkan cache agar tombol Back browser tidak mem-bypass login setelah logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Investasi Barang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header Panel Utama -->
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; border-bottom: 1px solid var(--border-color);">
        <h2 style="margin: 0; font-size: 22px;">Aplikasi Investasi Barang (IB)</h2>
        <div style="display: flex; gap: 20px; align-items: center;">
            <span>Selamat Datang, <strong style="color: var(--primary-color);"><?php echo htmlspecialchars($_SESSION['user']); ?></strong></span>
            <!-- Tombol Sakelar Tema -->
            <button id="theme-toggle" class="theme-switch-btn">🌙 Dark Mode</button>
            <a href="logout.php" style="color: #ef4444; font-weight: bold; text-decoration: none;">Keluar</a>
        </div>
    </header>

    <!-- Papan Kendali Data CRUD -->
    <main class="main-dashboard" style="margin: 30px; padding: 25px; border-radius: 8px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; font-size: 20px;">Daftar Aset Investasi Terdaftar</h3>
            <a href="tambah.php" class="btn-primary" style="text-decoration: none; padding: 10px 18px; display: inline-block; border-radius: 6px;">➕ Tambah Barang</a>
        </div>

        <table border="0" cellpadding="12" cellspacing="0" style="width: 100%; border-collapse: collapse; border: 1px solid var(--border-color);">
            <thead>
                <tr style="background-color: var(--toggle-btn-bg); border-bottom: 2px solid var(--border-color); text-align: left;">
                    <th>ID</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Nilai Investasi</th>
                    <th style="text-align: center;">Aksi Operasional</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data barang langsung dari query database asli proyek
                $query = "SELECT * FROM barang";
                $result = mysqli_query($koneksi, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr style='border-bottom: 1px solid var(--border-color);'>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: center;'>
                                <a href='edit.php?id=" . $row['id'] . "' style='color: var(--primary-color); text-decoration: none; font-weight: 600;'>Edit</a> |
                                <a href='hapus.php?id=" . $row['id'] . "' style='color: #ef4444; text-decoration: none; font-weight: 600;' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center; color: var(--text-muted);'>Belum ada data barang di dalam database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <script src="assets/js/app.js"></script>
</body>
</html>