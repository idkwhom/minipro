<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // Arahkan kembali ke halaman login jika belum login
    exit; // Hentikan eksekusi script setelah melakukan redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Pengeluaran Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Catatan Pengeluaran Harian</a>
        <br>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="tambah.php">Tambah Pengeluaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_expense.php">Lihat Pengeluaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Halaman Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Selamat Datang di Catatan Pengeluaran Harian!</h1>
        <p class="lead">Catat pengeluaran Anda secara rapi dan efisien.</p>
        <hr class="my-4">
        <p>Selamat mencatat!</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
