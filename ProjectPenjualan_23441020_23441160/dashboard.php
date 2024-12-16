<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard Penjualan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_products.php"><i class="fas fa-box"></i> Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> Pesanan</a>
                </li>
                
                <!-- Menampilkan Login atau Logout sesuai status session -->
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container mt-5">
        <h1>Selamat datang di Dashboard Penjualan Produk!</h1>
        <p>Di sini Anda dapat melihat berbagai informasi terkait penjualan dan produk.</p>

        <div class="row">
            <!-- Kartu Statistik Produk -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header"><i class="fas fa-boxes"></i> Total Produk</div>
                    <div class="card-body">
                        <h5 class="card-title">50 Produk</h5>
                        <p class="card-text">Jumlah total produk yang tersedia untuk dijual.</p>
                    </div>
                </div>
            </div>

            <!-- Kartu Statistik Pesanan -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header"><i class="fas fa-shopping-cart"></i> Total Pesanan</div>
                    <div class="card-body">
                        <h5 class="card-title">25 Pesanan</h5>
                        <p class="card-text">Jumlah pesanan yang telah diterima.</p>
                    </div>
                </div>
            </div>

            <!-- Kartu Statistik Pendapatan -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header"><i class="fas fa-dollar-sign"></i> Total Pendapatan</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp. 2.500.000</h5>
                        <p class="card-text">Pendapatan total yang diperoleh dari penjualan produk.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik atau Tabel Statistik Lainnya -->
        <h3>Statistik Penjualan</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Grafik Penjualan Bulan Ini</div>
                    <div class="card-body">
                        <p>Di sini Anda bisa menambahkan grafik atau statistik lainnya mengenai penjualan produk menggunakan library seperti Chart.js atau Google Charts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <p>&copy; <?= date('Y'); ?> Website Penjualan Produk. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
