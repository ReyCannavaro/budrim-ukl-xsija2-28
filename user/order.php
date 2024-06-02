<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != "user") {
    header("Location: ../login.php");
    exit();
}

// Menyertakan file koneksi database
include '../user/koneksi.php';

// Mendapatkan id_user dari session
$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_layanan = $_POST['id_layanan'];
    $bobotkg = $_POST['bobotkg'];
    $nama_penerima = $_POST['nama_penerima'];
    $alamat = $_POST['alamat'];
    $tanggal = date('Y-m-d');
    $status = 'paket sedang dijemput';

    // Membuat nomor resi unik
    $resi = uniqid('RESI');

    // Insert data ke tabel paket
    $query = "INSERT INTO paket (resi, id_user, id_layanan, tanggal, status, bobotkg, nama_penerima, alamat) 
              VALUES ('$resi', '$id_user', '$id_layanan', '$tanggal', '$status', '$bobotkg', '$nama_penerima', '$alamat')";

    if ($mysqli->query($query) === TRUE) {
        // Jika order berhasil, user akan diarahkan ke halaman order dengan resi sebagai parameter
        header("Location: ../user/order.php?resi=$resi");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Paket</title>
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
        .order-container {
            padding: 50px 20px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        .order-form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
        }
        .order-form h3 {
            margin-top: 0;
        }
        .order-form label {
            display: block;
            margin: 10px 0 5px;
        }
        .order-form input[type="text"],
        .order-form input[type="number"],
        .order-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .order-form button {
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

    <div class="order-container">
        <form method="post" class="order-form">
            <h3>Order Paket</h3>
            <label for="id_layanan">Layanan</label>
            <select id="id_layanan" name="id_layanan" required>
                <option value="1">Reguler</option>
                <option value="2">Express</option>
                <option value="3">Kargo</option>
                <option value="4">Next Day</option>
                <option value="5">Hemat</option>
            </select>

            <label for="bobotkg">Bobot (KG)</label>
            <input type="number" id="bobotkg" name="bobotkg" step="0.01" required>

            <label for="nama_penerima">Nama Penerima</label>
            <input type="text" id="nama_penerima" name="nama_penerima" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" required>

            <button type="submit">Order</button>
            <button type="button" onclick="location.href='../user/cek_paket.php'">Cek Paket</button>

        </form>
    </div>

    <div id="notification" style="display:none; background-color: #4CAF50; color: white; text-align: center; padding: 10px; margin-top: 20px;">
        Order berhasil, silahkan cek paket Anda.
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