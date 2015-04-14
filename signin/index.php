<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Redirecting...</title>
</head>
<body>
  <!--Temporary Redirect Script-->
  <?php
  if ($_GET['mode'] != 'out') {
    echo "<script>window.location.replace('../docs/signin/signin.php');</script>";
  } else {
    echo "<script>window.location.replace('../docs/signin/signin.php?mode=out');</script>";
  }
  ?>
  <!--Remove that ^^^, later-->
</body>
</html>
