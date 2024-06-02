<?php
include 'connect.php'; // Pastikan path ini benar dan file koneksi di-include dengan benar

if (isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    $query = "SELECT * FROM paket WHERE resi='$resi'";
    $result = $con->query($query);
    $data = $result->fetch_assoc();
} else {
    echo "Resi tidak ditemukan.";
    exit();
}

if (isset($_POST['update_status'])) {
    $status = $_POST['status'];

    // Lakukan proses update status di database
    $query = "UPDATE paket SET status='$status' WHERE resi='$resi'";
    $result = $con->query($query);

    if ($result) {
        echo "Status berhasil diperbarui.";
        header("Location: paket.php"); // Redirect kembali ke halaman data paket
        exit();
    } else {
        echo "Terjadi kesalahan: " . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Paket</title>
    <link rel="stylesheet" href="style_update.css">
</head>
<body>
<div class="container">
    <header>
        <h1 class="title">Update Status Paket</h1>
    </header>
    <section class="form">
        <form method="POST" action="">
            <label for="resi">Resi</label><br>
            <input type="text" name="resi" value="<?php echo $data['resi']; ?>" readonly><br>

            <label for="status">Status</label><br>
            <select id="status" name="status" required>
                <option value="paket sedang diambil" <?php echo ($data['status'] == 'paket sedang diambil') ? 'selected' : ''; ?>>Paket sedang diambil</option>
                <option value="paket telah diantar" <?php echo ($data['status'] == 'paket telah diantar') ? 'selected' : ''; ?>>Paket telah diantar</option>
                <option value="paket sedang dalam perjalanan" <?php echo ($data['status'] == 'paket sedang dalam perjalanan') ? 'selected' : ''; ?>>Paket sedang dalam perjalanan</option>
                <option value="paket telah diterima" <?php echo ($data['status'] == 'paket telah diterima') ? 'selected' : ''; ?>>Paket telah diterima</option>
            </select><br>

            <input type="submit" name="update_status" value="Update Status" class="button">
        </form>
    </section>
</div>
</body>
</html>
