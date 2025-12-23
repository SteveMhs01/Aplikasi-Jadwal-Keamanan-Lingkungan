<?php
include "../connection/connection.php";
session_start();
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

if (isset($_POST['import_excel'])) {

  // Validasi file upload
  if (empty($_FILES['file_excel']['tmp_name'])) {
    $_SESSION['error'] = "File tidak ditemukan";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }

  // Validasi ekstensi file
  $allowed_ext = ['xlsx', 'xls'];
  $file_ext = strtolower(pathinfo($_FILES['file_excel']['name'], PATHINFO_EXTENSION));

  if (!in_array($file_ext, $allowed_ext)) {
    $_SESSION['error'] = "Format file tidak valid. Hanya menerima .xlsx atau .xls";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }

  // Validasi ukuran file (max 5MB)
  if ($_FILES['file_excel']['size'] > 5242880) {
    $_SESSION['error'] = "Ukuran file terlalu besar. Maksimal 5MB";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }

  $file_tmp = $_FILES['file_excel']['tmp_name'];

  try {
    $spreadsheet = IOFactory::load($file_tmp);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    if (count($sheetData) < 2) {
      $_SESSION['error'] = "File Excel tidak berisi data";
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    }

    mysqli_begin_transaction($koneksi);

    $success = 0;
    $skip = 0;
    $errors = [];

    foreach ($sheetData as $i => $row) {

      // Skip header
      if ($i == 0) continue;

      $nik = trim($row[0] ?? '');
      $tanggal_raw = $row[1] ?? '';
      $jam = trim($row[2] ?? '');

      if ($nik == '' || $tanggal_raw == '' || $jam == '') {
        $skip++;
        continue;
      }

      // ===== Konversi tanggal =====
      if (is_numeric($tanggal_raw)) {
        $tanggal = Date::excelToDateTimeObject($tanggal_raw)->format('Y-m-d');
      } else {
        $tanggal = date('Y-m-d', strtotime($tanggal_raw));
      }

      // ===== Normalisasi jam =====
      if (strlen($jam) == 5) {
        $jam .= ':00';
      }

      // ===== Cek warga =====
      $qWarga = mysqli_query(
        $koneksi,
        "SELECT id_pengguna FROM tb_pengguna 
       WHERE nik = '$nik' AND role = 'Warga'"
      );

      if (mysqli_num_rows($qWarga) == 0) {
        $errors[] = "Baris " . ($i + 1) . ": NIK $nik tidak ditemukan";
        continue;
      }

      $id_pengguna = mysqli_fetch_assoc($qWarga)['id_pengguna'];

      // ===== Cek / buat jadwal =====
      $qJadwal = mysqli_query(
        $koneksi,
        "SELECT id_jadwal FROM tb_jadwal WHERE tanggal = '$tanggal'"
      );

      if (mysqli_num_rows($qJadwal) > 0) {
        $id_jadwal = mysqli_fetch_assoc($qJadwal)['id_jadwal'];
      } else {
        mysqli_query(
          $koneksi,
          "INSERT INTO tb_jadwal (tanggal) VALUES ('$tanggal')"
        );
        $id_jadwal = mysqli_insert_id($koneksi);
      }

      // ===== Cek duplikat detail =====
      $qDetail = mysqli_query(
        $koneksi,
        "SELECT id_jadwal_detail FROM tb_jadwal_detail
       WHERE id_jadwal = '$id_jadwal'
       AND id_pengguna = '$id_pengguna'"
      );

      if (mysqli_num_rows($qDetail) > 0) {
        // UPDATE
        $id_detail = mysqli_fetch_assoc($qDetail)['id_jadwal_detail'];
        mysqli_query(
          $koneksi,
          "UPDATE tb_jadwal_detail 
         SET jam_masuk = '$jam'
         WHERE id_jadwal_detail = '$id_detail'"
        );
      } else {
        // INSERT
        mysqli_query(
          $koneksi,
          "INSERT INTO tb_jadwal_detail (id_jadwal, id_pengguna, jam_masuk)
         VALUES ('$id_jadwal', '$id_pengguna', '$jam')"
        );
      }

      $success++;
    }

    mysqli_commit($koneksi);

    $_SESSION['success'] = "Berhasil import $success data";
    if ($skip > 0) {
      $_SESSION['success'] .= ", $skip baris dilewati";
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  } catch (Exception $e) {
    mysqli_rollback($koneksi);
    $_SESSION['error'] = "Import gagal: " . $e->getMessage();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  }
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

          <?php
          // Tampilkan pesan sukses
          if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
            echo htmlspecialchars($_SESSION['success']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
            unset($_SESSION['success']);
          }

          // Tampilkan pesan error
          if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">';
            echo htmlspecialchars($_SESSION['error']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
            unset($_SESSION['error']);
          }

          // Tampilkan detail errors
          if (isset($_SESSION['errors'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
            echo '<strong>Beberapa baris gagal diimport:</strong><br>';
            echo '<ul class="mb-0">';
            foreach ($_SESSION['errors'] as $err) {
              echo '<li>' . htmlspecialchars($err) . '</li>';
            }
            echo '</ul>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
            unset($_SESSION['errors']);
          }
          ?>

          <!-- Jadwal Cards -->
          <div class="card mt-4 mb-4 shadow">
            <div class="card-body">
              <button type="button" class="btn btn-outline-success btn-sm mt-3 mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                <i class="fas fa-circle-plus me-1"></i> Tambah Jadwal
              </button>

              <a href="../template/template_jadwal.xlsx"
                class="btn btn-outline-primary btn-sm mt-3 mb-4 shadow-sm"
                download>
                <i class="fas fa-download me-1"></i> Download Template Excel
              </a>


              <!-- Filter Jadwal -->
              <div class="btn-group mb-4 ms-2" role="group">
                <a href="?filter=all" class="btn btn-sm btn-outline-secondary <?= (!isset($_GET['filter']) || $_GET['filter'] == 'all') ? 'active' : ''; ?>">
                  <i class="fas fa-list me-1"></i> Semua
                </a>
                <a href="?filter=today" class="btn btn-sm btn-outline-success <?= (isset($_GET['filter']) && $_GET['filter'] == 'today') ? 'active' : ''; ?>">
                  <i class="fas fa-calendar-day me-1"></i> Hari Ini
                </a>
                <a href="?filter=upcoming" class="btn btn-sm btn-outline-warning <?= (isset($_GET['filter']) && $_GET['filter'] == 'upcoming') ? 'active' : ''; ?>">
                  <i class="fas fa-calendar-plus me-1"></i> Akan Datang
                </a>
                <a href="?filter=past" class="btn btn-sm btn-outline-secondary <?= (isset($_GET['filter']) && $_GET['filter'] == 'past') ? 'active' : ''; ?>">
                  <i class="fas fa-history me-1"></i> Sudah Lewat
                </a>
              </div>

              <?php
              // Filter setup
              $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
              $where_clause = "";

              switch ($filter) {
                case 'today':
                  $where_clause = "WHERE tanggal = CURDATE()";
                  break;
                case 'upcoming':
                  $where_clause = "WHERE tanggal > CURDATE()";
                  break;
                case 'past':
                  $where_clause = "WHERE tanggal < CURDATE()";
                  break;
                default:
                  $where_clause = "";
              }

              // Pagination setup
              $items_per_page = 6;
              $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $offset = ($current_page - 1) * $items_per_page;

              // Count total jadwal (dengan filter)
              $count_query = mysqli_query($koneksi, "
                SELECT COUNT(*) as total 
                FROM tb_jadwal
                $where_clause
              ");
              $total_items = mysqli_fetch_assoc($count_query)['total'];
              $total_pages = ceil($total_items / $items_per_page);

              // Get jadwal with pagination (dengan filter)
              $jadwalQuery = mysqli_query($koneksi, "
                SELECT * 
                FROM tb_jadwal
                $where_clause
                ORDER BY tanggal DESC
                LIMIT $items_per_page OFFSET $offset
              ");
              ?>

              <div class="row">
                <?php
                if (mysqli_num_rows($jadwalQuery) > 0) {
                  while ($jadwal = mysqli_fetch_assoc($jadwalQuery)) {
                    // Count warga per jadwal
                    $count_warga = mysqli_query($koneksi, "
                      SELECT COUNT(*) as total 
                      FROM tb_jadwal_detail 
                      WHERE id_jadwal = {$jadwal['id_jadwal']}
                    ");
                    $total_warga = mysqli_fetch_assoc($count_warga)['total'];

                    $label = (date('Y-m-d') == $jadwal['tanggal'])
                      ? '<span class="badge bg-success ms-2">Hari Ini</span>'
                      : '';

                    // Cek apakah jadwal sudah lewat
                    $is_past = (strtotime($jadwal['tanggal']) < strtotime(date('Y-m-d')));
                    if ($is_past) {
                      $label = '<span class="badge bg-secondary ms-2">Sudah Lewat</span>';
                    }

                    // Cek apakah jadwal akan datang
                    $is_future = (strtotime($jadwal['tanggal']) > strtotime(date('Y-m-d')));
                    if ($is_future) {
                      $label = '<span class="badge bg-warning text-dark ms-2">Akan Datang</span>';
                    }

                    // Format hari
                    $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $nama_hari = $hari[date('w', strtotime($jadwal['tanggal']))];
                ?>
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                              <h5 class="card-title mb-1">
                                <i class="fas fa-calendar-day text-primary me-2"></i>
                                <?= $nama_hari ?>, <?= date('d F Y', strtotime($jadwal['tanggal'])); ?>
                              </h5>
                              <?= $label ?>
                            </div>
                            <a href="hapus_jadwal.php?id=<?= $jadwal['id_jadwal']; ?>"
                              class="btn btn-sm btn-danger"
                              onclick="return confirm('Yakin ingin menghapus jadwal ini beserta seluruh warga di dalamnya?')">
                              <i class="fa-solid fa-trash"></i>
                            </a>
                          </div>

                          <div class="mb-3">
                            <span class="badge bg-info text-dark">
                              <i class="fas fa-users me-1"></i>
                              <?= $total_warga ?> Warga Terdaftar
                            </span>
                          </div>

                          <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#detailModal<?= $jadwal['id_jadwal']; ?>">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                          </button>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal<?= $jadwal['id_jadwal']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                          <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                              <i class="fas fa-calendar-check me-2"></i>
                              Detail Jadwal - <?= date('d F Y', strtotime($jadwal['tanggal'])); ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <?php
                            $detailQuery = mysqli_query($koneksi, "
                            SELECT 
                              p.nama,
                              p.nik,
                              jd.jam_masuk
                            FROM tb_jadwal_detail jd
                            JOIN tb_pengguna p ON jd.id_pengguna = p.id_pengguna
                            WHERE jd.id_jadwal = {$jadwal['id_jadwal']}
                            ORDER BY jd.jam_masuk ASC
                          ");

                            if (mysqli_num_rows($detailQuery) > 0) {
                            ?>
                              <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                  <thead class="table-light">
                                    <tr>
                                      <th width="5%">No</th>
                                      <th width="35%">Nama Warga</th>
                                      <th width="30%">NIK</th>
                                      <th width="30%">Jam Masuk</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $no = 1;
                                    while ($detail = mysqli_fetch_assoc($detailQuery)) {
                                    ?>
                                      <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                          <i class="fas fa-user-circle text-secondary me-2"></i>
                                          <?= htmlspecialchars($detail['nama']); ?>
                                        </td>
                                        <td><?= htmlspecialchars($detail['nik']); ?></td>
                                        <td>
                                          <span class="badge bg-success">
                                            <i class="fas fa-clock me-1"></i>
                                            <?= date('H:i', strtotime($detail['jam_masuk'])); ?>
                                          </span>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            <?php } else { ?>
                              <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Belum ada warga terdaftar untuk jadwal ini
                              </div>
                            <?php } ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                } else {
                  ?>
                  <div class="col-12">
                    <div class="alert alert-info text-center">
                      <i class="fas fa-info-circle me-2"></i>
                      Belum ada jadwal yang tersedia
                    </div>
                  </div>
                <?php } ?>
              </div>

              <!-- Pagination -->
              <?php if ($total_pages > 1) { ?>
                <nav aria-label="Pagination">
                  <ul class="pagination justify-content-center mt-4">
                    <!-- Previous -->
                    <li class="page-item <?= ($current_page <= 1) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?filter=<?= $filter ?>&page=<?= $current_page - 1; ?>">
                        <i class="fas fa-chevron-left"></i>
                      </a>
                    </li>

                    <?php
                    // Show page numbers
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);

                    if ($start_page > 1) {
                      echo '<li class="page-item"><a class="page-link" href="?filter=' . $filter . '&page=1">1</a></li>';
                      if ($start_page > 2) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                      }
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                      $active = ($i == $current_page) ? 'active' : '';
                      echo '<li class="page-item ' . $active . '"><a class="page-link" href="?filter=' . $filter . '&page=' . $i . '">' . $i . '</a></li>';
                    }

                    if ($end_page < $total_pages) {
                      if ($end_page < $total_pages - 1) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                      }
                      echo '<li class="page-item"><a class="page-link" href="?filter=' . $filter . '&page=' . $total_pages . '">' . $total_pages . '</a></li>';
                    }
                    ?>

                    <!-- Next -->
                    <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?filter=<?= $filter ?>&page=<?= $current_page + 1; ?>">
                        <i class="fas fa-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </nav>
              <?php } ?>

            </div>

            <!-- Modal Tambah Jadwal -->
            <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-3 shadow">
                  <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="tambahJadwalModalLabel">Import Jadwal Ronda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-info">
                      <strong>Format Excel:</strong>
                      <ul class="mb-0">
                        <li>Kolom A: NIK</li>
                        <li>Kolom B: Tanggal (format: MM/DD/YYYY)</li>
                        <li>Kolom C: Jam (format: HH:MM)</li>
                      </ul>
                      <small>Baris pertama (header) akan diabaikan</small>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label class="form-label">File Excel (.xlsx atau .xls)</label>
                        <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls" required>
                        <div class="form-text">Maksimal ukuran file: 5MB</div>
                      </div>

                      <button type="submit" name="import_excel" class="btn btn-success w-100">
                        <i class="fas fa-upload me-1"></i> Import Jadwal
                      </button>
                    </form>
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
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>