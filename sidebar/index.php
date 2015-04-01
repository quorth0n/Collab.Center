<!-- Hot damn, that fish... -->
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../cdn/jquery.transit.js"></script>
	<script src="../docs/tools/Cookies.js"></script>
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
			background-color: rgb(47, 8, 1);
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
			background-color: rgb(24, 8, 1);
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
			transform: rotate(180deg);
			right: 30px; margin: 9px 25px; border-left: 13px solid transparent; border-right: 13px solid transparent; border-top: 13px solid white;
		}
	</style>
</head>
<body>
	<h1>Collab.Center</h1>
	<hr/>
	<a href="http://collab.center/">HOME</a>
	<hr/>
	<div id="user_signedout" style="display: none;">
		<a href="../signin/" style="box-sizing:border-box;width: 50%; display: inline-block; border-right: 1px solid white;">SIGN IN</a><a href="../signup/" style="box-sizing:border-box;width: 50%; display: inline-block; border-left: 1px solid white;">SIGN UP</a>
	</div>
	<div id="user_signedin" style="display: none;">
		<a href="javascript:void(0);" style="box-sizing:border-box;width: 40%; display: inline-block; border-right: 1px solid white; text-transform: uppercase;">john</a><a href="../signin/?mode=out" style="box-sizing:border-box;width: 60%; display: inline-block; border-left: 1px solid white;">SIGN OUT</a>
	</div>
	<hr/>
	<a href="../upgrade/">UPGRADE</a>
	<hr/>
	<a href="../news/">NEWS &amp; CRAP</a>
	<hr/>
	<a href="../support/">SUPPORT!</a>
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
		$dir = '../docs/' . $_COOKIE['email'] . '/';

		$sorted_array = array();

		if (file_exists('../docs/' . $_COOKIE['email']) && is_dir('../docs/' . $_COOKIE['email']) && !is_dir_empty('../docs/' . $_COOKIE['email'])) {
			$sorted_array = listdir_by_date($dir.$file);
		}

			######################
			#  End Function Defs #
			######################
		if ($_GET['olddocs'] == 'true') {
			if (file_exists('../docs/' . $_COOKIE['email']) && is_dir('../docs/' . $_COOKIE['email']) && !is_dir_empty('../docs/' . $_COOKIE['email'])) {
				foreach (array_reverse($sorted_array) as $entry) {
					if (file_exists('../docs/' . $_COOKIE["email"] . "/$entry/name.php")) {
						INCLUDE '../docs/' . $_COOKIE["email"] . "/$entry/name.php";

						$newPadName = str_replace('˙', '.', $padName);
						$entry2 = str_replace(".","-",$entry);

						echo "<a href='../docs/" . $_COOKIE["email"] . "/$entry' class='$entry2'><span class='" . (!empty($template) && $template == true ? 'template' : 'doc') . "'></span>$newPadName <br/> " . date('F d Y H:i:s', filectime('../docs/' . $_COOKIE['email'] . "/$entry")) . "</a><hr/>";
						$template = null;

						echo '<script>';
						echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
						echo '</script>';
					} else {
						$entry2 = str_replace(".","-",$entry);
						echo '<a href="../docs/' . $_COOKIE["email"] . "/$entry\" class='$entry2'><span class='doc'></span>$entry<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'></a>";
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
		}
		?>

		<a href="javascript:void(0);" id="odocs_btn" title="Hint: You can copy-paste text from old documents into new ones to keep them up-to-date!">err: no query specified</a>
		<hr/>
	</nav>
	<script>

		// FUNCTION DEFS

		function urlp(paramName)
		{
		    var sURL = window.document.URL.toString();
		    if (sURL.indexOf("?") > 0)
		    {
		        var arrParams = sURL.split("?");
		        var arrURLParams = arrParams[1].split("&");
		        var arrParamNames = new Array(arrURLParams.length);
		        var arrParamValues = new Array(arrURLParams.length);

		        var i = 0;
		        for (i = 0; i<arrURLParams.length; i++)
		        {
		            var sParam =  arrURLParams[i].split("=");
		            arrParamNames[i] = sParam[0];
		            if (sParam[1] != "")
		                arrParamValues[i] = unescape(sParam[1]);
		            else
		                arrParamValues[i] = "No Value";
		        }

		        for (i=0; i<arrURLParams.length; i++)
		        {
		            if (arrParamNames[i] == paramName)
		            {
		                //alert("Parameter:" + arrParamValues[i]);
		                return arrParamValues[i];
		            }
		        }
		        return null;
		    }
		}

		//END FUNCTION DEFS

		//Check URL Vars
		if (urlp('olddocs') == 'true') {
			document.getElementById('odocs_btn').innerHTML = "Show Up-To-Date Documents";
			document.getElementById('odocs_btn').setAttribute('onclick', 'parent.changeUrl(document.URL.split("?")[0]+"?olddocs=false");');
		} else if (urlp('olddocs') == 'false') {
			document.getElementById('odocs_btn').innerHTML = "Show Outdated Documents";
			document.getElementById('odocs_btn').setAttribute('onclick', 'parent.changeUrl(document.URL.split("?")[0]+"?olddocs=true");');
		}

		if (Cookies.get('name') != null) {
			$('#user_signedin').attr('style', 'display: inherit;');
		} else {
			$('#user_signedout').attr('style', 'display: inherit;');
		}

		//Doc-Arrow Rotation-ness
		var degrees = 180;
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
