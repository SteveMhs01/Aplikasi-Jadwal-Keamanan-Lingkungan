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
      font-family: 'Poppins', sans-serif;
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
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
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
                    <h4 class="mb-0 fw-bold">0</h4>
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
                    <h4 class="mb-0 fw-bold">0%</h4>
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
                    <h4 class="mb-0 fw-bold">0</h4>
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
                    <h4 class="mb-0 fw-bold">0</h4>
                    <p class="mb-0 text-muted small">Total Laporan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Filter -->
          <div class="card mb-4 p-3 shadow">
            <div class="d-flex flex-wrap align-items-center gap-2 filter-section">
              <h6 class="fw-semibold mb-0 me-3">Laporan Menunggu Validasi</h6>
              <select class="form-select w-auto">
                <option>Semua Urgensi</option>
                <option>Tinggi</option>
                <option>Sedang</option>
                <option>Rendah</option>
              </select>
              <select class="form-select w-auto">
                <option>Semua Jenis</option>
                <option>Kriminal</option>
                <option>Kecelakaan</option>
                <option>Kebersihan</option>
              </select>
              <input type="text" class="form-control w-auto" placeholder="Cari laporan...">
            </div>
          </div>

          <!-- Daftar Laporan -->
          <div class="card mb-3 p-3 card-laporan shadow">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="fw-bold mb-1">Sampah Menumpuk <span class="badge bg-success-subtle text-success ms-2">Baru</span></h6>
                <div class="text-muted small mb-2"><i class="fa-regular fa-user"></i> J. Mendole Nias, A4 · <i class="fa-regular fa-calendar"></i> 8 Nov 2025, 19:00</div>
                <p class="mb-2 text-secondary">Sampah telah menumpuk di TPS selama 4 hari karena truk pengangkut tidak datang. Menimbulkan bau tidak sedap dan berpotensi menjadi sumber penyakit.</p>
              </div>
              <button class="btn btn-warning btn-sm">Menunggu Validasi</button>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn-validasi btn-sm"><i class="fa-solid fa-check me-1"></i> Validasi</button>
              <button class="btn-tolak btn-sm"><i class="fa-solid fa-xmark me-1"></i> Tolak</button>
              <button class="btn-detail btn-sm"><i class="fa-solid fa-eye me-1"></i> Detail</button>
            </div>
          </div>

          <div class="card mb-3 p-3 card-laporan shadow">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="fw-bold mb-1">Kecelakaan Lalu Lintas <span class="badge bg-warning-subtle text-warning ms-2">Sedang</span></h6>
                <div class="text-muted small mb-2"><i class="fa-regular fa-user"></i> P. Yanes, A1 · <i class="fa-regular fa-calendar"></i> 9 Nov 2025, 08:00</div>
                <p class="mb-2 text-secondary">Tabrakan antara sepeda motor dan mobil angkutan umum. Satu orang luka-luka dan sudah dibawa ke puskesmas.</p>
              </div>
              <button class="btn btn-warning btn-sm">Menunggu Validasi</button>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn-validasi btn-sm"><i class="fa-solid fa-check me-1"></i> Validasi</button>
              <button class="btn-tolak btn-sm"><i class="fa-solid fa-xmark me-1"></i> Tolak</button>
              <button class="btn-detail btn-sm"><i class="fa-solid fa-eye me-1"></i> Detail</button>
            </div>
          </div>

          <div class="card mb-3 p-3 card-laporan shadow">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="fw-bold mb-1">Pencurian Sepeda Motor <span class="badge bg-warning-subtle text-warning ms-2">Sedang</span></h6>
                <div class="text-muted small mb-2"><i class="fa-regular fa-user"></i> A. Moringa · <i class="fa-regular fa-calendar"></i> 10 Nov 2025, 06:00</div>
                <p class="mb-2 text-secondary">Sepeda motor Honda Beat warna hitam milik warga dicuri dari halaman rumah. Kejadian terjadi saat korban sedang tidur.</p>
              </div>
              <button class="btn btn-warning btn-sm">Menunggu Validasi</button>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn-validasi btn-sm"><i class="fa-solid fa-check me-1"></i> Validasi</button>
              <button class="btn-tolak btn-sm"><i class="fa-solid fa-xmark me-1"></i> Tolak</button>
              <button class="btn-detail btn-sm"><i class="fa-solid fa-eye me-1"></i> Detail</button>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>