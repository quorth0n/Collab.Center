<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Creating Document...</title>
</head>
<body>
  <?php
    function generatePad($length = 15) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
    }

    $gen = generatePad();
    $dlang = $_GET['doclang'];

    if (isset($_GET['doclang']) && !empty($_GET['doclang'])) {
      echo "<script>";
      //echo "var gen = prompt('Type a Document Name: ', 'doc--" . $_GET['doclang'] . "');";
      echo "window.location.replace('../docs/document/hash/?padid=$gen&lang=$dlang')";
      echo "</script>";
    } else if (isset($_GET['doclang']) && !empty($_GET['doclang'])) {
      echo "<script>";
      echo "";
      echo "</script>";
    }
  ?>
</body>
</html>
