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

  <title>Login</title>
</head>

<body class="row align-items-center" style="height: 95vh; width: 100%;">
  <nav class="sb-topnav navbar">
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li>
        <a class="dropdown-item" href="../login.php" id="logout">
          <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
      </li>

    </ul>
  </nav>

  <form action="login.php" method="POST" id="block1" class="border border-2 p-3 rounded d-grid mx-auto shadow-lg" style="width: 307px;">

    <div class="mb-3">
      <label for="username">
        <i class="fa-solid fa-users" style="width: 70px; height: 100px; margin-left: 100px;"></i>
        <h5 class="text-center">Aplikasi Keamanan Lingkungan</h5>
    </div>
    <div class="mb-3">
      <input type="text" name="username" placeholder="Username" id="username" class="form-control" required>
      </label>
    </div>
    <div class="mb-3">
      <input type="password" name="password" placeholder="Password" id="password" class="form-control" required>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-1 mb-3">
      <a class="small" href="#">Forgot Password?</a>
    </div>
    <button type="submit" name="login" id="btn" class="btn btn-success rounded-pill">Log-in</button>
  </form>

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

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM tb_rt WHERE username = '$username' AND password = '$password' ";
  $sql2 = "SELECT * FROM tb_warga WHERE username = '$username' AND password = '$password' ";
  $sql3 = "SELECT * FROM tb_sekuriti WHERE username = '$username' AND password = '$password' ";

  $result = $db->query($sql);
  $result2 = $db->query($sql2);
  $result3 = $db->query($sql3);

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    header("location: rt/dashboard-rt.php");
  } elseif ($result2->num_rows > 0) {
    $data = $result2->fetch_assoc();
    $_SESSION['username'] = $username;
    header("location: warga/dashboard-warga.php");
  } elseif ($result3->num_rows > 0) {
    $data = $result3->fetch_assoc();
    $_SESSION['username'] = $username;
    header("location: sekuriti/dashboard-sekuriti.php");
    exit;
  } else {
?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        confirmButtonColor: '#2fd43cff',
        confirmButtonText: 'Try Again'
      });
    </script>
<?php
  }
}
?>

</html>