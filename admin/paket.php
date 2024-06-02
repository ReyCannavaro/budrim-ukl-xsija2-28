<?php

require_once '../admin/connect.php';
require_once 'header.php';

echo "<div class='container'>";

// Pencarian
$search_keyword = '';
if (!empty($_POST['search'])) {
    $search_keyword = $_POST['search'];
}

// Menghapus Paket
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM paket WHERE resi=" . $_POST['resi'];
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully deleted package</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting package: " . $con->error . "</div>";
    }
}

// Mengupdate Status Paket
if (isset($_POST['update_status'])) {
    $sql = "UPDATE paket SET status='" . $_POST['status'] . "' WHERE resi=" . $_POST['resi'];
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully updated package status</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating package status: " . $con->error . "</div>";
    }
}

// Query untuk menampilkan paket dengan fitur pencarian
$sql = "
    SELECT p.resi, u.nama AS nama_pengirim, l.jenis_layanan AS layanan, l.hargaperkg, p.tanggal, p.status, p.bobotkg, p.nama_penerima, p.alamat 
    FROM paket p
    LEFT JOIN user u ON p.id_user = u.id_user
    LEFT JOIN layanan l ON p.id_layanan = l.id_layanan
    WHERE p.resi LIKE '%$search_keyword%' 
    OR p.nama_penerima LIKE '%$search_keyword%' 
    OR p.alamat LIKE '%$search_keyword%' 
    OR u.nama LIKE '%$search_keyword%' 
    OR l.jenis_layanan LIKE '%$search_keyword%'
";

$result = $con->query($sql);

if ($result === FALSE) {
    echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
} else {
    ?>

    <!-- Formulir Pencarian -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="search">Search Package:</label>
            <input type="text" name="search" class="form-control" value="<?php echo $search_keyword; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
    ?>
        <h2>List of all Packages</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <td>Resi</td>
                <td>Nama Pengirim</td>
                <td>Layanan</td>
                <td>Tanggal</td>
                <td>Status</td>
                <td>Bobot (kg)</td>
                <td>Harga Layanan</td>
                <td>Total Harga</td>
                <td>Nama Penerima</td>
                <td>Alamat</td>
                <td width="150px">Update Status</td>
                <td width="70px">Delete</td>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $total_harga = $row['bobotkg'] * $row['hargaperkg'];
                echo "<form action='' method='POST'>";
                echo "<tr>";
                echo "<td>" . $row['resi'] . "</td>";
                echo "<td>" . $row['nama_pengirim'] . "</td>";
                echo "<td>" . $row['layanan'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['bobotkg'] . "</td>";
                echo "<td>" . $row['hargaperkg'] . "</td>";
                echo "<td>" . $total_harga . "</td>";
                echo "<td>" . $row['nama_penerima'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>
                    <select name='status' class='form-control'>
                        <option value='paket sedang dijemput'>Paket sedang dijemput</option>
                        <option value='paket sedang diantar'>Paket sedang diantar</option>
                        <option value='paket telah diterima'>Paket telah diterima</option>
                    </select>
                    <button type='submit' name='update_status' class='btn btn-primary'>Update</button>
                </td>";
                echo "<td><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td>";
                echo "<input type='hidden' name='resi' value='" . $row['resi'] . "'>";
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
