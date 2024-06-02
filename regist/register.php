<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styleregist.css">
</head>
<body>
    <div class="container">
        <form action="register.php" method="post" class="register-form">
            <h2>Register</h2>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="no_telp">No. Telepon</label>
            <input type="text" id="no_telp" name="no_telp" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" required>

            <button type="submit" name="Submit">Register</button>
        </form>
    </div>

    <?php
    if (isset($_POST['Submit'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];
        $level = 'user';

        include_once("../login/koneksi.php");

        $result = mysqli_query($mysqli, "INSERT INTO user (nama, username, password, level, no_telp, alamat) 
                                         VALUES ('$nama', '$username', '$password', '$level', '$no_telp', '$alamat')");

        if ($result) {
            header("Location: ../login/index.php");
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }
    ?>
</body>
</html>
