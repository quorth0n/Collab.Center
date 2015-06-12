<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="docs/favicon.ico">
  <!--<link rel="stylesheet" href="../tools/style.css">-->
  <link rel="stylesheet" href="../../cdn/style.css" media="screen" title="no title" charset="utf-8">
  <script src="../tools/Cookies.js"></script>
  <script type='text/javascript' src='https://cdn.firebase.com/js/client/1.0.15/firebase.js'></script>
  <script type='text/javascript' src='https://cdn.firebase.com/js/simple-login/1.5.0/firebase-simple-login.js'></script>
  <title>Sign In - Collab.Center</title>
  <style>
  @keyframes animate-drop {
    0% {opacity:0;transform: translate(0, -315px);}
    100% {opacity:1;transform: translate(0, 0);}
  }


  blockquote {
    border-bottom: 1px solid white;
    animation: animate-drop 0.6s linear;
  }

  .button {
    display: inline-block;
    color: white;
    width: 180px;
    border-radius: 5px;
    white-space: nowrap;
    cursor: pointer;
  }

  #google {
    background: #dd4b39;
  }

  #facebook {
    background: #3974DD;
    width: 200px;
  }

  #twitter {
    background: #39AFDD;
    width: 200px;
  }

  #google:hover {
    background: #e74b37;
  }

  #facebook:hover {
    background: #3784E7;
  }

  #twitter:hover {
    background: #39BEDD;
  }

  .icon {
    display: inline-block;
    vertical-align: middle;
    width: 35px;
    height: 35px;
  }

  #google .icon {
    background: url('gplus.png') transparent 5px 50% no-repeat;
    border-right: #bb3f30 1px solid;
  }

  #facebook .icon {
    background: url('fb.png') transparent 5px 50% no-repeat;
    border-right: #3057BB 1px solid;
  }

  #twitter .icon {
    background: url('twitter.png') transparent 5px 50% no-repeat;
    border-right: 1.99px solid #3998DD;
  }

  .btntxt {
    display: inline-block;
    vertical-align: middle;
    padding-right: 35px;
    font-size: 14px;
    font-weight: bold;
    font-family: 'Roboto',arial,sans-serif;
  }

  #first {
    width: 66px;
  }

  #last {
    width: 63px;
  }

  fieldset {
    width: 50%;
    margin: 0 auto;
  }
  </style>
  <script>
  function qotd() {
    var quotes = [
    "The secret of getting ahead is getting started",
    "Expect problems and eat them for breakfast",
    "By failing to prepare, you are preparing to fail",
    "Optimism is the faith that leads to achievement. Nothing can be done without hope and confidence",
    "It does not matter how slow you go - so long as you do not stop"
    ];

    var authors = [
    "Mark Twain",
    "Alfred A. Montapert",
    "Benjamin Franklin",
    "Helen Keller",
    "Confucius"
    ];

    var rand = Math.floor((Math.random() * 4) + 0);
    console.log(rand);

    document.getElementById("quote").innerHTML = "\"" + quotes[rand] + "\"";
    document.getElementById("author").innerHTML = "- " + authors[rand];
  }

  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  var chatRef = new Firebase('https://collab-coding-login.firebaseio.com');
  var auth = new FirebaseSimpleLogin(chatRef, function(error, user) {
    if (error) {
      // an error occurred while attempting login
      if (error.code == "INVALID_EMAIL" || error.code == "INVALID_PASSWORD" || error.code == "INVALID_USER") {
        document.getElementById('error').innerHTML = "<span style='color: red;'>Invalid Email/Password</span>";
      } else {
        alert('An error occurred while trying to log you in.' + error);
        console.log(error);
      }

    } else if (user) {
      // user authenticated with Firebase
      //console.log('Name: ' + user.displayName + ', email: ' + user.thirdPartyUserData.email);

      //set cookies
      if (user.provider != "password") {
        Cookies.set('name', user.displayName, {path : '/'});
      } else {
        var firstname;
        var lastname;
        var firstnameb = new Firebase('https://collab-coding-login.firebaseio.com').child(user.uid).child('first');
        var lastnameb = new Firebase('https://collab-coding-login.firebaseio.com').child(user.uid).child('last');

        firstnameb.once('value', function (snapshot) {
          firstname = snapshot.val();
          lastnameb.once('value', function (snapshot) {
            lastname = snapshot.val();
            Cookies.set('name', firstname + " " + lastname, {path : '/'});
          });
        });

      }

      Cookies.set('uid', user.id, {path: '/'});

      if (user.provider != "facebook") {
        Cookies.set('email', user.email , {path: '/'});
      } else {
        Cookies.set('email', user.thirdPartyUserData.email , {path: '/'});
      }


      console.log(user);

      if (getParameterByName('mode') != "out") {
        window.history.back();
      }
    } else {
      // user is logged out
    }


  });

  if (getParameterByName('mode') == "out") {
    auth.logout();
    Cookies.clear('email',{path   : '/'});
    Cookies.clear('name',{path   : '/'});
    Cookies.clear('uid',{path : '/'});
    alert("You have been successfully signed out.");
    var uri = window.location.toString();

    if (uri.indexOf("?") > 0) {
      var clean_uri = uri.substring(0, uri.indexOf("?"));
      //window.history.replaceState({}, document.title, clean_uri);
      window.location.replace(clean_uri);
    }
  }

  function google() {
    auth.login('google', {
      rememberMe: true
    });
  }

  function twitter() {
    auth.login('twitter', {
      rememberMe: true
    });
  }

  function facebook() {
    auth.login('facebook', {
      rememberMe: true,
      scope: 'email,user_likes'
    });
  }

  function inMode() {
    var html = '<input type="email" placeholder="Email" name="lemail"><br><input type="password" placeholder="Password" name="lpassword"><br><input type="submit" value="Login" style="font-size: 1.5em;" name="login">';
    document.getElementById("create").innerHTML = html;
    document.getElementById("create").setAttribute('onsubmit', "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>");
    document.getElementById("gptxt").innerHTML = "Sign in with Google";
    document.getElementById("fbtxt").innerHTML = "Sign in with Facebook";
  }

  function upMode() {
    var html = '<input type="text" placeholder="First Name" style="width: 66px;" name="first" id="first">&nbsp;<input type="text" placeholder="Last Name" style="width: 63px;" name="last" id="last"><br><input type="email" placeholder="Email" name="email" id="email"><br><input type="password" placeholder="Password" name="p1" id="p1"><br><input type="password" placeholder="Repeat Password" name="p2" id="p2"><br><input type="submit" value="Sign Me Up!" style="font-size: 1.5em;" name="signup">';
    document.getElementById("create").innerHTML = html;
    document.getElementById("create").setAttribute('action', "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>");
    document.getElementById("gptxt").innerHTML = "Sign up with Google";
    document.getElementById("fbtxt").innerHTML = "Sign up with Facebook";
    //document.getElementById("upmode").setAttribute('href', '').setAttribute('onclick', '');
  }
  </script>
