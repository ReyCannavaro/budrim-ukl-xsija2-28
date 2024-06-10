<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudRim - Work</title>
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            font-weight: bold;
        }
        .hero {
            background-color: grey;
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }
        .hero h1 {
            font-size: 3em;
        }
        .advantages {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .advantage {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
            transition: transform 0.2s;
        }
        .advantage:hover {
            transform: scale(1.05);
        }
        .advantage h3 {
            text-align: left;
            margin-bottom: 10px;
        }
        .advantage p {
            text-align: left;
            margin-bottom: 10px;
            color: #555;
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

    <div class="hero">
        <div>
            <h1>Layanan Kami</h1>
        </div>
    </div>

    <div class="advantages">
        <?php
        // Menyertakan file koneksi database
        include 'koneksi.php';

        // Memastikan koneksi berhasil
        if (!$mysqli) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Query untuk mengambil data layanan
        $query = "SELECT jenis_layanan, deskripsi, hargaperkg FROM layanan";
        $result = $mysqli->query($query);

        // Memastikan query berhasil dijalankan
        if ($result) {
            if ($result->num_rows > 0) {
                // Menampilkan data layanan
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='advantage'>
                            <h3>" . htmlspecialchars($row['jenis_layanan']) . "</h3>
                            <p>Harga per KG: Rp. " . number_format($row['hargaperkg'], 2, ',', '.') . "</p>
                            <p>" . htmlspecialchars($row['deskripsi']) . "</p>
                          </div>";
                }
            } else {
                echo "<div class='advantage'><p>Tidak ada layanan yang tersedia.</p></div>";
            }
        } else {
            echo "<div class='advantage'><p>Error: " . $mysqli->error . "</p></div>";
        }

        // Menutup koneksi
        $mysqli->close();
        ?>
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
