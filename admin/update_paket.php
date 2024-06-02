<?php
include '../admin/connect.php';

if(isset($_POST['update'])) {
    $resi = $_POST['resi'];
    $id_pengirim = $_POST['id_pengirim'];
    $id_penerima = $_POST['id_penerima'];
    $id_layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Lakukan proses update data di database
    $query = "UPDATE penerima SET id_pengirim='$id_pengirim', id_penerima='$id_penerima', id_layanan='$id_layanan', tanggal='$tanggal', status='$status' WHERE resi=$resi";
    $result = mysqli_query($mysqli, $query);

    if($result) {
        echo "Data berhasil diperbarui.";
        header("Location: paket.php"); // Redirect kembali ke halaman data user
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($mysqli);
    }
}

// Mendapatkan data user yang akan diupdate
if(isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    $query = "SELECT * FROM penerima WHERE resi=$resi";
    $result = mysqli_query($mysqli, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "resi user resi ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wresith=device-wresith, initial-scale=1.0">
    <title>Update penerima</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="style_update.css">
</head>
<body>
<div class="container">
        <header>
            <h1 class="title">Update pengirmin</h1>
        </header>
        <section class="form">
        <form method="POST" action="">
        <label for="id">ID</label><br>
        <input type="text" name="resi" value="<?php echo $data['resi']; ?>"><br>

        <label for="id_pengirim">id_pengirim</label><br>
        <input type="text" id="id_pengirim" name="id_pengirim" value="<?php echo $data['id_pengirim']; ?>"><br>

        <label for="id_penerima">no telepon:</label><br>
        <input type="text" id="id_penerima" name="id_penerima" value="<?php echo $data['id_penerima']; ?>"><br>

        <label for="id_layanan">id_layanan:</label><br>
        <input type="text" id="id_layanan" name="id_layanan" value="<?php echo $data['id_layanan']; ?>"><br>

        <label for="tanggal">tanggal:</label><br>
        <input type="text" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>"><br><br>

        <label for="status">status:</label><br>
        <input type="text" id="status" name="status" value="<?php echo $data['status']; ?>"><br><br>

        <input type="submit" name="update" value="Update" class="button">
    </form>
        </section>
    </div>
    
</body>
</html>