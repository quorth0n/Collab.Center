<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="docs/favicon.ico">
  <link rel="stylesheet" href="../tools/style.css">
  <script src="../tools/Cookies.js"></script>
  <title>Sign In - Collab.Center</title>
  <style>
    div#content {
      width: 600px;
      margin: 5em auto;
      padding: 50px;
      border-radius: 1em;
      background-color: white;
      box-shadow: 1em;
      text-align: center;
    }

    span {
      color: red;
      font-weight: bold;
      display: inline;
    }
  </style>
  <!-- Place this asynchronous JavaScript just before your </body> tag -->
  <script type="text/javascript">
    (function() {
     var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
     po.src = 'https://apis.google.com/js/client:plusone.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
   })();
  </script>
  <script>

  /**
     * Global variables to hold the profile and email data.
     */
     var profile, email;

    /*
     * Triggered when the user accepts the sign in, cancels, or closes the
     * authorization dialog.
     */
    function loginFinishedCallback(authResult) {
      if (getParameterByName('mode') == "out") {
            document.getElementById('logout').innerHTML = '<iframe id="logoutframe" src="https://accounts.google.com/logout" style="display: none;"></iframe>';
            Cookies.clear('email',{path   : '/'});
            Cookies.clear('name',{path   : '/'});
            alert("You have been successfully signed out.");
      } else {
        if (authResult) {
          if (authResult['error'] == undefined){
            //toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
            gapi.client.load('plus','v1', signIn);  // Trigger request to get the email address.

          } else {
            console.log('An error occurred');
          }
        } else {
          console.log('Empty authResult');  // Something went wrong
        }
      }
    }

    /**
     * Uses the JavaScript API to request the user's profile, which includes
     * their basic information. When the plus.profile.emails.read scope is
     * requested, the response will also include the user's primary email address
     * and any other email addresses that the user made public.
     */
    function signIn(){
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute(signInCallback);
    }

    /**
     * Callback for the asynchronous request to the people.get method. The profile
     * and email are set to global variables. Triggers the user's basic profile
     * to display when called.
     */
    function signInCallback(obj) {
      profile = obj;

      // Filter the emails object to find the user's primary account, which might
      // not always be the first in the array. The filter() method supports IE9+.
      email = obj['emails'].filter(function(v) {
          return v.type === 'account'; // Filter out the primary email
      })[0].value; // get the email from the filtered results, should always be defined.
      displayProfile(profile);
    }

    /**
     * Display the user's basic profile information from the profile object.
     */
    function displayProfile(profile){
      /*alert(profile['displayName']);
      //document.getElementById('pic').innerHTML = '<img src="' + profile['image']['url'] + '" />';
      alert(email);*/

      alert('Welcome ' + profile['displayName'] + ", you have succesfully signed in.");
      Cookies.set('name', profile['displayName'], {path : '/'});
      Cookies.set('email', email , {path: '/'});
      //if (getParameterByName('mode') != "out") {
        window.history.back();
        window.close();
      //}
    }

    function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
    </script>
</head>
<body style="background-color: lightgray; font-family: Helvetica, Arial, sans-serif;">
  <div id="content">
    <h1>Sign in to Collab.Center</h1>
    <p>Enter your email and passsword</p>
    <form method="post" id="create">
      <input type="email" placeholder="Email">
      <input type="password" placeholder="Password">
      <input type="submit" value="Login" style="font-size: 1.5em;" name="Submit">
    </form>
    <p>Or,</p>
    <span id="signin-button">
      <span
        class="g-signin"
        data-callback="loginFinishedCallback"
        data-clientid="1028947543008-ft295kt00v0gg4n77rcusb0694jo4fjt.apps.googleusercontent.com"
        data-cookiepolicy="single_host_origin"
        data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
        data-theme="dark">
      </span>
    </span>
  </div>
  <div id="logout"></div>
</body>
</html>