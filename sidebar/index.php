<!-- Damn, that fish... -->
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://ricostacruz.com/jquery.transit/jquery.transit.min.js"></script>
	<style>
		html {
			width: 100%;
			height: 100%;
		}

		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 400;
			src: local('Montserrat-Regular'), url(http://fonts.gstatic.com/s/montserrat/v5/a86E68pmIj0EJimMSgdgN_esZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
		}

		body {
			color: white;
			text-align: center;
			font-family: 'Montserrat', Arial;
		}

		a {
			text-decoration: none;
			font-weight: bold;
			font-size: 1.5em;
			width: 100%;
			padding-top: 4px;
			padding-bottom: 4px;
			display: block;
			color: white;
		}

		h1 {
			font-size: 40px;
		}

		a:hover {
			background-color: rgb(61, 18, 107); 
		}

		hr {
			margin: 0;
			border-style: solid;
		}

		.select-arrow {
			display: inline-block;
			position: absolute;
			margin: .9em 0 0 -1.55em;
			border-left: 8px solid transparent;
			border-right: 8px solid transparent;
			border-top: 8px solid white;
		}

		#docsarrow {
			right: 30px; margin: 9px 25px; border-left: 13px solid transparent; border-right: 13px solid transparent; border-top: 13px solid white;
		}
	</style>
</head>
<body>
	<h1>Collab.Center</h1>
	<hr/>
	<a href="http://collab.center">HOME</a>
	<hr/>
	<a href="http://collab.center/upgrade">UPGRADE</a>
	<hr/>
	<a href="http://collab.center/updates">NEWS &amp; CRAP</a>
	<hr/>
	<a href="http://collab.center/support">SUPPORT!</a>
	<hr/>
	<a href="javascript:void(0);" id="mydocs" onclick="showDocs()">MY DOCS<span class="select-arrow" id="docsarrow"></a>
	<hr/>
	<nav id="docs">
		<?php

			########################
			# Function Definitions #
			########################

		function is_dir_empty($dir) {
			if (!is_readable($dir)) return NULL; 
			$handle = opendir($dir);
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					return FALSE;
				}
			}
			return TRUE;
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

		$file = '*';
		$dir = '../' . $_COOKIE['email'] . '/';

		$sorted_array = array();

		if (file_exists('../' . $_COOKIE['email']) && is_dir('../' . $_COOKIE['email']) && !is_dir_empty('../' . $_COOKIE['email'])) {
			$sorted_array = listdir_by_date($dir.$file);
		}

			######################
			#  End Function Defs #
			######################

		if (file_exists('../' . $_COOKIE['email']) && is_dir('../' . $_COOKIE['email']) && !is_dir_empty('../' . $_COOKIE['email'])) {
			foreach (array_reverse($sorted_array) as $entry) {
				if (file_exists('../' . $_COOKIE["email"] . "/$entry/name.php")) {
					INCLUDE '../' . $_COOKIE["email"] . "/$entry/name.php"; 

					$newPadName = str_replace('˙', '.', $padName);
					$entry2 = str_replace(".","-",$entry);

					echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'><span class='" . (!empty($template) && $template == true ? 'template' : 'doc') . "'></span>$newPadName &nbsp;&nbsp;&nbsp; " . date('F d Y H:i:s', filectime('../' . $_COOKIE['email'] . "/$entry")) . "<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'><img src='edit.png' onclick=\"return ren('$entry2')\" class='$entry2'><img src='gear.png' onclick=\" return edit('$entry')\" class='$entry2'></a>";
					$template = null;

					echo '<script>';
					echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
					echo '</script>';
				} else {
					$entry2 = str_replace(".","-",$entry);
					echo '<a href="../' . $_COOKIE["email"] . "/$entry\" class='$entry2'><span class='doc'></span>$entry<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'></a>";
									//echo '<a href="javascript:void(0)" style="color: black; font-size: smaller;"><strong>NOTE:</strong> This document was created before 7/10/14 and document-specific settings are not supported (Rename, etc.)';

					echo "<script>";
					echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
					echo "</script>";
				}
			}
		} else {
			echo "<a href='javascript:void(0);'>Hm, Looks like you don't have any documents. <u>Why not create one?</u></a><hr/>";
		}

		if (empty($_COOKIE['email'])) {
			echo "<script>$('#docs').html('<a href=\'../docs/signin/signin.php\'>Please <u>sign in</u> to view your documents</a><hr>')</script>";
		}
		?>
	</nav>
	<script>
		var degrees = 0;
		var show = false;
		function showDocs() {
			degrees = degrees + 180;
			$("#docsarrow").transition({ rotate: degrees + 'deg'});

			show = !show;
			if (show) {
				$('#docs').animate({height: 0, opacity: 0}, 'slow', function() {
					$('#docs').hide();
				});
			} else {
				$('#docs').animate({height: 100, opacity: 100}, 'slow');
				$('#docs').show();
			}
		}

		$("a").attr('target', '_parent');
	</script>
</body>
</html>