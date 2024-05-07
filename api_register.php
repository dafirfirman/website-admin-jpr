<?php
header("Content-Type: application/json");

include 'koneksi/koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if(isset($input['email']) && isset($input['password'])) {
        $email = $input['email'];
        $password = $input['password'];
        
        // TODO: Anda juga bisa menambahkan sanitasi untuk email dan password di sini sesuai kebutuhan
        
        // Prepared statement untuk mencegah SQL Injection
        $query = "INSERT INTO user (email, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            // Bind parameter ke prepared statement
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            
            // Eksekusi statement
            if (mysqli_stmt_execute($stmt)) {
                $response['success'] = true;
                $response['message'] = "User registered successfully";
            } else {
                $response['success'] = false;
                $response['message'] = "Failed to register user";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Failed to prepare statement";
        }
        
        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
        $response['message'] = "Email and password are required";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

// Menutup koneksi ke database jika diperlukan
mysqli_close($conn);

echo json_encode($response);
?> 