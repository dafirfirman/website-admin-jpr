<?php
include 'koneksi/koneksi.php';

$email = $_POST['email'];
$profile_image_url = $_POST['profile_image_url'];

$sql = "UPDATE profile SET foto_profile='$profile_image_url' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Profile image updated']);
} else {
    $errorMessage = "Error updating profile image: " . $conn->error;
    error_log($errorMessage);
    echo json_encode(['success' => false, 'message' => $errorMessage]);
}

$conn->close();
?>
