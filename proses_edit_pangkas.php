<?php
session_start();
include 'koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_panggilan = $_POST['nama_panggilan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nama_pangkas = $_POST['nama_pangkas'];
    $alamat_pangkas = $_POST['alamat_pangkas'];
    $telp = $_POST['telp'];

    

    $sql_update = "UPDATE pendaftaran SET email='$email', nama_lengkap='$nama_lengkap', nama_panggilan='$nama_panggilan', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', nama_pangkas='$nama_pangkas',alamat_pangkas='$alamat_pangkas',telp='$telp WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

$conn->close();
?>
