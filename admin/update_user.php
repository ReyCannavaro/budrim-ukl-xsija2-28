<?php
include '../login/koneksi.php';

if(isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];

    // Lakukan proses update data di database
    $query = "UPDATE user SET 
                nama='$nama', 
                username='$username', 
                password='$password', 
                level='$level', 
                no_telp='$no_telp', 
                alamat='$alamat' 
              WHERE id_user=$id_user";
              
    $result = mysqli_query($mysqli, $query);

    if($result) {
        echo "Data berhasil diperbarui.";
        header("Location: users.php"); // Redirect kembali ke halaman data user
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($mysqli);
    }
}

// Mendapatkan data user yang akan diupdate
if(isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $query = "SELECT * FROM user WHERE id_user=$id_user";
    $result = mysqli_query($mysqli, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "ID user tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="style_update.css">
</head>
<body>
<div class="container">
    <header>
        <h1 class="title">Update User</h1>
    </header>
    <section class="form">
        <form method="POST" action="">
            <label for="id_user">ID:</label><br>
            <input type="text" name="id_user" value="<?php echo $data['id_user']; ?>" readonly><br>

            <label for="nama">Nama:</label><br>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>"><br>

            <label for="username">Username:</label><br>
            <input type="text" name="username" value="<?php echo $data['username']; ?>"><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" value="<?php echo $data['password']; ?>"><br>

            <label for="level">Level:</label><br>
            <input type="text" name="level" value="<?php echo $data['level']; ?>"><br>

            <label for="no_telp">No Telp:</label><br>
            <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>"><br>

            <label for="alamat">Alamat:</label><br>
            <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>"><br><br>

            <input type="submit" name="update" value="Update" class="button">
        </form>
    </section>
</div>
</body>
</html>
