<?php
session_start();

if (!isset($_SESSION['nik'])) {
  header("Location: ../login.php");
  exit;
}

// BATAS AKSES BERDASARKAN ROLE
function cekRole($roleWajib)
{
  if ($_SESSION['role'] !== $roleWajib) {
    header("Location: ../tidak-diizinkan.php");
    exit;
  }
}
