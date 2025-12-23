<?php
/* panggil koneksi ke database */
// call ambulance call ambulance but not for me
session_start();
include '../connection/connection.php';
?>

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
  <!-- data tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
  <style>
    .avatar-circle {
      width: 45px;
      height: 45px;
      background: #7d5cff;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    .card-custom {
      border-radius: 18px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
    }

    .btn-hadir {
      background: #28a745;
      color: white;
    }

    .btn-absen {
      background: #dc3545;
      color: white;
    }

    .header-bg {
      border-radius: 18px 18px 0px 0px;
      background: linear-gradient(to right, #2a71e8, #00c6ff);
      color: white;
      padding: 25px 10px;
      text-align: center;
    }
  </style>

</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  include '../connection/connection.php';


  $tanggal_hari_ini = date('Y-m-d');

  $jadwal = mysqli_query($koneksi, "
  SELECT 
    j.id_jadwal,
    jd.id_jadwal_detail,
    p.id_pengguna,
    p.nama,
    jd.jam_masuk
  FROM tb_jadwal j
  JOIN tb_jadwal_detail jd ON j.id_jadwal = jd.id_jadwal
  JOIN tb_pengguna p ON jd.id_pengguna = p.id_pengguna
  WHERE j.tanggal = '$tanggal_hari_ini'
    AND j.absensi_selesai = 0
");

  $jumlah = mysqli_num_rows($jadwal);

  ?>

  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container py-5">
          <div class="card card-custom">

            <div class="header-bg">
              <h4 class="fw-bold">ABSENSI RONDA HARI INI</h4>
              <time><?= date('d F Y'); ?></time>
            </div>

            <?php if ($jumlah > 0) { ?>
              <form method="POST" action="proses_absensi.php">

                <?php while ($row = mysqli_fetch_assoc($jadwal)) { ?>

                  <input type="hidden" name="id_pengguna[]" value="<?= $row['id_pengguna']; ?>">
                  <input type="hidden" name="jam_masuk[]" value="<?= $row['jam_masuk']; ?>">

                  <input type="hidden" name="id_jadwal" value="<?= $row['id_jadwal']; ?>">

                  <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                      <div class="avatar-circle">
                        <?= strtoupper(substr($row['nama'], 0, 1)); ?>
                      </div>
                      <div>
                        <strong><?= htmlspecialchars($row['nama']); ?></strong><br>
                        <small><?= date('H:i', strtotime($row['jam_masuk'])); ?></small>
                      </div>
                    </div>

                    <div>
                      <select name="status_absensi[]" class="form-select form-select-sm" required>
                        <option value="">Pilih</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Tidak Hadir</option>
                      </select>
                    </div>
                  </div>

                <?php } ?>

                <div class="p-3">
                  <label class="form-label fw-bold">Keterangan Absensi</label>
                  <textarea
                    name="keterangan"
                    class="form-control"
                    placeholder="Contoh: hujan deras"
                    required></textarea>
                </div>

                <button type="submit" name="simpan_absensi" class="btn btn-success mt-3 mb-3 mx-3">
                  Simpan Absensi Hari Ini
                </button>

              </form>

            <?php } else { ?>
              <div class="alert alert-warning text-center mt-4">
                <i class="fa-solid fa-calendar-xmark fa-2x mb-2"></i><br>
                <strong>Tidak ada jadwal ronda hari ini</strong>
              </div>
            <?php } ?>

          </div>
        </div>
      </main>

    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
    crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
  <?php if (isset($_SESSION['success_absensi'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Absensi Berhasil',
        text: 'Absensi hari ini berhasil disimpan',
        confirmButtonColor: '#28a745',
        timer: 2000,
        showConfirmButton: false
      });
    </script>
  <?php unset($_SESSION['success_absensi']);
  endif; ?>

</body>

</html>