<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah penerima</title>
    <link rel="stylesheet" href="../regist/styleregist.css">
</head>
<body>
    <div class="container">
        <form action="" method="post" class="register-form">
            <h2>Tambah penerima</h2>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="no_telp">No Telp</label>
            <input type="text" id="no_telp" name="no_telp" required>

            <label for="alamat_rinci">Alamat Rinci</label>
            <input type="text" id="alamat_rinci" name="alamat_rinci" required>

            <label for="desa_dusun">Desa Dusun</label>
            <input type="text" id="desa_dusun" name="desa_dusun" required>

            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" required>

            <label for="kota_kabupaten">Kota Kabupaten</label>
            <input type="text" id="kota_kabupaten" name="kota_kabupaten" required>

            <label for="provinsi">Provinsi</label>
            <input type="text" id="provinsi" name="provinsi" required>

            <button type="submit" name="submit">Tambah Penerima</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];
        $alamat_rinci = $_POST['alamat_rinci'];
        $desa_dusun = $_POST['desa_dusun'];
        $kecamatan = $_POST['kecamatan'];
        $kota_kabupaten = $_POST['kota_kabupaten'];
        $provinsi = $_POST['provinsi'];

        include_once("../login/koneksi.php");

        // Periksa koneksi
        if ($mysqli->connect_error) {
            die("Koneksi gagal: " . $mysqli->connect_error);
        }

        // Pastikan nama kolom sesuai dengan yang ada di database
        $query = "INSERT INTO budrim.penerima (nama, no_telp, alamat_rinci, desa_dusun, kecamatan, kota_kabupaten, provinsi)
                  VALUES ('$nama', '$no_telp', '$alamat_rinci', '$desa_dusun', '$kecamatan', '$kota_kabupaten', '$provinsi')";

        if (mysqli_query($mysqli, $query)) {
            echo "Data berhasil ditambahkan.";
            header("Location: ../user/order.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }

        // Tutup koneksi
        $mysqli->close();
    }
    ?>
</body>
</html>
