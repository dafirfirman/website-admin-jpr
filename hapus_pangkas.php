<?php
session_start();
include 'koneksi/koneksi.php';

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah parameter id telah diterima dari tautan "Delete" dan tidak kosong
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Escape input untuk mencegah serangan SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query SQL untuk menghapus data berdasarkan ID
    $sql_delete = "DELETE FROM data_pribadi WHERE id = '$id'";

    // Melakukan query penghapusan
    if ($conn->query($sql_delete) === TRUE) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman data_pangkas.php
        header("Location: data_pangkas.php");
        exit;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika ID tidak diterima atau kosong, arahkan kembali ke halaman data_pangkas.php
    header("Location: data_pangkas.php");
    exit;
}
?>
