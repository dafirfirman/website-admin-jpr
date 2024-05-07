<?php
header("Content-Type: application/json");

include 'koneksi/koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $email = $_GET['email'];
    $password = $_GET['password'];

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $response['success'] = true;
        $response['message'] = "Login successful";
    } else {
        $response['success'] = false;
        $response['message'] = "Incorrect email or password";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

mysqli_close($conn);

echo json_encode($response);
?>