<!--
:S
The fish is missing...
-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Collab.Center</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="docs/tools/Cookies.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>
	<link href="./cdn/style.css" rel="stylesheet" />
	<style>
	#ifie {
		position: relative;
		top: 0px;
		color: white;
		text-align: center;
		background-color: red;
		font-family: Arial;
		padding: 5px;
		cursor: pointer;
	}
	</style>
</head>
<body>
	<!--[if IE]>
	<div id="ifie" onclick="$(this).hide()">
		Your browser is extremely out of date. Please use a more modern one to continue using Collab.Center, such as <a href="http://chrome.google.com/">Google Chrome</a>. It will not work without it. Thank you!
	</div>
	<![endif]-->
	<div id="main" class="section">
		<h1 style="/*margin-top: 0px;*/">C<img src="./cdn/1.1.gif" title='Collab.Center "Amsterdam"'>llab.C<img src="./cdn/1.1.gif" title='Collab.Center "Amsterdam"'>nter</h1>
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

			function format(item) {
				var originalOption = item.element;
				var originalText = item.text;
				return "<span style='font-family: Arial;'>" + originalText + "</span>";
			}
			$('#language').select2({
				/*allowClear: true,*/
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function(m) { return m; }
			});


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


			//Child iFrame Function
			function changeUrl(url) {
				$('iframe').attr('src', url);
			}
		</script>

		<footer>
			<a href="http://collab.center">Collab.Center</a>, V1.1 Copyright (c) 2015, Liam O'Flynn &amp; Eternity Incurakai. All Rights Reserved.
			<br/>
			<a href="javascript:void(0)" onclick="$('#contact').html('<iframe class=\'contact\' src=\'./contact\' style=\'border-radius: 1em; border: 0px; display: block; margin: 0px auto; background-color: white;\'>Err: ./contact not found. try again later.</iframe>')">Contact us</a> &#124; <a href="./terms/" target="_blank">Privacy Policy &amp; Terms of Use</a>
			<span id="contact"></span>
		</footer>
	</body>
</html>
