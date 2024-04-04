<?php
// Pastikan session dimulai sebelum menggunakan session
session_start();

// Periksa apakah pengguna belum login
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // Arahkan kembali ke halaman login jika belum login
    exit; // Hentikan eksekusi script setelah melakukan redirect
}

// Periksa apakah parameter ID tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Parameter ID tidak valid.";
    exit;
}

// Ambil ID pengeluaran dari parameter URL
$id = $_GET['id'];

// Sertakan file koneksi database
require_once 'db_connection.php';

// Query untuk mengambil data pengeluaran berdasarkan ID
$query = "SELECT * FROM expenses WHERE id = $id";
$result = mysqli_query($conn, $query);

// Periksa apakah pengeluaran dengan ID yang diberikan ditemukan
if (mysqli_num_rows($result) == 0) {
    echo "Pengeluaran tidak ditemukan.";
    exit;
}

// Ambil data pengeluaran dari hasil query
$expense = mysqli_fetch_assoc($result);

// Tangkap data yang telah diubah, jika ada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    // Query untuk melakukan update pengeluaran
    $update_query = "UPDATE expenses SET amount='$amount', description='$description', category='$category', date='$date' WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($conn, $update_query)) {
        echo "Pengeluaran berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui pengeluaran: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Pengeluaran</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="amount">Jumlah:</label>
                <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $expense['amount']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea name="description" id="description" class="form-control"><?php echo $expense['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategori:</label>
                <input type="text" name="category" id="category" class="form-control" value="<?php echo $expense['category']; ?>">
            </div>
            <div class="form-group">
                <label for="date">Tanggal:</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo $expense['date']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