</head>
<body onload="qotd()">
  <div id="main" class="section">
    <blockquote id="qotd">
      <h2 id="quote"></h2>
      <p id="author"></p><br>
    </blockquote>
    <h1>Sign in to Collab.Center</h1>
    <!--<p id="error">Enter your email and passsword</p>
    <form id="create" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <input type="email" placeholder="Email" name="lemail"><br>
      <input type="password" placeholder="Password" name="lpassword"><br>
      <input type="submit" value="Login" style="font-size: 1.5em;" name="login">
    </form>-->
    <?php
    if (isset($_POST["signup"])) {
      $fname = $_POST["first"];
      $lname = $_POST["last"];
      $email = $_POST["email"];
      $password = $_POST["p1"];
      $rPassword = $_POST["p2"];

      if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        echo "<script>upMode();</script>";
        echo "<script>document.getElementById('email').setAttribute('style', 'border: 1px solid red;');document.getElementById('error').innerHTML = \"<span style='color: red;'>Email Is Not Valid!</span>\";</script>";
      } else if ($password != $rPassword || empty($password) || empty($rPassword)) {
        echo "<script>upMode();</script>";
        echo "<script>document.getElementById('p1').setAttribute('style', 'border: 1px solid red;');document.getElementById('p2').setAttribute('style', 'border: 1px solid red;');document.getElementById('error').innerHTML = '<span style=\"color: red;\">Passwords Do Not Match!</span>';</script>";
      } else if (empty($fname) || empty($lname) || strpos($fname, "'") !== FALSE || strpos($lname, "'") !== FALSE) {
        echo "<script>upMode();</script>";
        echo "<script>document.getElementById('first').setAttribute('style', 'border: 1px solid red;');document.getElementById('last').setAttribute('style', 'border: 1px solid red;');document.getElementById('error').innerHTML = '<span style=\"color: red;\">Name Cannot Be Blank or Contain Special Characters!</span>';</script>";
      } else {
        //Everything's correct
        echo "<script>auth.createUser('".$email."', '".$password."', function(error, user) {if (!error) {
          console.log('User Id: ' + user.uid + ', Email: ' + user.email);
          var newuserbase = new Firebase('https://collab-coding-login.firebaseio.com');
          newuserbase.child(user.uid).child('first').set('".$fname."');
          newuserbase.child(user.uid).child('last').set('".$lname."');
        }else{console.log(error);
          if (error.code == 'EMAIL_TAKEN') {
            document.getElementById('email').setAttribute('style', 'border: 1px solid red;');
            document.getElementById('error').innerHTML = '<span style=\"color: red;\">Email In Use!</span>';
          }
        }});</script>";
      }
    }

    if (isset($_POST["login"])) {
      $email = $_POST["lemail"];
      $password = $_POST["lpassword"];

      echo "<script>auth.login('password',{email: '".$email."',password: '".$password."',rememberMe: true });</script>";
    }
    ?>
    <br>
    <!--<p><a href="#" onclick="inMode()" id="inmode">Sign In</a> - <a href="#" onclick="upMode()" id="upmode">Sign Up</a></p>
    <p>Or,</p>-->
    <fieldset>
      <legend>Please use one of these third-party services</legend>
      <br/>
      <div id="google" class="button" onclick="google()">
        <span class="icon"></span>
        <span class="btntxt" id="gptxt">Sign in with Google</span>
      </div><br><br>
      <div id="facebook" class="button" onclick="facebook()">
        <span class="icon"></span>
        <span class="btntxt" id="fbtxt">Sign in with Facebook</span>
      </div>
      &nbsp;
      <div id="twitter" class="button" onclick="twitter()">
        <span class="icon"></span>
        <span class="btntxt" id="twtxt">Sign in with Twitter</span>
      </div>
      <br/><br/>
      <footer style="position:initial;"><a href="javascript:void(0);" style="cursor:help;" onclick="alert('In order to fix many reported bugs and improve security, we have temporarily taken away email/password logins. We are working on fixing all bugs related to it, and it should be back up in no-time!')">What happened to email/password?</a></footer>
    </fieldset>
    <br/>
  </span>
</div>
<div id="logout"></div>
</body>
</html>
