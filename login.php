<?php
include("connection/connection.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/">
  <link rel="icon" href="style/picture/LOGO_Prod_TRPL_Variant_13_Square Black Line.jpg">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./css/styles.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <style>
    body {
      background-color: #f9f6f6;
      margin: 0;
      padding: 0;
    }

    .container {
      padding: 10% 0;
      max-width: 450px;
    }

    .login-container h2 {
      margin-bottom: 20px;
    }

  </style>
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="card p-4 rounded-3 shadow">
      <h2 class="text-center">Login</h2>
      <form id="loginForm" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <div class="input-group">
            <span class="input-group-text bg-white"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text bg-white"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
          </div>
        </div>
        <button type="submit" class="btn btn-outline-success w-100 mt-3" name="login"><i class="fas fa-sign-in-alt me-1"></i>Login</button>
      </form>
      <p class="text-center mt-3">
        <a href="#" class="link-primary">Lupa Password?</a>
      </p>
    </div>
  </div>
  <script type="text/javascript" src="sweetalert/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>
<?php
// proses login
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // tabel => path dashboard (urutan tetap: rt, warga, sekuriti)
  $checks = [
    'tb_rt'       => 'rt/dashboard-rt.php',
    'tb_warga'    => 'warga/dashboard-warga.php',
    'tb_sekuriti' => 'sekuriti/dashboard-sekuriti.php'
  ];



  foreach ($checks as $table => $redirect) {
    $sql = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);

    if ($result && $result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $_SESSION['username'] = $username;
?>
      <script>
        Swal.fire({
          icon: "success",
          title: "Login berhasil!",
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout(() => {
          window.location.href = "<?= $redirect ?>";
        }, 1500);
      </script>
  <?php
      exit;
    }
  }

  // jika tidak ditemukan di ketiga akun
  ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: 'Login Gagal',
      text: 'Username atau Password Salah',
      confirmButtonColor: '#482fd4ff',
      confirmButtonText: 'Coba Lagi'
    });
  </script>
<?php
}
?>

</html>