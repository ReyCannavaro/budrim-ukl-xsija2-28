<?php

require_once '../admin/connect.php';
require_once 'header.php';

echo "<div class='container'>";

// Pencarian
$search_keyword = '';
if (!empty($_POST['search'])) {
    $search_keyword = $_POST['search'];
}

// Menghapus User
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM user WHERE id_user=" . $_POST['id_user'];
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully deleted user</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting user: " . $con->error . "</div>";
    }
}

// Query untuk menampilkan pengguna dengan fitur pencarian
$sql = "SELECT * FROM user WHERE username LIKE '%$search_keyword%' OR nama LIKE '%$search_keyword%' OR level LIKE '%$search_keyword%' OR no_telp LIKE '%$search_keyword%' OR alamat LIKE '%$search_keyword%'";
$result = $con->query($sql);

if ($result === FALSE) {
    echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
} else {
    ?>

    <!-- Formulir Pencarian -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="search">Search User:</label>
            <input type="text" name="search" class="form-control" value="<?php echo $search_keyword; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
    ?>
        <h2>List of all Users</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <td>Id</td>
                <td>Username</td>
                <td>Nama</td>
                <td>Password</td>
                <td>Level</td>
                <td>No Telp</td>
                <td>Alamat</td>
                <td width="70px">Delete</td>
                <td width="70px">Edit</td>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<form action='' method='POST'>";
                echo "<tr>";
                echo "<td>" . $row['id_user'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['level'] . "</td>";
                echo "<td>" . $row['no_telp'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td>";
                echo "<td><a href='update_user.php?id_user=" . $row['id_user'] . "' class='btn btn-primary'>Update</a></td>";
                echo "<input type='hidden' name='id_user' value='" . $row['id_user'] . "'>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
    <?php
    } else {
        echo "<br><br>No Record Found";
    }
}

echo "</div>";

require_once 'footer.php';
?>
