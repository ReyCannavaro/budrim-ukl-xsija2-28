<?php
require_once '../admin/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_layanan = $con->real_escape_string($_POST['jenis_layanan']);
    $hargaperkg = $con->real_escape_string($_POST['hargaperkg']);
    $deskripsi = $con->real_escape_string($_POST['deskripsi']);
    
    $sql = "INSERT INTO layanan (jenis_layanan, hargaperkg, deskripsi) VALUES ('$jenis_layanan', '$hargaperkg', '$deskripsi')";
    if ($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Successfully added new service</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding service: " . $con->error . "</div>";
    }
    header("Location: services.php"); // Redirect back to the main services page
    exit();
}
?>
