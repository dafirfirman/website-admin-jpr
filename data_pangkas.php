<?php
session_start();
include 'koneksi/koneksi.php';

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql_select = "SELECT * FROM data_pribadi";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Daftar Jasa Pangkas</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="assets/img/hairdresser.png" rel="icon">
    <link href="assets/img/hairdresser.png" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/hairdresser.png" alt="">
                <span class="d-none d-lg-block">JPR</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
    </header>

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
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Selamat Datang Admin</h1>
        </div>

        <div class="content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">NO.</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Panggilan</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Nama Pangkas</th>
                            <th>Alamat Pangkas</th>
                            <th>Telp</th>
                            <th>NIK</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include file koneksi database
                        include 'koneksi/koneksi.php';

                        // Query untuk mendapatkan data dari tabel data_pribadi
                        $sql_select = "SELECT * FROM data_pribadi";
                        $result = $conn->query($sql_select);

                        // Jika terdapat data
                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $count++ . "</td>";
                                echo "<td>" . $row["nama_lengkap"] . "</td>";
                                echo "<td>" . $row["nama_panggilan"] . "</td>";
                                echo "<td>" . $row["jenis_kelamin"] . "</td>";
                                echo "<td>" . $row["tempat_lahir"] . "</td>";
                                echo "<td>" . $row["tanggal_lahir"] . "</td>";
                                echo "<td>" . $row["nama_pangkas"] . "</td>";
                                echo "<td>" . $row["alamat_pangkas"] . "</td>";
                                echo "<td>" . $row["telp"] . "</td>";
                                echo "<td>" . $row["nik"] . "</td>";
                                echo "<td class='text-center'>
                                    <a href='edit_pangkas.php?id=" . $row["id"] . "' class='btn btn-sm btn-primary edit-btn' title='Edit' data-toggle='tooltip'><i class='fas fa-edit'></i></a>
                                    <a href='hapus_pangkas.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger delete-btn' title='Delete' data-toggle='tooltip' onclick='return confirmDelete(\"" . $row["id"] . "\")'><i class='fas fa-trash'></i></a>

                                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11' class='text-center'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="add-jasa-pangkas">
            <a href="tambah_pangkas.php" class="btn btn-success"><i class="bi bi-plus"></i> Tambah Jasa Pangkas</a>
        </div>

        <script>
            function confirmDelete(id) {
                return confirm("Apakah Anda yakin ingin menghapus data dengan ID " + id + "?");
            }
        </script>
    </main>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
