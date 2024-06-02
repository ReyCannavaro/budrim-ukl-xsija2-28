<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudRim - Cari Paket</title>
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
        .search-features {
            background-color: grey;
            padding: 50px 20px;
            text-align: center;
        }
        .search-feature {
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .search-feature h3 {
            margin-top: 20px;
            font-weight: normal;
        }
        .search-bar {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-button {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-results {
            max-width: 600px;
            margin: 0 auto;
        }
        .search-result-item {
            background-color: #f4f4f4;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
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
            <img src="ase/BudRim.png" alt="BudRim Logo" />
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="work.php">Work</a></li>
            <li><a href="../ukl%20x/login/index.php">Order</a></li>
            <li><a href="../ukl%20x/login/index.php">Login</a></li>
        </ul>
    </nav>

    <div class="search-features">
        <div class="search-feature">
            <h3>Cari Paket</h3>
            <form method="post">
                <input type="text" name="search" class="search-bar" placeholder="Masukkan nomor resi...">
                <button type="submit" name="submit" class="search-button">Cari</button>
            </form>
            <div class="search-results">
                <?php
                // Menyertakan file koneksi database
                include 'koneksi.php';

                // Memastikan koneksi berhasil
                if (!$mysqli) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                if (isset($_POST['submit'])) {
                    $search = $mysqli->real_escape_string($_POST['search']);
                    $query = "
                        SELECT paket.resi, pengirim.nama AS nama_pengirim, penerima.nama AS nama_penerima, layanan.jenis_layanan, paket.tanggal, paket.status, layanan.hargaperkg, paket.bobotkg, (layanan.hargaperkg * paket.bobotkg) AS total_harga
                        FROM paket
                        JOIN pengirim ON paket.id_pengirim = pengirim.id_pengirim
                        JOIN penerima ON paket.id_penerima = penerima.id_penerima
                        JOIN layanan ON paket.id_layanan = layanan.id_layanan
                        WHERE paket.resi LIKE '%$search%' OR pengirim.nama LIKE '%$search%' OR penerima.nama LIKE '%$search%' OR layanan.jenis_layanan LIKE '%$search%'";
                    $result = $mysqli->query($query);

                    // Tambahkan pengecekan apakah query berhasil dijalankan
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='search-result-item'>
                                        <h3>Resi: " . htmlspecialchars($row['resi']) . "</h3>
                                        <p>Nama Pengirim: " . htmlspecialchars($row['nama_pengirim']) . "</p>
                                        <p>Nama Penerima: " . htmlspecialchars($row['nama_penerima']) . "</p>
                                        <p>Jenis Layanan: " . htmlspecialchars($row['jenis_layanan']) . "</p>
                                        <p>Tanggal: " . htmlspecialchars($row['tanggal']) . "</p>
                                        <p>Status: " . htmlspecialchars($row['status']) . "</p>
                                        <p>Harga per KG: Rp. " . number_format($row['hargaperkg'], 2, ',', '.') . "</p>
                                        <p>Bobot (KG): " . htmlspecialchars($row['bobotkg']) . "</p>
                                        <p>Total Harga: Rp. " . number_format($row['total_harga'], 2, ',', '.') . "</p>
                                      </div>";
                            }
                        } else {
                            echo "<div class='search-result-item'>Tidak ada hasil ditemukan</div>";
                        }
                    } else {
                        echo "<div class='search-result-item'>Error: " . $mysqli->error . "</div>";
                    }
                }

                // Close the connection
                $mysqli->close();
                ?>
            </div>
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

