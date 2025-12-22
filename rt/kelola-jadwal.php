<?php
include "../connection/connection.php";
session_start();
if (isset($_POST['simpan_jadwal'])) {

  $tanggal = $_POST['tanggal'];
  $jam     = $_POST['jam'];

  // PASTIKAN id_pengguna ADA & ARRAY
  if (!isset($_POST['id_pengguna']) || !is_array($_POST['id_pengguna'])) {
    echo "<script>alert('Silakan generate warga terlebih dahulu');</script>";
    return;
  }

  $pengguna = $_POST['id_pengguna'];

  // INSERT tb_jadwal
  mysqli_query($koneksi, "
        INSERT INTO tb_jadwal (tanggal)
        VALUES ('$tanggal')
    ");

  $id_jadwal = mysqli_insert_id($koneksi);

  foreach ($pengguna as $id_pengguna) {

    // validasi role warga
    $cek = mysqli_query($koneksi, "
            SELECT id_pengguna FROM tb_pengguna
            WHERE id_pengguna='$id_pengguna' AND role='Warga'
        ");

    if (mysqli_num_rows($cek) == 0) continue;

    mysqli_query($koneksi, "
            INSERT INTO tb_jadwal_detail
            (id_jadwal, id_pengguna, jam_masuk)
            VALUES ('$id_jadwal', '$id_pengguna', '$jam')
        ");

    mysqli_query($koneksi, "
            UPDATE tb_pengguna
            SET counter_jadwal = counter_jadwal + 1
            WHERE id_pengguna = '$id_pengguna'
        ");
  }

  header("Location: kelola-jadwal.php");
  exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>KELOLA JADWAL</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1 class="mb-2">Jadwal Ronda</h1>
          <i class="text-muted">Kelola Jadwal Ronda</i>

          <!-- Tabel Jadwal -->
          <div class="card mt-4 mb-4 shadow">
            <div class="card-body">
              <button type="button" class="btn btn-outline-success btn-sm mt-3 mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                <i class="fas fa-circle-plus me-1"></i> Tambah Jadwal
              </button>

              <div class="table-responsive">
                <table class="table table-borderedless table-hover align-middle">
                  <!-- Mengambil Data Dari Database -->
                  <tbody class="text-center">
                    <?php
                    $no = 1;
                    $jadwalQuery = mysqli_query($koneksi, "
                      SELECT * 
                      FROM tb_jadwal
                      WHERE tanggal >= CURDATE()
                      ORDER BY tanggal ASC
                  ");
                    ?>
                    <div class="row">
                      <?php
                      while ($jadwal = mysqli_fetch_assoc($jadwalQuery)) {

                        // ambil detail warga per jadwal
                        $detailQuery = mysqli_query($koneksi, "
                        SELECT 
                            p.nama,
                            jd.jam_masuk
                        FROM tb_jadwal_detail jd
                        JOIN tb_pengguna p ON jd.id_pengguna = p.id_pengguna
                        WHERE jd.id_jadwal = {$jadwal['id_jadwal']}
                    ");
                        $label = (date('Y-m-d') == $jadwal['tanggal'])
                          ? '<span class="badge bg-success ms-2">Hari Ini</span>'
                          : '';
                      ?>
                        <!-- 1 KOTAK -->
                        <div class="col-md-6 mb-4">
                          <div class="card shadow-sm border-0 h-100">

                            <div class="card-header d-flex justify-content-between align-items-center">
                              <div>
                                <strong>Tanggal:</strong>
                                <?= date('d-m-Y', strtotime($jadwal['tanggal'])); ?>
                                <?= $label ?>

                                <!-- tombol hapus per jadwal -->
                                <a href="hapus_jadwal.php?id=<?= $jadwal['id_jadwal']; ?>"
                                  class="btn btn-sm btn-danger rounded-pill"
                                  onclick="return confirm('Yakin ingin menghapus jadwal ini beserta seluruh warga di dalamnya?')">
                                  <i class="fa-solid fa-trash"></i>
                                </a>

                              </div>

                              <div class="card-body">
                                <ul class="list-group list-group-flush">
                                  <?php while ($detail = mysqli_fetch_assoc($detailQuery)) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <span>
                                        <?= htmlspecialchars($detail['nama']); ?>
                                        <small class="text-muted">(<?= date('H:i', strtotime($detail['jam_masuk'])); ?>)</small>
                                      </span>
                                    </li>
                                  <?php } ?>
                                </ul>
                              </div>

                            </div>
                          </div>
                        <?php } ?>
                        </div>
                  </tbody>

                </table>
              </div>
            </div>

            <!-- Modal Tambah Jadwal -->
            <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-3 shadow">
                  <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="tambahJadwalModalLabel">Tambah Jadwal Ronda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form id="formTambahJadwal" method="POST">
                      <!-- Input nama warga (bisa sampai 5 orang) -->
                      <div class="mb-3">
                        <label class="form-label">Nama Warga (maksimal 5 orang)</label>

                        <div id="namaContainer"></div>

                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="btnGenerate">
                          <i class="fas fa-random me-1"></i> Generate 5 Warga Otomatis
                        </button>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input
                          type="date"
                          name="tanggal"
                          class="form-control"
                          value="<?= date('Y-m-d'); ?>"
                          min="<?= date('Y-m-d'); ?>"
                          required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Jam</label>
                        <input type="time" name="jam" class="form-control" required>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan_jadwal" class="btn btn-success">Simpan</button>
                      </div>
                  </div>
                </div>
              </div>
              <script>
                const btnGenerate = document.getElementById("btnGenerate");
                const namaContainer = document.getElementById("namaContainer");

                btnGenerate.addEventListener("click", () => {
                  fetch("ajax/generate_warga.php")
                    .then(res => res.json())
                    .then(data => {
                      namaContainer.innerHTML = "";

                      data.forEach(warga => {
                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "id_pengguna[]";
                        input.value = warga.id_pengguna;

                        const badge = document.createElement("div");
                        badge.className = "badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-2 w-100";
                        badge.innerText = warga.nama;

                        namaContainer.appendChild(badge);
                        namaContainer.appendChild(input);
                      });
                    });
                });
              </script>

              <!-- Modal Edit Jadwal (contoh, strukturnya sama) -->
              <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content rounded-3 shadow">
                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal Ronda</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formEditJadwal">
                        <!-- isian form edit sama seperti tambah -->
                        <div class="mb-3">
                          <label class="form-label">Nama Warga</label>
                          <input type="text" class="form-control" value="Ahmad Setiawan" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Hari</label>
                          <select class="form-select" required>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                            <option>Minggu</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Tanggal</label>
                          <input type="date" class="form-control" value="2025-11-04" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Jam</label>
                          <input type="text" class="form-control" value="22:00 - 00:00" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Pos Ronda</label>
                          <input type="text" class="form-control" value="Pos 1" required>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-warning text-dark">Simpan Perubahan</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
    </main>
  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>