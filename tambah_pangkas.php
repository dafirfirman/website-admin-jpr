<?php
session_start();
include 'koneksi/koneksi.php';

$message = "";

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = filter_var($_POST['nama_lengkap'], FILTER_SANITIZE_STRING);
    $nama_panggilan = filter_var($_POST['nama_panggilan'], FILTER_SANITIZE_STRING);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = filter_var($_POST['tempat_lahir'], FILTER_SANITIZE_STRING);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nama_pangkas = filter_var($_POST['nama_pangkas'], FILTER_SANITIZE_STRING);
    $alamat_pangkas = filter_var($_POST['alamat_pangkas'], FILTER_SANITIZE_STRING);
    $telp = filter_var($_POST['telp'], FILTER_SANITIZE_STRING);
    $nik = filter_var($_POST['nik'], FILTER_SANITIZE_NUMBER_INT);

    // Validations
    if (!preg_match('/^[0-9]+$/', $nik) || strlen($nik) != 16) {
        $message = "NIK harus berupa 16 angka";
    } else {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO `data_pribadi`(`nama_lengkap`, `nama_panggilan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nama_pangkas`, `alamat_pangkas`, `telp`, `nik`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $nama_lengkap, $nama_panggilan, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $nama_pangkas, $alamat_pangkas, $telp, $nik);

        if ($stmt->execute()) {
            $message = "Data berhasil disimpan";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tambah Jasa Pangkas</title>
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
                <a class="nav-link " href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="data_pangkas.php">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Data Pangkas</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Jasa Pangkas</h1>
        </div>

        <!-- Content goes here -->
        <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <!-- Email -->
                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <!-- Nama Panggilan -->
                <div class="form-group">
                    <label for="nama_panggilan">Nama Panggilan</label>
                    <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" required>
                </div>
                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <!-- Tempat Lahir -->
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>
                <!-- Tanggal Lahir -->
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <!-- Nama Pangkas -->
                <div class="form-group">
                    <label for="nama_pangkas">Nama Pangkas</label>
                    <input type="text" class="form-control" id="nama_pangkas" name="nama_pangkas" required>
                </div>
                <!-- Alamat Pangkas -->
                <div class="form-group">
                    <label for="alamat_pangkas">Alamat Pangkas</label>
                    <input type="text" class="form-control" id="alamat_pangkas" name="alamat_pangkas" required>
                </div>
                <!-- Telepon -->
                <div class="form-group">
                    <label for="telp">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="telp" name="telp" required>
                </div>
                
                <!-- NIK -->
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required maxlength="16">
                </div>
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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

            /* Style for Add Jasa Pangkas Button */
            .add-jasa-pangkas {
                margin-top: 20px;
                text-align: right;
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
