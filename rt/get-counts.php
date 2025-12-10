<?php
include '../connection/connection.php';

// Query untuk mengambil data hitungan terbaru
$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden"))['jml'];
$menunggu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='diproses'"))['jml'];
$valid = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='diterima'"))['jml'];
$ditolak = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='ditolak'"))['jml'];

// Mengembalikan data sebagai JSON
header('Content-Type: application/json');
echo json_encode([
  'total' => (int)$total,
  'menunggu' => (int)$menunggu,
  'valid' => (int)$valid,
  'ditolak' => (int)$ditolak
]);
