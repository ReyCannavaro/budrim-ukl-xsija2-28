<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != "user") {
    header("Location: ../login");
    exit();
}

// Menyertakan file koneksi database
include '../user/koneksi.php';

// Mendapatkan id_user dari session
$id_user = $_SESSION['id_user'];

// Query untuk mendapatkan data paket
$query = "SELECT paket.resi, paket.nama_penerima, paket.alamat, paket.status, paket.bobotkg, layanan.hargaperkg
          FROM paket
          INNER JOIN layanan ON paket.id_layanan = layanan.id_layanan
          WHERE paket.id_user = $id_user";

$result = $mysqli->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Order</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }
        .order-card {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-card h2 {
            margin-top: 0;
        }
        .order-card p {
            margin: 5px 0;
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
        <h2>Riwayat Order Paket</h2>
        <?php
        // Perulangan untuk menampilkan data paket
        while ($row = $result->fetch_assoc()) {
            $total_harga = $row['bobotkg'] * $row['hargaperkg'];
        ?>
        <div class="order-card">
            <h2>Resi: <?php echo $row['resi']; ?></h2>
            <p>Nama Penerima: <?php echo $row['nama_penerima']; ?></p>
            <p>Alamat: <?php echo $row['alamat']; ?></p>
            <p>Status: <?php echo $row['status']; ?></p>
            <p>Bobot (KG): <?php echo $row['bobotkg']; ?></p>
            <p>Total Harga: <?php echo $total_harga; ?></p>
        </div>
        <?php } ?>
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
// Menutup koneksi database
$mysqli->close();
?>
