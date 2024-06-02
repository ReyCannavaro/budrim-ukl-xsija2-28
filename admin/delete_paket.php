<?php
include '../login/koneksi.php';

$resi = $_GET['resi']; // Ambil id_user user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM paket WHERE resi = '$resi'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: paket.php");
    exit();
} else {
    echo "Gagal menghapus paket.";
}
?>