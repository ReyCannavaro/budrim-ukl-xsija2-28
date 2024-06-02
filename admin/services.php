<?php

require_once '../admin/connect.php';
require_once 'header.php';

echo "<div class='container'>";

// Pencarian
$search_keyword = '';
if (!empty($_POST['search'])) {
    $search_keyword = $_POST['search'];
}

// Menghapus Layanan
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM layanan WHERE id_layanan=" . $_POST['id_layanan'];
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully deleted service</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting service: " . $con->error . "</div>";
    }
}

// Query untuk menampilkan layanan dengan fitur pencarian
$sql = "SELECT * FROM layanan WHERE jenis_layanan LIKE '%$search_keyword%' OR deskripsi LIKE '%$search_keyword%' OR hargaperkg LIKE '%$search_keyword%'";
$result = $con->query($sql);

if ($result === FALSE) {
    echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
} else {
    ?>

    <!-- Formulir Pencarian -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="search">Search Service:</label>
            <input type="text" name="search" class="form-control" value="<?php echo $search_keyword; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Formulir Tambah Layanan -->
    <h2>Add New Service</h2>
    <form action="add_service.php" method="POST">
        <div class="form-group">
            <label for="jenis_layanan">Service Type:</label>
            <input type="text" name="jenis_layanan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hargaperkg">Price per kg:</label>
            <input type="number" name="hargaperkg" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description:</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
    ?>
        <h2>List of all Services</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <td>Id</td>
                <td>Service Type</td>
                <td>Price per kg</td>
                <td>Description</td>
                <td width="70px">Delete</td>
                <td width="70px">Edit</td>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<form action='' method='POST'>";
                echo "<tr>";
                echo "<td>" . $row['id_layanan'] . "</td>";
                echo "<td>" . $row['jenis_layanan'] . "</td>";
                echo "<td>" . $row['hargaperkg'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td>";
                echo "<td><a href='update_service.php?id_layanan=" . $row['id_layanan'] . "' class='btn btn-primary'>Update</a></td>";
                echo "<input type='hidden' name='id_layanan' value='" . $row['id_layanan'] . "'>";
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
