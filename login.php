<?php
// Mulai sesi
session_start();

// Cek jika pengguna telah mengirimkan form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah email dan password benar
    if ($_POST['email'] === 'admin@gmail.com' && $_POST['password'] === '12345678') {
        // Simpan status login ke sesi
        $_SESSION['logged_in'] = true;
        // Redirect ke dashboard.php dengan notifikasi login berhasil
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        // Jika tidak benar, kembali ke halaman login dengan pesan kesalahan
        header("Location: index.php?error=1");
        exit;
    }
} else {
    // Jika pengguna mencoba mengakses file secara langsung, arahkan kembali ke halaman login
    header("Location: index.php");
    exit;
}
?>
