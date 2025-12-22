<?php
include '../connection/connection.php';

$tgl_dari   = $_GET['tgl_dari'] ?? '';
$tgl_sampai = $_GET['tgl_sampai'] ?? '';

$where = "";
if (!empty($tgl_dari) && !empty($tgl_sampai)) {
  $where = "WHERE a.tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'";
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_kehadiran.xls");

$query = "
  SELECT 
      p.nama,
      ad.status_absensi,
      ad.jam_masuk,
      a.keterangan,
      a.tanggal
  FROM tb_absensi_detail ad
  JOIN tb_absensi a ON ad.id_absensi = a.id_absensi
  JOIN tb_pengguna p ON ad.id_pengguna = p.id_pengguna
  $where
  ORDER BY a.tanggal DESC
";

$result = mysqli_query($koneksi, $query);
?>

<table border="1">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Status</th>
    <th>Jam Masuk</th>
    <th>Keterangan</th>
    <th>Tanggal</th>
  </tr>

  <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['status_absensi']; ?></td>
    <td><?= $row['jam_masuk'] ? date('H:i', strtotime($row['jam_masuk'])) : '-'; ?></td>
    <td><?= $row['keterangan']; ?></td>
    <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
  </tr>
  <?php } ?>
</table>
