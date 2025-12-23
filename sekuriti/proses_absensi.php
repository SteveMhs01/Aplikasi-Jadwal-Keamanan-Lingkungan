<?php
include "../connection/connection.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['simpan_absensi'])) {

    $id_jadwal         = $_POST['id_jadwal'];
    $id_pengguna       = $_POST['id_pengguna'];
    $status_absensi    = $_POST['status_absensi'];
    $jam_masuk         = $_POST['jam_masuk'];
    $keterangan        = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $tanggal           = date('Y-m-d');

    mysqli_begin_transaction($koneksi);

    try {

        // 1️⃣ INSERT HEADER ABSENSI
        mysqli_query($koneksi, "
            INSERT INTO tb_absensi (id_jadwal, tanggal, keterangan)
            VALUES ('$id_jadwal', '$tanggal', '$keterangan')
        ");

        $id_absensi = mysqli_insert_id($koneksi);

        // 2️⃣ INSERT DETAIL ABSENSI
        for ($i = 0; $i < count($id_pengguna); $i++) {

            mysqli_query($koneksi, "
                INSERT INTO tb_absensi_detail
                (id_absensi, id_pengguna, status_absensi, jam_masuk)
                VALUES (
                    '$id_absensi',
                    '{$id_pengguna[$i]}',
                    '{$status_absensi[$i]}',
                    '{$jam_masuk[$i]}'
                )
            ");
        }

        // 3️⃣ Tandai absensi selesai
        mysqli_query($koneksi, "
            UPDATE tb_jadwal
            SET absensi_selesai = 1
            WHERE id_jadwal = '$id_jadwal'
        ");

        mysqli_commit($koneksi);

        session_start();

        $_SESSION['success_absensi'] = true;

        header("Location: absensi.php");
        exit;
    } catch (Throwable $e) {
        mysqli_rollback($koneksi);
        die("Gagal menyimpan absensi: " . $e->getMessage());
    }
}
