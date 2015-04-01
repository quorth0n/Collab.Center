<!--
:S
The fish is missing...
-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>0.5 -- CC Beta</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="docs/tools/Cookies.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>
	<style>
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 400;
			src: local('Montserrat-Regular'), url(http://fonts.gstatic.com/s/montserrat/v5/a86E68pmIj0EJimMSgdgN_esZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
		}

		#main {
			margin: 5em;
			paddding-top: 0px;
		}

		a {
			color: white;
		}

		div.section {
			background: transparent;
			font-family: 'Montserrat', Arial;
			color: white;
			text-align: center;
			font-weight: lighter;
			font-size: 20px;
			border: 5px solid white;
			border-radius: 15px;
		}

		h1 {
			font-size: 40px;
		}

		hr {
			border-style: solid;
		}

		html {
		  background: url(img/bg.jpg) no-repeat center center fixed;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}

		sup {
			color: blue;
		}

		select {
			background-color: transparent;
			border: 4px solid white;
			color: white;
			-webkit-appearance: button;
			-moz-appearance: none;
			appearance: button;
			display: inline-block;
			padding: 6px 30px 6px 15px;
			font-family: 'Montserrat', Arial;
			font-size: 15px;
			cursor: pointer;
		}

		option {
			background-color: rgb(80, 23, 140);
		}

		button, input[type=submit] {
			display: inline-block;
			padding: 6px 30px 6px;
			font-family: 'Montserrat', Arial;
			font-size: 15px;
			cursor: pointer;
			background-color: transparent;
			border: 4px solid white;
			color: white;
		}

		.select-arrow {
			display: inline-block;
			position: absolute;
			margin: .9em 0 0 -1.55em;
			border-left: 8px solid transparent;
			border-right: 8px solid transparent;
			border-top: 8px solid white;
		}

		#toggle {
			background-color: aquamarine;
			padding: 2px 5px;
			cursor: pointer;
			position: fixed;
			top : 40%;
			left: 0px;
			color: white;
			border-radius: 0px 10px 10px 0px;
		}

		#sidebar {
			position: fixed;
			left: -16.5em;
			top: 0px;
			width: 25%;
			height: 99%;
			border-radius: 0px;
			background-color: rgb(80, 23, 140);
		}

		footer {
			text-align: center;
			font-size: 10px;
			color: white;
			position: relative;
			top: -50px;
		}
	</style>
</head>
<body>
	<div id="main" class="section">
		<h1 style="margin-top: 0px;">C<img src="./cdn/1.0.gif" style="position:relative;top:23px;" title='Collab.Center "Holland": The Easter Update!'>llab.C<img src="./cdn/1.0.gif" style="position:relative;top:23px;" title='Collab.Center "Holland": The Easter Update!'>nter</h1>
		<hr/>
		<p>Collab.Center is an easy way to share collaborative coding docs or even plain text online! Just select a language and your ready to go!</p>
		<hr/>
		<br/>
		<select name="language" id="language">
			<optgroup label="Template Documents">
				<option disabled>Documents based on code you've already written:</option>
				<option>Template Doc A</option>
				<option>Template Doc B</option>
			</optgroup>
			<optgroup label="New Document">
				<option disabled>Select a language for your document:</option>
				<option>Plain Text</option><option>Rich Text</option><option>apl</option><option>asterisk</option><option>c</option><option>c++</option><option>c#</option><option>clojure</option><option>cobol</option><option>coffeescript</option><option>commonlisp</option><option>css</option><option>d</option><option>diff</option><option>dtd</option><option>ecl</option><option>eiffel</option><option>erlang</option><option>f#</option><option>fortran</option><option>gas</option><option>gfm</option><option>gherkin</option><option>go</option><option>groovy</option><option>haml</option><option>haskell</option><option>haxe</option><option>htmlembedded</option><option>htmlmixed</option><option>http</option><option>jade</option><option>java</option><option>javascript</option><option>jinja2</option><option>julia</option><option>livescript</option><option>lua</option><option>markdown</option><option>mirc</option><option>nginx</option><option>ntriples</option><option>ocaml</option><option>octave</option><option>pascal</option><option>pegjs</option><option>perl</option><option>php</option><option>pig</option><option>properties</option><option>puppet</option><option>python</option><option>q</option><option>r</option><option>rpm</option><option>rst</option><option>ruby</option><option>rust</option><option>sass</option><option>scheme</option><option>shell</option><option>sieve</option><option>smalltalk</option><option>smarty</option><option>smartymixed</option><option>solr</option><option>sparql</option><option>sql</option><option>stex</option><option>tcl</option><option>tiddlywiki</option><option>tikiwiki</option><option>toml</option><option>turtle</option><option>vb</option><option>vbscript</option><option>velocity</option><option>verilog</option><option>xml</option><option>xquery</option><option>yaml</option><option>z80</option></select><span class="select-arrow"></span>
			</optgroup>
		<!--<p>Or</p>
		<select name="template" id="template">
			<option id="tSelected" disabled="" selected="">Select a Template</option>
		</select><span class="select-arrow"></span>-->
		</select>
		<br/>
		<br/>
		<hr/>
		<button id="create">Create Doc!</button>
		<br><br>
	</div>
		<div id="sidebar" class="section">
			<iframe style="border: 0; width: 100%; height: 100%;" src="./sidebar/?olddocs=false">ERR: Your browser does not support <code>iframes</code></iframe>
		</div>
		<div id="toggle">
			&#9679;<br>
			&#9679;<br>
			&#9679;<br>
		</div>
		<script>
			$("#toggle").toggle(
				function () {
					$("#sidebar").animate({left: 0});
					$("#toggle").animate({left: '25.8%'});
				}, function () {
					$("#sidebar").animate({left: '-16.5em'});
					$("#toggle").animate({left: 0});
				}
			);

			$("#language").select2();

			$("#create").click(function () {
				var loc = "./create";
				var selected = $(':selected', "#language");
				if (selected.closest('optgroup').attr('label') == "New Document") {
					loc = loc + "?doclang=" + selected.text();
				} else {
					loc = loc + "?templatename=" + selected.text();
				}
				window.location.href=loc;
			});

			$(document).on('ready', function() {
    			$('.select2-search__field').attr('value', 'Search');
					$('#select2-language-container').html('Create a Document, or a Template');
			});

			//Child iFrame Function
			function changeUrl(url) {
				$('iframe').attr('src', url);
			}
		</script>

		<footer>
			<a href="http://collab.center">Collab.Center</a>, V1.0 Dev Preview. Copyright (c) 2015, Liam O'Flynn &amp; Eternity Incurakai. All Rights Reserved.
		</footer>
	</body>
</html>
