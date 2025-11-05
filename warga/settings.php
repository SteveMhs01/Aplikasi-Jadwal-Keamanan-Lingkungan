<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>PENGATURAN AKUN</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- data tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
  <style>
    body {
      background-color: #f9f6f6;
      font-family: 'Poppins', sans-serif;
    }

    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .profile-pic {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #e5e7eb;
    }

    .form-control, .form-select {
      border-radius: 10px;
    }

    .btn-save {
      background-color: #3b82f6;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      transition: 0.2s;
    }

    .btn-save:hover {
      background-color: #2563eb;
    }

    .btn-upload {
      background-color: #f3f4f6;
      color: #374151;
      border-radius: 8px;
      font-size: 0.9rem;
    }

    .divider {
      border-bottom: 1px solid #e5e7eb;
      margin: 1.5rem 0;
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
          <div class="card shadow" >
            <div class="card-body">
              <div class="container py-4">
                <h4 class="fw-bold mb-4"><i class="fa-solid fa-gear me-2"></i>Pengaturan Pengguna</h4>

                <div class="card p-4">
                  <div class="">
                    <div class="col-md-3">
                      <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Profile" class="profile-pic mb-5 w-100 h-100">
                      
                    </div>
                    <hr class="mb-5">
                    <div class="col-md-9 mb-2">
                      <h5 class="fw-semibold mb-4">Informasi Akun</h5>
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Nama Lengkap</label>
                          <input type="text" class="form-control" placeholder="Nama Lengkap" value="Rizky Fauzi">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Username</label>
                          <input type="text" class="form-control" placeholder="Username" value="rizky_rt">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Email</label>
                          <input type="email" class="form-control" placeholder="Email" value="rizky@example.com">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Nik</label>
                          <input type="text" class="form-control" placeholder="No Nik" value="21717111">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Alamat</label>
                          <br>
                          <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="">Politeknik</textarea>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Nomor Telepon</label>
                          <input type="text" class="form-control" placeholder="08xxxxxxxxxx" value="081234567890">
                        </div>
                      </div>
                    </div>
                  </div>

                  <hr class="mb-5">

                  <h5 class="fw-semibold mb-3"><i class="fa-solid fa-lock me-2"></i>Ubah Password</h5>
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Password Lama</label>
                      <input type="password" class="form-control" placeholder="Masukkan password lama">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Password Baru</label>
                      <input type="password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Konfirmasi Password</label>
                      <input type="password" class="form-control" placeholder="Konfirmasi password baru">
                    </div>
                  </div>

                  <div class="text-end mt-4">
                    <button class="btn btn-outline-primary"><i class="fa-solid fa-save me-2"></i>Simpan Perubahan</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>