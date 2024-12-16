<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Contoh data pesanan untuk demonstrasi (ganti dengan query database jika diperlukan)
$orders = [
    ['order_id' => 1, 'customer_name' => 'John Doe', 'product_name' => 'Produk 1', 'quantity' => 2, 'total_price' => 200000, 'status' => 'Diproses'],
    ['order_id' => 2, 'customer_name' => 'Jane Smith', 'product_name' => 'Produk 2', 'quantity' => 1, 'total_price' => 150000, 'status' => 'Terkirim'],
    ['order_id' => 3, 'customer_name' => 'Mark Johnson', 'product_name' => 'Produk 3', 'quantity' => 5, 'total_price' => 1000000, 'status' => 'Diproses'],
];

// Simpan Pesanan Baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_order') {
    // Ambil data dari form
    $customer_name = $_POST['customer_name'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];

    // Tambahkan pesanan baru ke array (ganti dengan query SQL jika menggunakan database)
    $new_order = [
        'order_id' => count($orders) + 1, // ID pesanan baru
        'customer_name' => $customer_name,
        'product_name' => $product_name,
        'quantity' => $quantity,
        'total_price' => $total_price,
        'status' => $status,
    ];
    $orders[] = $new_order; // Simpan pesanan baru

    header("Location: orders.php"); // Redirect ke halaman orders setelah simpan
    exit();
}

// Edit Status Pesanan
if (isset($_GET['edit'])) {
    $order_id = $_GET['edit'];
    foreach ($orders as $key => $order) {
        if ($order['order_id'] == $order_id) {
            // Update status pesanan
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $orders[$key]['status'] = $_POST['status'];
                header("Location: orders.php");
                exit();
            }
            break;
        }
    }
}

// Hapus Pesanan
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    foreach ($orders as $key => $order) {
        if ($order['order_id'] == $order_id) {
            unset($orders[$key]); // Hapus pesanan
            header("Location: orders.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_products.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Daftar Pesanan</h1>

        <!-- Form Tambah Pesanan -->
        <div class="mb-3">
            <h3>Tambah Pesanan Baru</h3>
            <form action="orders.php" method="POST">
                <input type="hidden" name="action" value="add_order">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Total Harga</label>
                    <input type="number" name="total_price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Diproses">Diproses</option>
                        <option value="Terkirim">Terkirim</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <!-- Tabel Pesanan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['order_id']; ?></td>
                    <td><?= $order['customer_name']; ?></td>
                    <td><?= $order['product_name']; ?></td>
                    <td><?= $order['quantity']; ?></td>
                    <td>Rp. <?= number_format($order['total_price'], 0, ',', '.'); ?></td>
                    <td><?= $order['status']; ?></td>
                    <td>
                        <a href="orders.php?edit=<?= $order['order_id']; ?>" class="btn btn-warning btn-sm">Edit Status</a>
                        <a href="orders.php?delete=<?= $order['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-light text-center py-3">
        <p>&copy; <?= date('Y'); ?> Website Penjualan Produk. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
