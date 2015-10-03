<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Collab.Center -- Embed Mode</title>
  <!--jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Firebase -->
  <script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
  <!-- CodeMirror -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.css" />
  <link rel="stylesheet" href="../../tools/CodeMirror/theme/mdn-like.css" />
  <script src="../../tools/CodeMirror/addon/mode/loadmode.js"></script>
  <script src="../../tools/CodeMirror/addon/edit/matchbrackets.js"></script>
  <script src="../../tools/CodeMirror/addon/edit/closebrackets.js"></script>
  <script src="../../tools/CodeMirror/addon/search/search.js"></script>
  <script src="../../tools/CodeMirror/addon/search/searchcursor.js"></script>
  <script src="../../tools/CodeMirror/addon/dialog/dialog.js"></script>
  <link rel="stylesheet" href="../../tools/CodeMirror/addon/dialog/dialog.css" />
  <script src="../../tools/CodeMirror/keymap/sublime.js"></script>
  <!-- Firepad -->
  <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.2.0/firepad.css" />
  <script src="https://cdn.firebase.com/libs/firepad/1.2.0/firepad.min.js"></script>

  <style>
  @font-face {
  	font-family: 'actionman';
  	src: url('../../actionman.ttf');
  }

  .firepad {
    width: 100%;
    height: 100%;
    position: initial !important;
  }

  html {
    margin:0;
  }

  .powered-by-firepad {
    font-family: 'actionman';
    font-size: auto;
    background-image: none !important;
    text-decoration: none;
    color: rgba(0, 83, 159, 0.65);
    bottom: 10px;
    height: initial;
    width: initial;
  }
  </style>

</head>
<body>

  <div id="firepad"></div>
  <script>
  CodeMirror.modeURL = "../../tools/CodeMirror/mode/%N/%N.js";
  var userId = Math.floor(Math.random() * 9999999999).toString();
  var firepadRef = new Firebase('https://collaborative-coding.firebaseio.com').child('<? echo $_GET['padid']; ?>');
  var codeMirrorFirepad = CodeMirror(document.getElementById('firepad'), { lineWrapping: true, lineNumbers : true, theme : 'mdn-like', matchBrackets : true, autoCloseBrackets : true});
  codeMirrorInst = codeMirrorFirepad;
  var firepad = Firepad.fromCodeMirror(firepadRef, codeMirrorFirepad, {userId: userId});
  firepadInst = firepad;;

  firepad.on('ready', function() {
    $('.powered-by-firepad').text('Collab.Center');
    $('.powered-by-firepad').attr('href', 'http://Collab.Center');
    codeMirrorInst.on("change", function(cm, change) {
      //$('#templateForm').attr('action', document.URL + '?tempTxt=' + firepadInst.getText());
      var docTxt;// = new Firebase('https://collab-doc-props.firebaseio.com/').child(padId);

      if (Cookies.get('uid') != undefined) {
        docTxt = new Firebase("https://collab-doc-props.firebaseio.com/").child(Cookies.get('uid')).child(padId);
      } else {
        docTxt = new Firebase("https://collab-doc-props.firebaseio.com/").child(padId);
      }

      docTxt.child('document').set(firepad.getText());

      docTxt.child('lmdate').set("" + new Date());
    });

    //200-line code limit
    codeMirrorInst.on("beforeChange", function(cm, change) {
      console.log(change.text);
      if (change.text && change.text.length > 1) {
        if (parseInt($('.CodeMirror-linenumber').last().text()) >= 200) {
          alert('You have reached the maximum line count (200) for anonymous users. Please log in to continue editing this document (Among other benefits).');
          change.cancel();
        }
      }
    });
    //}

    if (firepad.isHistoryEmpty()) {
      firepad.setHtml("/*Hello, and Welcome to Collab.Center! This is how it works:<br> 1. Put some code here.<br> 2. Share the URL with your friends so you can collaborate (Hint: Use the Mail icon in the top-right!).<br> 3. Toggle some options above.<br> That's all there is to it!*/");
    }

    var langBaseVal = "<? echo $_GET['lang']; ?>"
    if (langBaseVal != "c" && langBaseVal != "c++" && langBaseVal != "c#" && langBaseVal != "java" && langBaseVal != "f#" && langBaseVal != "ocaml") {
      $('#langOption').text('Language (' + langBaseVal + ')');

      codeMirrorFirepad.setOption("mode", langBaseVal);
      CodeMirror.autoLoadMode(codeMirrorFirepad, langBaseVal);
    } else {
      $('#langOption').text('Language (' + langBaseVal + ')');

      codeMirrorFirepad.setOption("mode", "mllike");
      CodeMirror.autoLoadMode(codeMirrorFirepad, "mllike");

      codeMirrorFirepad.setOption("mode", "clike");
      CodeMirror.autoLoadMode(codeMirrorFirepad, "clike");
      switch (langBaseVal)
      {
        case "c":
        codeMirrorFirepad.setOption("mode", "text/x-csrc");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-csrc");
        break;
        case "c++":
        codeMirrorFirepad.setOption("mode", "text/x-c++src");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-c++src");
        break;
        case "c#":
        codeMirrorFirepad.setOption("mode", "text/x-csharp");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-csharp");
        break;
        case "java":
        codeMirrorFirepad.setOption("mode", "text/x-java");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-java");
        break;
        case "f#":
        codeMirrorFirepad.setOption("mode", "text/x-fsharp");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-fsharp");
        case "ocaml":
        codeMirrorFirepad.setOption("mode", "text/x-ocaml");
        CodeMirror.autoLoadMode(codeMirrorFirepad, "text/x-ocaml");
      }
    }

    var firebaseUserName = new Firebase("https://collaborative-coding.firebaseio.com/" + padId + "/users/" + userId);

    if (Cookies.get('name') != undefined) {
      firebaseUserName.child('name').set(Cookies.get('name') + ' [Embed Mode]');
    } else {
      firebaseUserName.child('name').set('Guest ' + userId + ' [Embed Mode]');
    }
  });
  </script>

</body>
</html>
