<?php
require_once '../admin/connect.php';
require_once 'header.php';

// Query untuk mengambil data feedback dari tabel
$sql = "SELECT f.pesan, f.tanggal, f.resi, u.nama AS nama_pengirim, p.nama_penerima
        FROM feedback f
        LEFT JOIN user u ON f.id_user = u.id_user
        LEFT JOIN paket p ON f.resi = p.resi
        ORDER BY f.tanggal DESC";

$result = $con->query($sql);

if ($result === false) {
    echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
} else {
?>
    <div class="container">
        <h2>Feedback dari Pengguna</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-header'><strong>Tanggal:</strong> " . $row['tanggal'] . "</div>";
                echo "<div class='card-body'><p>" . nl2br($row['pesan']) . "</p></div>";
                echo "<div class='card-footer'>";
                echo "<strong>Nomor Resi:</strong> " . $row['resi'] . "<br>";
                echo "<strong>Nama Pengirim:</strong> " . $row['nama_pengirim'] . "<br>";
                echo "<strong>Nama Penerima:</strong> " . $row['nama_penerima'];
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-info'>No feedback found.</div>";
        }
        ?>
    </div>
<?php
}
require_once 'footer.php';
?>
