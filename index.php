<!DOCTYPE html>
<html>
<head>
	<script src="docs/tools/Cookies.js"></script>
	<link rel="icon" href="/docs/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/docs/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="docs/tools/style.css">
	<title>Collab.Center</title>
	<style>
		div {
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

		sup {
			color: red;
			text-transform: uppercase;
			font-weight: normal;
			font-size: small;
		}
	</style>
</head>
<body style="background-color: lightgray; font-family: Helvetica, Arial, sans-serif;">
<a href="https://github.com/Mulletfingers999/Collab.Center" style="display: none;"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>	<div>
		<h1>Welcome to Collab.Center!<sup>Alpha</sup></h1>
		<p>Collab.center is an easy way to share collaborative coding docs or even plain text online! Just select a language and your ready to go!</p>
		<form method="post" id="create">
			<label for="language">Language:&nbsp;</label><select name="language">
				<option selected>Plain Text</option><option>apl</option><option>asterisk</option><option>c</option><option>c++</option><option>c#</option><option>clojure</option><option>cobol</option><option>coffeescript</option><option>commonlisp</option><option>css</option><option>d</option><option>diff</option><option>dtd</option><option>ecl</option><option>eiffel</option><option>erlang</option><option>fortran</option><option>gas</option><option>gfm</option><option>gherkin</option><option>go</option><option>groovy</option><option>haml</option><option>haskell</option><option>haxe</option><option>htmlembedded</option><option>htmlmixed</option><option>http</option><option>jade</option><option>java</option><option>javascript</option><option>jinja2</option><option>julia</option><option>livescript</option><option>lua</option><option>markdown</option><option>mirc</option><option>mllike</option><option>nginx</option><option>ntriples</option><option>octave</option><option>pascal</option><option>pegjs</option><option>perl</option><option>php</option><option>pig</option><option>properties</option><option>puppet</option><option>python</option><option>q</option><option>r</option><option>rpm</option><option>rst</option><option>ruby</option><option>rust</option><option>sass</option><option>scheme</option><option>shell</option><option>sieve</option><option>smalltalk</option><option>smarty</option><option>smartymixed</option><option>solr</option><option>sparql</option><option>sql</option><option>stex</option><option>tcl</option><option>tiddlywiki</option><option>tiki</option><option>toml</option><option>turtle</option><option>vb</option><option>vbscript</option><option>velocity</option><option>verilog</option><option>xml</option><option>xquery</option><option>yaml</option><option>z80</option></select><span class="select-arrow"></span>
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
							$lang = $_POST['language'];

							if ($lang != '') {
								$my_dir = "";
								$my_file = "";
								
								if (isset($_COOKIE["email"])) {

									//Check if the user's email dir exists, if not create
									if (!file_exists("docs/".$_COOKIE["email"])) {
										mkdir("docs/".$_COOKIE["email"]);
									}

									$my_dir = "docs/".$_COOKIE["email"]."/".generateRandomString();
									$my_file = $my_dir."/index.php";

								} else {
									$my_dir = "docs/dev/".generateRandomString();
									$my_file = $my_dir."/index.php";
								}

								if (!file_exists($my_file)) {
									mkdir($my_dir);
									$handle = fopen($my_file, 'w');
								}

								$data = file_get_contents('./docs/tools/index.html', true);
								fwrite($handle, $data);	

								echo '<script>window.location.href="'.$my_dir.'?lang='.$lang.'";</script>';

							} else {
								echo "<br><span>Please select a language, that's why its there.</span>";
							}
						}
					?>
			<br><br>
			<input type="submit" value="Create Doc!" style="font-size: 1.5em;" name="Submit">
		</form>
	</div>
</body>
</html>