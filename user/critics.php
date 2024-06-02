<?php
session_start(); // Mulai sesi
require_once '../admin/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID pengguna dari sesi login
    $id_user = $_SESSION['id_user']; // Anda perlu menyesuaikan dengan nama variabel sesi Anda

    $pesan = $con->real_escape_string($_POST['pesan']);
    $resi = $con->real_escape_string($_POST['resi']);
    
    // Query insert dengan id_user dan resi
    $sql = "INSERT INTO feedback (id_user, pesan, resi) VALUES ('$id_user', '$pesan', '$resi')";
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Thank you for your feedback!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudRim - Critics and Suggestions</title>
    <link rel="stylesheet" href="../style.css">
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
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            color: #fff;
            background-color: #5cb85c;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #d9534f;
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
            <img src="../aset/BudRim.png" alt="my-logo">
        </div>
        <ul>
            <li><a href="../user/index.php">Home</a></li>
            <li><a href="../user/work.php">Work</a></li>
            <li><a href="../user/order.php">Order</a></li>
            <li><a href="../user/critics.php">Critics</a></li>
            <li><a href="../user/profil.php">Profil</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Kritik dan Saran</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="resi">Nomor Resi:</label>
                <input type="text" class="form-control" id="resi" name="resi" required>
            </div>
            <div class="form-group">
                <label for="pesan">Pesan:</label>
                <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
