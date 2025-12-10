<?php
include '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
  // Escape input untuk keamanan
  $id = mysqli_real_escape_string($koneksi, $_POST['id']);
  $status = mysqli_real_escape_string($koneksi, $_POST['status']);

  // Validasi status
  if ($status != 'diterima' && $status != 'ditolak') {
    http_response_code(400);
    die("Status tidak valid.");
  }

  // Perbarui status laporan di database
  $query = "UPDATE tb_pengaduan_insiden SET status='$status' WHERE id_pengaduan='$id'";

  if (mysqli_query($koneksi, $query)) {
    http_response_code(200);
    echo "Status berhasil diperbarui.";
  } else {
    http_response_code(500);
    echo "Gagal memperbarui status: " . mysqli_error($koneksi);
  }
} else {
  http_response_code(400);
  echo "Permintaan tidak valid.";
}
