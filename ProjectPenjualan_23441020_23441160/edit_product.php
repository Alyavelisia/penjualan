<?php
session_start();

// Pastikan pengguna sudah login dan memiliki izin yang tepat
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Memeriksa apakah ID produk diberikan untuk diedit
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Biasanya, Anda akan mengambil data produk berdasarkan ID dari database.
    // Contoh statis produk untuk demonstrasi
    $products = [
        1 => ['name' => 'Produk 1', 'price' => 100000, 'stock' => 10],
        2 => ['name' => 'Produk 2', 'price' => 150000, 'stock' => 20],
        3 => ['name' => 'Produk 3', 'price' => 200000, 'stock' => 30],
    ];

    // Ambil data produk berdasarkan ID
    if (isset($products[$product_id])) {
        $product = $products[$product_id];
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak tersedia.";
    exit();
}

// Proses form jika data telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input dari form
    $product_name = htmlspecialchars($_POST['name']);
    $product_price = floatval($_POST['price']);
    $product_stock = intval($_POST['stock']);

    // Biasanya Anda akan melakukan update pada database di sini
    // Misalnya:
    // $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
    // $stmt->execute([$product_name, $product_price, $product_stock, $product_id]);

    echo "Produk berhasil diperbarui!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h2>Edit Produk</h2>
        <form action="edit_product.php?id=<?= $product_id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Harga Produk</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stock">Stok Produk</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
