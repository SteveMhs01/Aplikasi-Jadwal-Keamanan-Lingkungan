<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f4f1f1;
      font-family: 'Poppins', sans-serif;
    }

    .header-title {
      text-align: center;
      margin-top: 20px;
      font-weight: 600;
    }

    .header-title i {
      color: #dc3545;
    }

    .card-schedule {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      margin: 30px auto;
      max-width: 1000px;
    }

    .card-header-custom {
      background: linear-gradient(90deg, #1e8449, #27ae60);
      color: white;
      text-align: center;
      padding: 20px;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .day-title {
      font-weight: 600;
      text-align: center;
      background: #e8f5e9;
      border-radius: 10px;
      padding: 5px 0;
      margin-bottom: 10px;
    }

    .schedule-item {
      text-align: center;
      border-radius: 10px;
      background: #f8f9fa;
      padding: 10px;
      margin-bottom: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .schedule-item:hover {
      background: #e8f5e9;
      cursor: pointer;
    }

    .info-card {
      max-width: 1000px;
      margin: 0 auto;
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

          <h1 class="mb-4">Jadwal Ronda</h1>
          <i class="text-muted">Kelola Jadwal Ronda</i>

          <div class="container mt-4">
          
            <div class="card rounded-4">
              <div class="card-header-custom">
                JADWAL RONDA MINGGU INI<br>
                <small>Oktober 2025</small>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                  <button class="btn btn-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus me-1"></i> Tambah Jadwal
                  </button>
                  <div>
                    <button class="btn btn-outline-primary btn-sm rounded-pill" id="btnEdit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                      <i class="fas fa-edit me-1"></i> Edit Jadwal
                    </button>
                  </div>
                </div>

                <div class="row text-center">
                  <!-- Contoh hari -->
                  <div class="col">
                    <div class="day-title">Senin</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Selasa</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Rabu</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Kamis</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Jumat</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Sabtu</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                  <div class="col">
                    <div class="day-title">Minggu</div>
                    <div class="schedule-item">
                      <strong>Nama</strong><br>
                      <small>19:00 - 03:00</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

            <!-- Modal Tambah Jadwal -->
            <div class="modal fade" id="modalTambah" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content rounded-4 border-0 shadow">
                  <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Jadwal Ronda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama petugas">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select class="form-select">
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
                        <label class="form-label">Waktu</label>
                        <input type="text" class="form-control" placeholder="19:00 - 03:00">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button class="btn btn-success rounded-pill"><i class="fas fa-save me-1"></i>Simpan</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Edit Jadwal -->
            <div class="modal fade" id="modalEdit" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content rounded-4 border-0 shadow">
                  <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Jadwal Ronda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" value="Rizky Fauzi">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select class="form-select">
                          <option>Senin</option>
                          <option>Selasa</option>
                          <option selected>Rabu</option>
                          <option>Kamis</option>
                          <option>Jumat</option>
                          <option>Sabtu</option>
                          <option>Minggu</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Waktu</label>
                        <input type="text" class="form-control" value="19:00 - 03:00">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button class="btn btn-primary rounded-pill"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
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