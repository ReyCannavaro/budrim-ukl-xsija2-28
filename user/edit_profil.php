<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != "user") {
    header("Location: ../login");
    exit();
}

// Menyertakan file koneksi database
include '../user/koneksi.php';

// Memastikan koneksi berhasil
if (!$mysqli) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengambil data pengguna dari database berdasarkan sesi username
$username = $_SESSION['username'];
$query = "SELECT nama, username, password, no_telp, alamat FROM user WHERE username = '$username'";
$result = $mysqli->query($query);

// Memastikan query berhasil dijalankan
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Gagal mengambil data profil pengguna.";
    exit();
}

// Memproses data jika form disubmit
if (isset($_POST['update'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $no_telp = $mysqli->real_escape_string($_POST['no_telp']);
    $alamat = $mysqli->real_escape_string($_POST['alamat']);

    $update_query = "UPDATE user SET nama='$nama', username='$username', password='$password', no_telp='$no_telp', alamat='$alamat' WHERE username='$username'";

    if ($mysqli->query($update_query) === TRUE) {
        echo "Profil berhasil diperbarui.";
        // Perbarui data sesi
        $_SESSION['username'] = $username;
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        nav {
            background-color: white;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            color: black;
            text-decoration: none;
        }
        .profile-container {
            padding: 50px 20px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-info {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
        }
        .profile-info h3 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit-button {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: left;
        }
        .footer-section {
            margin-bottom: 20px;
        }
        .footer-section h4 {
            margin-bottom: 10px;
        }
        .footer-section p, .footer-section a {
            margin: 5px 0;
            color: #ccc;
            text-decoration: none;
        }
        .footer-section a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="aset/BudRim.png" alt="BudRim Logo" />
        </div>
        <ul>
            <li><a href="../user/index.php">Home</a></li>
            <li><a href="../user/work.php">Work</a></li>
            <li><a href="../user/order.php">Order</a></li>
            <li><a href="../user/critics.php">Critics</a></li>
            <li><a href="../user/profil.php">Profil</a></li>
        </ul>
    </nav>

    <div class="profile-container">
        <div class="profile-info">
            <h3>Edit Profil Pengguna</h3>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No. Telepon:</label>
                    <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($user['no_telp']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($user['alamat']); ?>" required>
                </div>
                <button type="submit" name="update" class="submit-button">Update Profil</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>Alamat</h4>
                <p>Jl. Budal Kirim No.114, Kota Budal, Negara Kirim</p>
            </div>
            <div class="footer-section">
                <h4>Nomor Telepon</h4>
                <p>+62 821 3953 1132</p>
            </div>
            <div class="footer-section">
                <h4>Instagram</h4>
                <p><a href="https://www.instagram.com/budal_kirim" target="_blank">@budal_kirim</a></p>
            </div>
            <div class="footer-section">
                <h4>Facebook</h4>
                <p><a href="https://www.facebook.com/budal_kirim" target="_blank">Budal Kirim</a></p>
            </div>
            <div class="footer-section">
                <h4>Tentang Budal Kirim</h4>
                <p>Budal Kirim adalah layanan pengiriman terpercaya yang memastikan paket Anda sampai dengan aman dan tepat waktu. Kami berkomitmen untuk memberikan pelayanan terbaik kepada pelanggan.</p>
            </div>
        </div>
        <p>&copy; 2024 BudRim. All Rights Reserved.</p>
    </footer>
</body>
</html>
<?php
// Close the connection
$mysqli->close();
?>
