<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket</title>
    <link rel="stylesheet" href="../regist/styleregist.css">
</head>
<body>
    <div class="container">
        <form action="" method="post" class="register-form">
            <h2>Tambah Paket</h2>

            <label for="id_pengirim">Nama Pengirim</label>
            <select id="id_pengirim" name="id_pengirim" required>
                <?php
                include_once("../login/koneksi.php");
                $result_pengirim = $mysqli->query("SELECT id_pengirim, nama FROM pengirim");
                while ($row = $result_pengirim->fetch_assoc()) {
                    echo "<option value='" . $row['id_pengirim'] . "'>" . $row['nama'] . "</option>";
                }
                ?>
            </select>

            <label for="id_penerima">Nama Penerima</label>
            <select id="id_penerima" name="id_penerima" required>
                <?php
                $result_penerima = $mysqli->query("SELECT id_penerima, nama FROM penerima");
                while ($row = $result_penerima->fetch_assoc()) {
                    echo "<option value='" . $row['id_penerima'] . "'>" . $row['nama'] . "</option>";
                }
                ?>
            </select>

            <label for="id_layanan">Layanan</label>
            <select id="id_layanan" name="id_layanan" required>
                <option value="1">Reguler</option>
                <option value="2">Express</option>
                <option value="3">Kargo</option>
                <option value="4">Nextday</option>
            </select>

            <label for="bobotkg">Bobot / KG</label>
            <input type="text" id="bobotkg" name="bobotkg" required>

            <button type="submit" name="submit">Tambah Paket</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $id_pengirim = $_POST['id_pengirim'];
        $id_penerima = $_POST['id_penerima'];
        $id_layanan = $_POST['id_layanan'];
        $status = "paket sedang diambil";
        $bobotkg = $_POST['bobotkg'];

        include_once("../login/koneksi.php");

        // Periksa koneksi
        if ($mysqli->connect_error) {
            die("Koneksi gagal: " . $mysqli->connect_error);
        }

        // Gunakan prepared statements untuk menghindari SQL Injection
        $stmt = $mysqli->prepare("INSERT INTO Paket (id_pengirim, id_penerima, id_layanan, tanggal, status, bobotkg) VALUES (?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("sssss", $id_pengirim, $id_penerima, $id_layanan, $status, $bobotkg);

        if ($stmt->execute()) {
            echo "Data berhasil ditambahkan.";
            header("Location: Paket.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement dan koneksi
        $stmt->close();
        $mysqli->close();
    }
    ?>
</body>
</html>
