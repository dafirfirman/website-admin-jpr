<?php
include 'koneksi/koneksi.php'; // Memasukkan file koneksi.php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Query untuk mengambil data profile dari database
    $sql = "SELECT email, nama, foto_profile, alamat, telp FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}

$conn->close();
?>
