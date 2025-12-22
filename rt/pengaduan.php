<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>FORM PENGADUAN</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f9fafb;
    }

    .card {
      border: none;
      border-radius: 14px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .status-badge {
      font-size: 0.8rem;
      padding: 5px 10px;
      border-radius: 10px;
      font-weight: 500;
    }

    .badge-waiting {
      background-color: #fef9c3;
      color: #92400e;
    }

    .badge-success {
      background-color: #dcfce7;
      color: #15803d;
    }

    .badge-danger {
      background-color: #fee2e2;
      color: #b91c1c;
    }

    .btn-detail {
      background-color: #3b82f6;
      color: white;
      border: none;
      padding: 6px 14px;
      border-radius: 8px;
    }

    .btn-validasi {
      background-color: #10b981;
      color: white;
      border: none;
      padding: 6px 14px;
      border-radius: 8px;
    }

    .btn-tolak {
      background-color: #ef4444;
      color: white;
      border: none;
      padding: 6px 14px;
      border-radius: 8px;
    }

    .btn-detail:hover,
    .btn-validasi:hover,
    .btn-tolak:hover {
      opacity: 0.9;
    }

    .card-header i {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }

    .card-laporan {
      border-left: 5px solid #3b82f6;
    }

    .text-muted small {
      color: #6b7280 !important;
    }

    .filter-section .form-select,
    .filter-section .form-control {
      border-radius: 8px;
    }
  </style>
</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">
  <?php
  include '../connection/connection.php';
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';

  // Total laporan
  $total      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden"))['jml'];
  $menunggu   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='diproses'"))['jml'];
  $valid      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='diterima'"))['jml'];
  $ditolak    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden WHERE status='ditolak'"))['jml'];

  $persenValid = $total > 0 ? round(($valid / $total) * 100) : 0;

  // Query daftar laporan
  $query = mysqli_query($koneksi, "SELECT * FROM tb_pengaduan_insiden ORDER BY id_pengaduan DESC");


  ?>

  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">

          <!-- Judul -->
          <h1 class=" mb-4">Pengaduan Insiden</h1>

          <div class="row g-3 mb-4">
            <!-- Card 1 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-clock fa-2x text-warning"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold" id="card-menunggu"><?= $menunggu ?></h4>
                    <p class="mb-0 text-muted small">Menunggu Tervalidasi</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold" id="card-valid"><?= $valid ?></h4>
                    <p class="mb-0 text-muted small">Tervalidasi</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-xmark fa-2x text-danger"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold" id="card-ditolak"><?= $ditolak ?></h4>
                    <p class="mb-0 text-muted small">Ditolak</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-file-lines fa-2x text-primary"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold" id="card-total"><?= $total ?></h4>
                    <p class="mb-0 text-muted small">Total Laporan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Filter -->
          <div class="card mb-4 p-3 shadow">
            <div class="d-flex flex-wrap align-items-center gap-2 filter-section">
              <h6 class="fw-semibold mb-0 me-3">Laporan</h6>
              <!-- Filter Bulan -->
              <select id="filterBulan" class="form-select w-auto">
                <option value="">Semua Bulan</option>
                <option value="-01-">Januari</option>
                <option value="-02-">Februari</option>
                <option value="-03-">Maret</option>
                <option value="-04-">April</option>
                <option value="-05-">Mei</option>
                <option value="-06-">Juni</option>
                <option value="-07-">Juli</option>
                <option value="-08-">Agustus</option>
                <option value="-09-">September</option>
                <option value="-10-">Oktober</option>
                <option value="-11-">November</option>
                <option value="-12-">Desember</option>
              </select>

              <input type="text" id="searchInput" class="form-control w-auto" placeholder="Cari laporan...">
            </div>
          </div>

          <!-- Daftar Laporan -->
          <?php
          $query = mysqli_query($koneksi, "SELECT * FROM tb_pengaduan_insiden ORDER BY id_pengaduan DESC");

          while ($row = mysqli_fetch_assoc($query)) {
            $badge = ($row['status'] == 'diproses') ? 'badge-waiting' : (($row['status'] == 'diterima') ? 'badge-success' : 'badge-danger');

            $statusText = ucfirst($row['status']);
          ?>
            <div class="card mb-3 p-3 card-laporan shadow laporan-item" id="laporan-<?= $row['id_pengaduan'] ?>">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <div class="text-muted small mb-2">
                    <i class="fa-regular fa-user"></i> <?= $row['nama'] ?> ·
                    <i class="fa-regular fa-calendar"></i> <?= date("d M Y,", strtotime($row['tanggal'])) ?>
                  </div>
                  <p class="mb-2 text-secondary"><?= substr($row['deskripsi'], 0, 120) ?>...</p>
                </div>
                <span id="badge<?= $row['id_pengaduan'] ?>"
                  class="badge status-badge <?= $badge ?>">
                  <?= ucfirst($row['status']) ?>
                </span>
              </div>

              <div class="mt-3 d-flex gap-2">
                <?php if ($row['status'] == 'diproses') : ?>
                  <button onclick="validasiLaporan(<?= $row['id_pengaduan'] ?>)" class="btn-validasi btn-sm">
                    <i class="fa-solid fa-check me-1"></i> Terima
                  </button>
                  <button onclick="tolakLaporan(<?= $row['id_pengaduan'] ?>)" class="btn-tolak btn-sm">
                    <i class="fa-solid fa-xmark me-1"></i> Tolak
                  </button>
                <?php endif; ?>
                <button class="btn-detail btn-sm modalDetail"
                  data-id="<?= $row['id_pengaduan']; ?>"
                  data-nama="<?= $row['nama']; ?>"
                  data-deskripsi="<?= $row['deskripsi']; ?>"
                  data-tanggal="<?= $row['tanggal']; ?>"
                  data-status="<?= $row['status']; ?>"
                  data-lokasi="<?= $row['lokasi']; ?>">
                  <i class="fa-solid fa-eye me-1"></i> Detail
                </button>
              </div>
            </div>

          <?php } ?>

          <!-- MODAL DETAIL PENGADUAN -->
          <div class="modal fade" id="modalDetailPengaduan" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content rounded-3 shadow">

                <form method="POST" action="">
                  <input type="hidden" name="id" id="id">

                  <div class="modal-header bg-primary text-white">
                    <h5>Detail Pengaduan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <div class="row">

                      <!-- KOLOM KIRI -->
                      <div class="col-md-6">
                        <input type="hidden" name="id_pengguna" id="edit-id">

                        <div class="mb-3">
                          <label class="form-label">Nama</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Tanggal</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Nomor handphone" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Status</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="text" class="form-control" id="status" name="status" placeholder="Nomor handphone" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Lokasi Kejadian</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" required>
                          </div>
                        </div>

                      </div>

                      <!-- KOLOM KANAN -->
                      <div class="col-md-6 col-divider">

                        <div class="mb-3">
                          <label class="form-label">Deskripsi</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" style="height: 300px;"></textarea>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>

                </form>

              </div>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
  <script>
    function refreshCards() {
      fetch("get-counts.php")
        .then(response => {
          if (!response.ok) {
            throw new Error('Gagal mengambil data hitungan');
          }
          return response.json();
        })
        .then(data => {
          // Update elemen HTML (Card) dengan data baru
          document.getElementById("card-menunggu").textContent = data.menunggu;
          document.getElementById("card-valid").textContent = data.valid;
          document.getElementById("card-ditolak").textContent = data.ditolak;
          document.getElementById("card-total").textContent = data.total;
        })
        .catch(error => {
          console.error('Gagal memperbarui card summary:', error);
        });
    }

    // Search Filter
    document.getElementById("searchInput").addEventListener("keyup", function() {
      let keyword = this.value.toLowerCase();
      let laporan = document.querySelectorAll(".laporan-item");

      laporan.forEach(l => {
        let text = l.innerText.toLowerCase();
        l.style.display = text.includes(keyword) ? "" : "none";
      });
    });

    function validasiLaporan(id) {
      Swal.fire({
        title: "Terima laporan ini?",
        text: "Laporan akan ditandai sebagai 'diterima'.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Terima"
      }).then((result) => {
        if (result.isConfirmed) {
          updateStatus(id, "diterima");
        }
      });
    }

    function tolakLaporan(id) {
      Swal.fire({
        title: "Tolak laporan ini?",
        text: "Laporan akan ditandai sebagai 'ditolak'.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Tolak"
      }).then((result) => {
        if (result.isConfirmed) {
          updateStatus(id, "ditolak");
        }
      });
    }

    // 🔥 FUNGSI UPDATE STATUS TANPA RELOAD HALAMAN
    function updateStatus(id, status) {
      let form = new FormData();
      form.append("id", id);
      form.append("status", status);

      fetch("update-status.php", {
          method: "POST",
          body: form
        })
        .then(res => res.text())
        .then(() => {
          updateBadge(id, status);
          updateCardStatus(id, status);
          refreshCards();

          Swal.fire("Berhasil!", "Status laporan diperbarui.", "success");
        })
        .catch(error => {
          Swal.fire("Gagal!", "Terjadi kesalahan saat memperbarui status.", "error");
          console.error('Error:', error);
        });
    }

    // 🔥 UPDATE BADGE STATUS
    function updateBadge(id, status) {
      const badge = document.getElementById("badge" + id);

      badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

      badge.classList.remove("badge-waiting", "badge-success", "badge-danger");

      if (status === "diterima") {
        badge.classList.add("badge-success");
      } else if (status === "ditolak") {
        badge.classList.add("badge-danger");
      } else {
        badge.classList.add("badge-waiting");
      }
    }

    // 🔥 UPDATE TOMBOL CARD SETELAH VALIDASI / TOLAK
    function updateCardStatus(id, status) {
      const card = document.getElementById("laporan-" + id);
      if (!card) return;

      const btnValid = card.querySelector("button.btn-validasi");
      const btnTolak = card.querySelector("button.btn-tolak");

      if (status === 'diterima' || status === 'ditolak') {
        if (btnValid) btnValid.style.display = "none";
        if (btnTolak) btnTolak.style.display = "none";
      }
    }

    // FILTER BULAN
    document.getElementById("filterBulan").addEventListener("change", function() {
      let bulan = this.value;
      let laporan = document.querySelectorAll(".laporan-item");

      laporan.forEach(l => {
        let tanggal = l.innerText;
        l.style.display = tanggal.includes(bulan) ? "" : "none";

        if (bulan === "") l.style.display = "";
      });
    });

    // Modal Detail
    document.querySelectorAll(".modalDetail").forEach(btn => {
      btn.addEventListener("click", function() {
        const statusMap = {
          'diproses': 'Menunggu Tervalidasi',
          'diterima': 'Tervalidasi',
          'ditolak': 'Ditolak'
        };

        document.getElementById("id").value = this.dataset.id;
        document.getElementById("nama").value = this.dataset.nama;
        document.getElementById("deskripsi").value = this.dataset.deskripsi;
        document.getElementById("tanggal").value = this.dataset.tanggal;
        document.getElementById("lokasi").value = this.dataset.lokasi;
        document.getElementById("status").value = statusMap[this.dataset.status] || this.dataset.status;

        // Tambahkan atribut readonly pada input modal
        document.getElementById("nama").setAttribute('readonly', true);
        document.getElementById("tanggal").setAttribute('readonly', true);
        document.getElementById("status").setAttribute('readonly', true);
        document.getElementById("deskripsi").setAttribute('readonly', true);
        document.getElementById("lokasi").setAttribute('readonly', true);
        const modal = new bootstrap.Modal(
          document.getElementById("modalDetailPengaduan")
        );
        modal.show();
      });
    });
  </script>

</body>

</html>