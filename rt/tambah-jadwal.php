<?php
// Data warga (tanpa database)
$warga = [
  ["warga_id" => 1, "nama" => "Andi", "counter" => 0],
  ["warga_id" => 2, "nama" => "Budi", "counter" => 0],
  ["warga_id" => 3, "nama" => "Citra", "counter" => 0],
  ["warga_id" => 4, "nama" => "Dewi", "counter" => 0],
  ["warga_id" => 5, "nama" => "Eko", "counter" => 0],
  ["warga_id" => 6, "nama" => "Fajar", "counter" => 0],
  ["warga_id" => 7, "nama" => "Gina", "counter" => 0],
  ["warga_id" => 8, "nama" => "Hadi", "counter" => 0],
  ["warga_id" => 9, "nama" => "Indra", "counter" => 0],
  ["warga_id" => 10, "nama" => "Joko", "counter" => 0],
];

// Proses random warga
$hasil_random = [];
if (isset($_POST['randomize'])) {
  // Ambil semua ID warga
  $id_warga = array_column($warga, 'warga_id');

  // Acak urutan ID warga
  shuffle($id_warga);

  // Ambil 5 warga pertama dari hasil acak
  $id_terpilih = array_slice($id_warga, 0, 5);

  // Masukkan warga yang sesuai ID ke hasil random
  foreach ($warga as $orang) {
    if (in_array($orang['warga_id'], $id_terpilih)) {
      $hasil_random[] = $orang;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Random 5 Warga</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <h1 class="text-center mt-5">Forum Jadwal Warga</h1>
  <div class="card p-4 m-5 shadow-lg rounded w-50 mx-auto">
    <form method="POST">
      <button type="submit" name="randomize" class="btn btn-primary mb-3">Random</button>
    </form>

    <?php if (!empty($hasil_random)): ?>
      
      <table class="table table-bordered">
        <tr>
          <th>ID Warga</th>
          <th>Nama</th>
        </tr>
        <?php foreach ($hasil_random as $r): ?>
          <tr>
            <td><?= $r['warga_id'] ?></td>
            <td><?= htmlspecialchars($r['nama']) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
    
    <footer>
      <hr>
    </footer>
    <button onclick="window.location.href='kelola-jadwal.php'" class="btn btn-danger "><i class="fa-solid fa-sign-out me-2"></i>Kembali</button>
    <br>
    <button onclick="window.location.href='kelola-jadwal.php'" class="btn btn-success "><i class="fa-solid fa-save me-2"></i>Simpan</button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../../js/scripts.js"></script>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>