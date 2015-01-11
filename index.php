<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script src="docs/tools/Cookies.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="dialog.js"></script>
	<link rel="icon" href="./docs/faviconold.ico" type="image/x-icon">
	<link rel="shortcut icon" href="./docs/faviconold.ico" type="image/x-icon">
	<link rel="stylesheet" href="docs/tools/style.css">
	<title>Collab.Center - Online, Collaborative Coding in Real-Time!</title>
	<style>
		body {
				padding-top: 70px;
		}

		div:not(#dialogs) {
			width: 600px;
			padding: 50px;
			border-radius: 1em;
			background-color: white;
			box-shadow: 1em;
			text-align: center;
		}

		div:not(#dialogs):not(.dialog) {
			margin: 5em auto;
		}

		span {
			color: red;
			font-weight: bold;
			display: inline;
		}

		sup {
			color: red;
			text-transform: uppercase;
			font-weight: normal;
			font-size: small;
		}

		footer {
			color: darkgray;
			position: relative;
			bottom: 0;
		}

		footer a {
			color: black;
		}

		p {
			text-align: center;
		}

		#topbanner {
			position: fixed;
			top: 0px;
			margin: auto !important;
			z-index: 1000000000000000000000;
			width: 100% !important;
			background-color: rgb(236, 236, 236) !important;
			padding: 5px !important;
			left: 0px;
			border-radius: 0px !important;
		}
	</style>
