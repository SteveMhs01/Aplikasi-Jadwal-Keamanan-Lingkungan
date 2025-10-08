<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../style/picture/LOGO_Prod_TRPL_Variant_13_Square Black Line.jpg">
  <title>Dashboard Rt</title>
</head>

<body>
  <h1>Dashboard <?php echo $_SESSION['username']; ?></h1>
  <br>
  <a href="../login.php">Log-out</a>
</body>

</html>