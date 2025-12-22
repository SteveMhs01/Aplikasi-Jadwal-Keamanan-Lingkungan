<?php
include "../../connection/connection.php";

$query = mysqli_query($koneksi, "
    SELECT id_pengguna, nama 
    FROM tb_pengguna
    WHERE role = 'Warga'
    ORDER BY counter_jadwal ASC, RAND()
    LIMIT 5
");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