</head>
<body style="background-color: skyblue; font-family: Helvetica, Arial, sans-serif;position:inherit;overflow:hidden;">
	<div id="topbanner">
		<!-- LinkedIn -->
		<script src="//platform.linkedin.com/in.js" type="text/javascript">
		lang: en_US
		</script>
		<script type="IN/Share" data-url="collab.center" data-counter="top"></script>
		&nbsp;&nbsp;&nbsp;&nbsp;

		<!-- Flattr -->
		<script id="fbto2qc">(function(i){var f,s=document.getElementById(i);f=document.createElement("iframe");f.src="//api.flattr.com/button/view/?uid=poflynn&url="+encodeURIComponent(document.URL);f.title="Flattr";f.height=62;f.width=55;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})("fbto2qc");</script>
		&nbsp;&nbsp;&nbsp;&nbsp;

		<!-- Facebook -->
		<iframe src="http://www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Fcollabcentercoding&width=1&layout=box_count&action=like&show_faces=true&share=true&height=65&appId=330440663773880" style="border: 0; width:65px; height:65px;"></iframe>

		<!-- paypal -->
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display: inline; vertical-align: middle;">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
		">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - Donate" style="margin-bottom: 1.5%">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		<hr>
		<h4 style="display: inline;"><i>Help us keep Collab.Center ad-free! :)</i></h4>
	</div>
	<div id="google_ads_frame1" style="position: absolute; left: -999999999999999999999999999999999em;">adblock</div>

	<!--Dialogs-->
	<div id="dialogs" style="position: absolute; right: 10px; top: 140px;">
		<div id="welcomeD" style="display: none;">Welcome back, Anonymous, please <a href="docs/signin/signin.php">Sign in</a></div>
		<div id="noticeD" style="display: none;"><br>We just recently had an update that changes the way documents are handled. This effects all documents created before 7/10/14.
			When you go to manage your docs, you will get some error messages. To fix this, copy &amp; paste your code from the old document into a new document, and delete the old document.
			Thank you for your patience.
		</div>
		<div id="featuresD" style="display: none;"><h2>Features:</h2>
		<ul style="text-align: left;">
		<li>Real-Time Collaborative Coding in the Browser!</li>
		<li>Support for over 60 languages!</li>
		<li>Powerful Syntax Highlighting, and Many Other Useful Features (Auto-Closing Brackets, etc)!</li>
		<li>Make Your Documents Public On The Web, or Secure &amp; Private With Just A Few!<b>*</b></li>
		<li>Text or Webcam Chat With Your Peers!<b>*</b></li>
		<li>Neatly Manage All Of Your Documents<b>*</b></li>
		<li>Note: Anonymous users limited to 200 lines of code</li>
		</ul>
		<p><b>*</b> Requires Sign-In</div>
		<div id="w3cD" style="display: none;"><a id="w3cLink" target="_blank" style="color: #666;">HTML 5.0 Validated!</a></div>
		<div id="adblockD" style="display: none;"><br>Our website can only be hosted and running because of our ads. Please consider disabling your AdBlocker</div>

	</div>
	<a href="https://github.com/Mulletfingers999/Collab.Center" style="display: none;"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>	<div>
	<noscript>Your Browser Will Not Work With Collab.Center, or Most Sites. Please Upgrade Your Browser To A Modern One, Like <a href="http://holmes-browser.tumblr.com">Holmes</a> or <a href="https://www.google.com/chrome/">Google Chrome</a></noscript>
	<h1>Welcome to Collab.Center!<sup>Beta</sup></h1>
	<h2 id="collabcode"></h2>
	<p>Collab.center is an easy way to share collaborative coding docs or even plain text online! Just select a language and your ready to go!</p>
	<form method="post" id="create">
		<!--<label for="language">Language:&nbsp;</label>--><select name="language" id="language"><option id="lSelected" disabled selected>Select a Language</option>
		<option>Plain Text</option><option>apl</option><option>asterisk</option><option>c</option><option>c++</option><option>c#</option><option>clojure</option><option>cobol</option><option>coffeescript</option><option>commonlisp</option><option>css</option><option>d</option><option>diff</option><option>dtd</option><option>ecl</option><option>eiffel</option><option>erlang</option><option>f#</option><option>fortran</option><option>gas</option><option>gfm</option><option>gherkin</option><option>go</option><option>groovy</option><option>haml</option><option>haskell</option><option>haxe</option><option>htmlembedded</option><option>htmlmixed</option><option>http</option><option>jade</option><option>java</option><option>javascript</option><option>jinja2</option><option>julia</option><option>livescript</option><option>lua</option><option>markdown</option><option>mirc</option><option>nginx</option><option>ntriples</option><option>ocaml</option><option>octave</option><option>pascal</option><option>pegjs</option><option>perl</option><option>php</option><option>pig</option><option>properties</option><option>puppet</option><option>python</option><option>q</option><option>r</option><option>rpm</option><option>rst</option><option>ruby</option><option>rust</option><option>sass</option><option>scheme</option><option>shell</option><option>sieve</option><option>smalltalk</option><option>smarty</option><option>smartymixed</option><option>solr</option><option>sparql</option><option>sql</option><option>stex</option><option>tcl</option><option>tiddlywiki</option><option>tikiwiki</option><option>toml</option><option>turtle</option><option>vb</option><option>vbscript</option><option>velocity</option><option>verilog</option><option>xml</option><option>xquery</option><option>yaml</option><option>z80</option></select><span class="select-arrow"></span>
		<?php

		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}

		if (isset($_POST['Submit'])) {
			file_put_contents("./docCount.txt", (string)intval(file_get_contents("./docCount.txt")) + 1);

			if (isset($_POST['language'])) {
				$lang = $_POST['language'];

				$my_dir = "";
				$my_file = "";
				$randString = generateRandomString();

				if (isset($_COOKIE["email"])) {
					//Check if the user's email dir exists, if not create one
					if (!file_exists("docs/".$_COOKIE["email"])) {
						mkdir("docs/".$_COOKIE["email"]);
					}

					$my_dir = "docs/".$_COOKIE["email"]."/".$randString;
					$my_file = $my_dir."/index.php";

				} else {
					//User is not signed in, create in the dev directory
					$my_dir = "docs/dev/".$randString;
					$my_file = $my_dir."/index.php";
				}

				//Create the file + directory if it doesn't exist
				if (!file_exists($my_file)) {
					mkdir($my_dir);
					$handle = fopen($my_file, 'w');
				}

				//Write to the index (.php)
				$data = file_get_contents('./docs/tools/index.html', true);
				fwrite($handle, $data);

				//Create the id.js file
				$user_id_file = $my_dir."/id.js";
				$handle_user_id = fopen($user_id_file, 'w');
				fwrite($handle_user_id, "var padId = '".$randString."';");

				//Create the name.php file
				$user_name_file = $my_dir."/name.php";
				$handle_user_name = fopen($user_name_file, 'w');
				fwrite($handle_user_name, '<?php $padName = "'.$randString.'";?>');

				//redirect to the new document
				echo '<script>window.location.href="'.$my_dir.'?lang='.urlencode($lang).'";</script>';

			} else {
				$temp = $_POST['template'];

				$my_dir = "";
				$my_file = "";
				$randString = generateRandomString();

				if (isset($_COOKIE["email"])) {
					//Check if the user's email dir exists, if not create one
					if (!file_exists("docs/".$_COOKIE["email"])) {
						mkdir("docs/".$_COOKIE["email"]);
					}

					$my_dir = "docs/".$_COOKIE["email"]."/".$randString;
					$my_file = $my_dir."/index.php";

				} else {
					//User is not signed in, create a new directory
					$my_dir = "docs/dev/".$randString;
					$my_file = $my_dir."/index.php";
				}

				//Create the file + directory if it doesn't exist
				if (!file_exists($my_file)) {
					mkdir($my_dir);
					$handle = fopen($my_file, 'w');
				}

				//Write to the index (.php)
				$data = file_get_contents('./docs/tools/index.html', true);
				fwrite($handle, $data);

				//Create the id.js file
				$user_id_file = $my_dir."/id.js";
				$handle_user_id = fopen($user_id_file, 'w');
				fwrite($handle_user_id, "var padId = '".$randString."';");

				//Create the name.php file
				$user_name_file = $my_dir."/name.php";
				$handle_user_name = fopen($user_name_file, 'w');
				fwrite($handle_user_name, '<?php $padName = "'.$randString.'";?>');


				$handle = opendir('docs/' . $_COOKIE['email'] . '/');
				    while (false !== ($entry = readdir($handle))) {
				        if ($entry != "." && $entry != "..") {
				            INCLUDE 'docs/' . $_COOKIE['email'] . "/$entry/name.php";

				            if (!empty($template) && !empty($padName) && $template == true && str_replace('˙', '.', $padName) == $temp) {
				            	INCLUDE 'docs/' . $_COOKIE['email'] . "/$entry/name.php";
				            	//redirect to the new document, with a ?txt query string
								echo '<script>window.location.href="'.$my_dir.'?lang=javascript'.urlencode($lang).'&template='.urlencode($id).'";</script>';
				            }
				        }
				    }
				closedir($handle);
				//redirect to the new document, with a ?txt query string
				//echo '<script>window.location.href="'.$my_dir.'?lang='.urlencode($lang).'&txt=";</script>';

			}
		}
		?>
		<br><br>
		<select name="template" id="template"><option id="tSelected" disabled selected>Or, You Can Select a Template</option>
			<?php
			$file = '*';
			$dir = 'docs/' . $_COOKIE['email'] . '/';

			$sorted_array = array();

				if (file_exists('docs/' . $_COOKIE['email']) && is_dir('docs/' . $_COOKIE['email'])) {
					$sorted_array = listdir_by_date($dir.$file);
				}

				function listdir_by_date($pathtosearch)
				{
					foreach (glob($pathtosearch) as $filename)
					{
						$file_array[filectime($filename)]=basename($filename);
					}

					ksort($file_array);
					return $file_array;
				}


			if (file_exists('docs/' . $_COOKIE['email']) && is_dir('docs/' . $_COOKIE['email'])) {
				foreach (array_reverse($sorted_array) as $entry) {
					if (file_exists('docs/' . $_COOKIE["email"] . "/$entry/name.php")) {
						INCLUDE 'docs/' . $_COOKIE["email"] . "/$entry/name.php";

						$newPadName = str_replace('˙', '.', $padName);
						$entry2 = str_replace(".","-",$entry);
						echo (!empty($template) && $template == true ? "<option>$newPadName</option>" : '');
						$template = null;
					}
				}
			}

			?>
		</select><span class="select-arrow"></span>
		<br><br>
		<input type="submit" value="Create Doc!" style="font-size: 1.5em;" name="Submit" id="submit" disabled>
	</form>
	<h3 style="display: none;">So far, Collab.Center has created <?php echo  file_get_contents('docCount.txt', true);?> docs for people like you!</h3>
