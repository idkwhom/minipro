<?php
session_start();

// Periksa apakah pengguna belum login
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
    <title>Daftar Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Pengeluaran</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="category">Filter berdasarkan kategori:</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Semua</option>
                    <?php
                    require_once 'db_connection.php';

                    $query = "SELECT DISTINCT category FROM expenses";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Filter</button>
            <br>
        </form>

        <br>

        <div class="table-responsive"> <!-- Tambahkan kelas table-responsive -->
            <table class="table table-striped"> <!-- Tambahkan kelas table-striped -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $category_filter = $_POST['category'];
                        $query = "SELECT * FROM expenses";
                        if (!empty($category_filter)) {
                            $query .= " WHERE category='$category_filter'";
                        }
                    } else {
                        $query = "SELECT * FROM expenses";
                    }

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>Rp" . $row['amount'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_expense_form.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a> "; // Perbaiki tautan edit
                            echo "<a href='delete_expense.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada catatan pengeluaran.</td></tr>";
                    }
                    ?>
                </tbody>
                
            </table>
        </div>
        <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
    </div>
</body>
</html>
