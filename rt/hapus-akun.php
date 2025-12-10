<?php
include '../connection/connection.php';

// Delete Akun 
$id = $_GET['id_pengguna'];

if ($id) {
  // Hapus semua laporan insiden yang dibuat oleh pengguna 
  $query_delete_laporan = "DELETE FROM tb_pengaduan_insiden WHERE id_pengguna = '$id'";
  $delete_laporan = mysqli_query($koneksi, $query_delete_laporan);

  if ($delete_laporan) {
    // 2. Hapus akun pengguna 
    $query_delete_akun = "DELETE FROM tb_pengguna WHERE id_pengguna = '$id'";
    $delete_akun = mysqli_query($koneksi, $query_delete_akun);

    if ($delete_akun) {
      $_SESSION['sukses_delete'] = true;
      // Berhasil menghapus kedua data
      header('location: kelola-akun.php?pesan=hapus_sukses');
    } else {
      // Gagal hapus akun utama
      die("Gagal menghapus akun: " . mysqli_error($koneksi));
    }
  } else {
    // Gagal hapus laporan
    die("Gagal menghapus laporan terkait: " . mysqli_error($koneksi));
  }
}
