<?php
session_start();
include 'koneksi/koneksi.php';

$message = "";

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_select = "SELECT * FROM pendaftaran WHERE id = $id";
    $result = $conn->query($sql_select);

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
} else {
    echo "ID data tidak ditemukan";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    // ... (kode validasi seperti sebelumnya)
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Jasa Pangkas</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/hairdresser.png" rel="icon">
    <link href="assets/img/hairdresser.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/hairdresser.png" alt="">
                <span class="d-none d-lg-block">JPR</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_pangkas.php">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Data Pangkas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="tambah_pangkas.php">
                    <i class="bi bi-plus"></i><span>Tambah Pangkas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="edit_pangkas.php">
                    <i class="bi bi-pencil"></i><span>Edit Pangkas</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Jasa Pangkas</h1>
        </div>

        <!-- Content goes here -->
        <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <!-- Form Input Fields -->
                <!-- ... (kode form input seperti pada tambah_pangkas.php tetapi dengan value dari $row) -->

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>

            <!-- Error Message -->
            <div class="text-center mt-3">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Styles -->
        <style>
            /* Style for the Content */
            .content {
                padding: 20px;
                background-color: #fff;
                margin-top: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            /* Style for form groups */
            .form-group {
                margin-bottom: 15px;
            }
        </style>

    </main>

    <!-- Include Font Awesome for the icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</html>