</div>
<footer><p>Copyright (c) 2014, Liam O'Flynn. All rights reserved. <a href="./terms#terms">Privacy Policy &amp; Terms of Use</a>, Updated 7/12/2014</p></footer>
<script>
	$('#language').change(function () {
		$('#submit').removeAttr('disabled');
		$('#template').attr('disabled', 'disabled');
		$('#tSelected').attr('selected', 'selected');
	});

	$('#template').change(function () {
		$('#submit').removeAttr('disabled');
		$('#language').attr('disabled', 'disabled');
		$('#lSelected').attr('selected', 'selected');
	});

	dialog("w3cD", 'w3cvalidhtml.gif', '604800');
	//dialog("noticeD", 'notice.png', '604800');
	dialog("featuresD", 'none', '604800');
	dialog("shareD", 'none', '604800');

	if($("#google_ads_frame1").css('display')=="none")
	{
        //dialog('adblockD', 'noadblock.png', 'never');//.html("We noticed you have an active Ad Blocker. Example.com is ad funded, we promise our ads are of high quality and are unobtrusive. The best help you could provide to keep us running, is to whitelist us in your ad blocker. Thanks!");
    }
    else
    {
    	$("#adblockD").hide();
    }

    if (Cookies.get('name') != undefined) {
    	$("#welcomeD").html("Welcome Back, " + Cookies.get('name') + '<br> <a href="docs/signin/signin.php?mode=out">Sign out</a> | <a href="docs/manage/manage.php?tab=docs">Manage docs</a>');
    	dialog('welcomeD', 'none', 'never');
    } else {
    	dialog('welcomeD', 'none', 'never');
    }

		//w3c validator href
		$("#w3cLink").attr('href', 'http://validator.w3.org/check?uri=' + document.URL);
</script>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=9847367;
var sc_invisible=1;
var sc_security="8d165f65";
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<!-- End of StatCounter Code for Default Guide -->
</body>
</html>
