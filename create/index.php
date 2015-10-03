<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Creating Document...</title>
  <script src="https://cdn.firebase.com/js/client/2.0.2/firebase.js"></script>
  <script src="../docs/tools/Cookies.js"></script>
</head>
<body bgcolor="whitesmoke">
  <?php
    function generatePad($length = 15) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
    }

    $dlang = "";

    $gen = generatePad();

    //New Doc Code
    if ($_GET['doclang'] == "Plain Text") {
      $dlang = "Plain Text";
      //example
    } else if ($_GET['doclang'] == "Rich Text") {
      $dlang = "rich";
    } else {
      $dlang = $_GET['doclang'];
    }

    if (isset($_GET['doclang']) && !empty($_GET['doclang'])) {
      echo "<script>";
      //echo "window.location.replace('../docs/document/hash/?padid=$gen&lang=$dlang')";
      echo "window.lang = '$gen';";
      echo "</script>";
    } else if (isset($_GET['templatename']) && !empty($_GET['templatename'])) {
      $temp = $_GET['templatename'];
      echo "<script>";
      //echo "window.location.replace('../docs/document/hash/?padid=$gen&temp=$temp')";
      echo "window.temp = '$temp';";
      echo "</script>";
    }

    echo "<script>window.gen='$gen';</script>";
  ?>
  <script>
    if (Cookies.get('uid') != undefined) {
      var onComplete = function() {
        //To prevent the page from redirecting before firebase is finished.

        if (window.temp != undefined) {
          window.location.replace('../docs/document/hash/?padid=' + window.gen + '&temp=' + window.temp);
        } else {
          window.location.replace('../docs/document/hash/?padid=' + window.gen + '&lang=' + window.lang);
        }
      }
      var date = "" + new Date();
      var doc = new Firebase('https://collab-doc-props.firebaseio.com/').child(Cookies.get('uid')).child(window.gen).child('creationdate').set(date, onComplete);
    } else {
      var onComplete = function() {
        //To prevent the page from redirecting before firebase is finished.

        if (window.temp != undefined) {
          window.location.replace('../docs/document/hash/?padid=' + window.gen + '&temp=' + window.temp);
        } else {
          window.location.replace('../docs/document/hash/?padid=' + window.gen + '&lang=' + window.lang);
        }
      }
      var date = "" + new Date();
      var doc = new Firebase('https://collab-doc-props.firebaseio.com/').child(window.gen).child('creationdate').set(date, onComplete);
    }
  </script>
</body>
</html>
