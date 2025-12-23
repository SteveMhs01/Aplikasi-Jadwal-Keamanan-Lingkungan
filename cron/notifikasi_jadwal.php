<?php
date_default_timezone_set('Asia/Jakarta');

// ================================
// KONFIGURASI
// ================================

// 🔧 SET TRUE kalau mau anti kirim dobel
$ANTI_DOBEL = true;

// ================================
// LOAD SYSTEM
// ================================

// Path absolut aman untuk CLI / cron
require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// ================================
// AMBIL JADWAL H-1
// ================================
$besok = date('Y-m-d', strtotime('+1 day'));

// Query utama
$sql = "
  SELECT 
    jd.id_jadwal_detail,
    p.nama,
    p.email,
    j.tanggal,
    jd.jam_masuk
  FROM tb_jadwal j
  JOIN tb_jadwal_detail jd ON j.id_jadwal = jd.id_jadwal
  JOIN tb_pengguna p ON jd.id_pengguna = p.id_pengguna
  WHERE j.tanggal = '$besok'
  AND p.role = 'Warga'
  AND p.email IS NOT NULL
";

if ($ANTI_DOBEL) {
  $sql .= " AND jd.notif_sent = 0";
}

$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) == 0) {
  echo "Tidak ada notifikasi yang perlu dikirim\n";
  exit;
}

while ($row = mysqli_fetch_assoc($query)) {

  $mail = new PHPMailer(true);

  try {
    // ===== SMTP GMAIL =====
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pbltrpl105@gmail.com';     // EMAIL PENGIRIM
    $mail->Password   = 'skic bebe lvuu qoxv';      // APP PASSWORD
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // ===== EMAIL =====
    $mail->setFrom('pbltrpl105@gmail.com', 'Jadwal Ronda');
    $mail->addAddress($row['email'], $row['nama']);

    $mail->isHTML(true);
    $mail->Subject = 'Pengingat Jadwal Ronda (Besok)';

    $mail->Body = "
      <h3>Halo {$row['nama']}</h3>
      <p>Ini adalah pengingat jadwal ronda Anda:</p>

      <table cellpadding='5'>
        <tr>
          <td><b>Tanggal</b></td>
          <td>: " . date('d F Y', strtotime($row['tanggal'])) . "</td>
        </tr>
        <tr>
          <td><b>Jam Masuk</b></td>
          <td>: " . date('H:i', strtotime($row['jam_masuk'])) . "</td>
        </tr>
      </table>

      <p>Mohon hadir tepat waktu 🙏</p>
      <br>
      <small>Pesan ini dikirim otomatis oleh sistem ronda</small>
    ";

    $mail->send();

    // ================================
    // UPDATE NOTIF SENT (OPSIONAL)
    // ================================
    if ($ANTI_DOBEL) {
      mysqli_query($koneksi, "
        UPDATE tb_jadwal_detail 
        SET notif_sent = 1 
        WHERE id_jadwal_detail = '{$row['id_jadwal_detail']}'
      ");
    }

    echo "Email terkirim ke {$row['email']}\n";
  } catch (Exception $e) {
    file_put_contents(
      __DIR__ . '/email_error.log',
      date('Y-m-d H:i:s') . " | {$row['email']} | {$mail->ErrorInfo}\n",
      FILE_APPEND
    );

    // Opsional tetap tampilkan di CLI
    echo "Gagal kirim ke {$row['email']} : {$mail->ErrorInfo}\n";
  }
}

echo "Proses notifikasi selesai\n";
exit;
