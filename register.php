<?php



$servername = "localhost";
$username = "root";
$password = "";
$database = "pengeluaran_harian";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$alertMessage = ""; // Variabel untuk menyimpan pesan alert

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['username'] = $username;
        $alertMessage = "Registrasi berhasil! Silakan login."; // Set pesan alert
       
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // JavaScript untuk menampilkan pesan alert
        window.onload = function() {
            <?php if (!empty($alertMessage)) : ?>
                alert("<?php echo $alertMessage; ?>");
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Halaman Registrasi</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-secondary">Kembali ke Login</a> <!-- Tombol kembali ke halaman login -->
        </form>
    </div>
</body>
</html>
