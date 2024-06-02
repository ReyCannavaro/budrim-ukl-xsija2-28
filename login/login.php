<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $login = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        // Simpan id_user ke dalam sesi
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];

        // Redirect berdasarkan level pengguna
        if ($data['level'] == "admin") {
            header("Location: ../admin/index.php");
        } else if ($data['level'] == "user") {
            header("Location: ../user/index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php?pesan=gagal");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
        <p style="color:red;">Login gagal! Username atau password salah.</p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="user">Username:</label>
        <input type="text" id="user" name="user" required>
        <br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
