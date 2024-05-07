<?php
include 'koneksi/koneksi.php'; // Memasukkan file koneksi.php

$message = ''; // Variabel untuk menyimpan pesan

// Mengatur batas ukuran file menjadi tanpa batas
$maxFileSize = -1; // Tanpa batas

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $nama = isset($_POST['name']) ? $_POST['name'] : '';  // Mengambil 'name' dari $_POST
    $alamat = isset($_POST['address']) ? $_POST['address'] : '';  // Mengambil 'address' dari $_POST
    $telp = isset($_POST['phone']) ? $_POST['phone'] : '';  // Mengambil 'phone' dari $_POST

    // Mengunggah file foto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto_profile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto_profile"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Mengupload file
    if ($uploadOk == 0) {
        $message = "Maaf, file tidak terupload.";
    } else {
        if (move_uploaded_file($_FILES["foto_profile"]["tmp_name"], $target_file)) {
            // Query untuk menyimpan data ke database
            $sql = "INSERT INTO pendaftaran (username, email, password, nama, foto_profile, alamat, telp) 
                    VALUES ('$username', '$email', '$password', '$nama', '$target_file', '$alamat', '$telp')";
            
            if ($conn->query($sql) === TRUE) {
                $message = "Data berhasil disimpan.";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $message = "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi Pengguna</title>
</head>
<body>

<h2><?php echo $message; ?></h2>

<form action="api_upload_foto.php" method="post" enctype="multipart/form-data">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    
    <label>Nama:</label>
    <input type="text" name="nama" required><br><br>
    
    <label>Foto Profil:</label>
    <input type="file" name="foto_profile" required><br><br>
    
    <label>Alamat:</label>
    <textarea name="alamat" required></textarea><br><br>
    
    <label>Telepon:</label>
    <input type="tel" name="telp" required><br><br>
    
    <input type="submit" name="submit" value="Simpan">
</form>

</body>
</html>
