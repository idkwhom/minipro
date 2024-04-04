<?php

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // Arahkan kembali ke halaman login jika belum login
    exit; // Hentikan eksekusi script setelah melakukan redirect
}
require_once 'db_connection.php';

$amount = $_POST['amount'];
$description = $_POST['description'];
$date = $_POST['date'];
$category = $_POST['category'];

$query = "INSERT INTO expenses (amount, description, date, category) VALUES ('$amount', '$description', '$date', '$category')";

if (mysqli_query($conn, $query)) {
    header('Location: view_expense.php');
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
