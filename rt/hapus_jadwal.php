<?php
include "../connection/connection.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: kelola-jadwal.php");
    exit;
}

$id_jadwal = (int) $_GET['id'];

// CUKUP INI SAJA
$query = mysqli_query(
    $koneksi,
    "DELETE FROM tb_jadwal WHERE id_jadwal = $id_jadwal"
);

if ($query) {
    echo "<script>
        alert('Jadwal & detail berhasil dihapus');
        window.location='kelola-jadwal.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus jadwal!');
        window.history.back();
    </script>";
}
