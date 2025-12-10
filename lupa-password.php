<?php
include("connection/connection.php");
session_start();

$userData = null;

if (isset($_POST['check_nik'])) {
  $nik = trim($_POST['nik']);

  $sql = "SELECT * FROM tb_pengguna WHERE nik='$nik'";
  $result = $db->query($sql);

  if ($result && $result->num_rows > 0) {
    $userData = $result->fetch_assoc();
  } else {
    $error = "NIK tidak ditemukan!";
  }
}

if (isset($_POST['reset_password'])) {
  $nik = $_POST['nik'];
  $newPass = $_POST['password'];

  $sql = "UPDATE tb_pengguna SET password='$newPass' WHERE nik='$nik'";
  if ($db->query($sql)) {
    $success = "Password berhasil diubah! Silakan login kembali.";
  } else {
    $error = "Gagal mengubah password.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
  body {
    background-color: #f9f6f6;
    margin: 0;
    padding: 0;
  }

  .container {
    padding: 12% 0;
  }

  .login-container h2 {
    margin-bottom: 20px;
  }
</style>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5">

        <div class="card shadow p-4">
          <h3 class="text-center mb-3">Lupa Password</h3>

          <!-- ALERT -->
          <?php if (isset($error)) : ?>
            <script>
              Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "<?= $error ?>",
              });
            </script>
          <?php endif; ?>

          <!-- FORM CEK NIK -->
          <?php if (!isset($userData) && !isset($success)) : ?>
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Masukkan Nik </label>
                <input type="number" name="nik" class="form-control" required>
              </div>

              <button type="submit" name="check_nik" class="btn btn-outline-success w-100">
                Cek Nik
              </button>
            </form>
          <?php endif; ?>

          <!-- FORM GANTI PASSWORD -->
          <?php if (isset($userData) && !isset($success)) : ?>
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Nik</label>
                <input type="text" class="form-control" value="<?= $userData['nik'] ?>" readonly>
                <input type="hidden" name="nik" value="<?= $userData['nik'] ?>">
                <input type="hidden" name="table" value="<?= $foundTable ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <button type="submit" name="reset_password" class="btn btn-outline-success w-100">
                Reset Password
              </button>
            </form>
          <?php endif; ?>

          <div class="text-center mt-3">
            <a href="login.php">Kembali ke Login</a>
          </div>

        </div>
      </div>
    </div>
  </div>

</body>

</html>