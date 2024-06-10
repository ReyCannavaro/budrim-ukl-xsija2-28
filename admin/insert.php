<?php

require_once '../admin/connect.php';
require_once 'header.php';

echo "<div class='container'>";

// Menambah User
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO user (username, nama, password, level, no_telp, alamat) VALUES ('$username', '$nama', '$password', '$level', '$no_telp', '$alamat')";
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully added new user</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding user: " . $con->error . "</div>";
    }
}

?>

<!-- Formulir Tambah Pengguna -->
<h2>Add New User</h2>
<form action="" method="POST">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="level">Level:</label>
        <input type="text" name="level" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="no_telp">No Telp:</label>
        <input type="text" name="no_telp" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>
    <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
</form>

<?php
echo "</div>";

require_once 'footer.php';
?>
