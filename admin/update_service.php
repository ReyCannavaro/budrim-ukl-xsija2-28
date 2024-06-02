<?php
require_once '../admin/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_layanan'])) {
    $id_layanan = $_GET['id_layanan'];
    $sql = "SELECT * FROM layanan WHERE id_layanan=$id_layanan";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_layanan = $_POST['id_layanan'];
    $jenis_layanan = $con->real_escape_string($_POST['jenis_layanan']);
    $hargaperkg = $con->real_escape_string($_POST['hargaperkg']);
    $deskripsi = $con->real_escape_string($_POST['deskripsi']);
    
    $sql = "UPDATE layanan SET jenis_layanan='$jenis_layanan', hargaperkg='$hargaperkg', deskripsi='$deskripsi' WHERE id_layanan=$id_layanan";
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully updated service</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating service: " . $con->error . "</div>";
    }
    header("Location: services.php"); // Redirect back to the main services page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Update Service</h2>
        <form action="" method="POST">
            <input type="hidden" name="id_layanan" value="<?php echo $row['id_layanan']; ?>">
            <div class="form-group">
                <label for="jenis_layanan">Service Type:</label>
                <input type="text" name="jenis_layanan" class="form-control" value="<?php echo $row['jenis_layanan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="hargaperkg">Price per kg:</label>
                <input type="number" name="hargaperkg" class="form-control" value="<?php echo $row['hargaperkg']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Description:</label>
                <textarea name="deskripsi" class="form-control" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Service</button>
        </form>
    </div>
</body>
</html>
