<?php
include '../login/koneksi.php';

$id_user = $_GET['id_user']; // Ambil id_user user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM user WHERE id_user = '$id_user'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: users.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>