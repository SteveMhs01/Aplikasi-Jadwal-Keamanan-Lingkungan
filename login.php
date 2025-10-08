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
  <link rel="stylesheet" href="style/bootstrap-5.3.8-dist/css/bootstrap.css">
  <link rel="stylesheet" href="style/fontawesome-free-7.0.1-web/css/all.min.css">
  <link rel="stylesheet" href="style/sweetalert/sweetalert2.css">

  <title>Login</title>
</head>

<body class="row align-items-center" style="height: 95vh; width: 100%;">
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
    <button type="submit" name="login" id="btn" class="btn btn-success rounded-pill">Sign-in</button>
  </form>

  <script type="text/javascript" src="./style/sweetalert/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="style/bootstrap-5.3.8-dist/js/bootstrap.js"></script>
  <script type="text/javascript" src="style/fontawesome-free-7.0.1-web/js/all.min.js"></script>
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
    header("location: dashboard/dashboard-rt.php");
  } elseif ($result2->num_rows > 0) {
    $data = $result2->fetch_assoc();
    $_SESSION['username'] = $username;
    header("location: dashboard/dashboard-warga.php");
  } elseif ($result3->num_rows > 0) {
    $data = $result3->fetch_assoc();
    $_SESSION['username'] = $username;
    header("location: dashboard/dashboard-sekuriti.php");
    exit;
  } else {
?>
    <script
      script type="text/javascript">
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