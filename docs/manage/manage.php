<!DOCTYPE html>
<html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<style>
		nav {
			height: 100%;
			width: 175px;
			color: #404040;
		}

		nav:not(#docsNav) {
			position: absolute;
			left: 0;
			top: 0;
			background: #ebebeb;
			background: -moz-linear-gradient(left, #ebebeb 0%, #eaeaea 93%, #d9d9d9 100%);
			background: -webkit-gradient(linear, left top, right top, color-stop(0%,#ebebeb), color-stop(93%,#eaeaea), color-stop(100%,#d9d9d9));
			background: -webkit-linear-gradient(left, #ebebeb 0%,#eaeaea 93%,#d9d9d9 100%);
			background: -o-linear-gradient(left, #ebebeb 0%,#eaeaea 93%,#d9d9d9 100%);
			background: -ms-linear-gradient(left, #ebebeb 0%,#eaeaea 93%,#d9d9d9 100%);
			background: linear-gradient(to right, #ebebeb 0%,#eaeaea 93%,#d9d9d9 100%);
		}

		#docsNav {
			position: absolute;
			left: 0;
			background: #ebebeb;
			width: 100%;
			max-height: 100%;
			overflow-y: scroll;
			height: 87.2%;
		}

		nav a {
			display: block;
			padding: 10px;
			font-size: 1.5em;
			color: darkgray;
			text-decoration: none;
		}

		nav a:hover {
			background: darkgray;
			color: white;
		}

		div:not(#sidebar) {
			position: absolute;
			left: 175px;
			top: 0;
			padding: 15px;
			background:	whitesmoke;
			width: 83.8%;
			height: 100%;
		}

		body {
			font-family: Arial;
			overflow: hidden;
		}

		img {
			position: absolute;
			padding-bottom: 4px;
			display: none;
		}

		img[src="gear.png"] {
			right: 0px;
		}

		img[src="delete.png"] {
			right: 19px;
		}

		img[src="edit.png"] {
			right: 38px;
		}
	</style>
	<script>
		function getURLParameters(paramName) 
		{
			var sURL = window.document.URL.toString();  
			if (sURL.indexOf("?") > 0)
			{
				var arrParams = sURL.split("?");         
				var arrURLParams = arrParams[1].split("&");      
				var arrParamNames = new Array(arrURLParams.length);
				var arrParamValues = new Array(arrURLParams.length);     
				var i = 0;
				for (i=0;i<arrURLParams.length;i++)
				{
					var sParam =  arrURLParams[i].split("=");
					arrParamNames[i] = sParam[0];
					if (sParam[1] != "")
						arrParamValues[i] = unescape(sParam[1]);
					else
						arrParamValues[i] = "No Value";
				}

				for (i=0;i<arrURLParams.length;i++)
				{
					if(arrParamNames[i] == paramName){
		            //alert("Param:"+arrParamValues[i]);
		            return arrParamValues[i];
		        	}
    			}
    			return "No Parameters Found";
			}		
		}

		$(document).ready(function () {
			//$("div:not(#sidebar)").height($("nav:not(#docsNav)").height());

			switch (getURLParameters("tab")) {
				case 'account':
					$("div:not(#account):not(#sidebar)").hide();
					$("#account").show();
					break;

				case 'docs':
					$("div:not(#documents):not(#sidebar)").hide();
					$("#documents").show();
					break;
			}
		});

		function del(doc) {
			var del = confirm('Are you sure you\'d like to delete ' + doc + '?');
			if (del == true) {
				window.location.replace('../' + '<?php echo $_COOKIE["email"]?>' + "/" + doc + "?delete=delete");
			}

			return false;
		}

		function ren(doc) {
			var renameto = prompt('Enter a new name for the document (Do not include file extension):' , 'UntitledDoc');
			window.location.replace('../' + '<?php echo $_COOKIE["email"]?>' + "/" + doc + "/?renameto=" + renameto + doc.split('.')[1]);

			return false;
		}

		function edit(doc) {
			window.location.replace('../' + '<?php echo $_COOKIE["email"]?>' + "/" + doc + "/?edit=edit");

			return false;
		}
	</script>
</head>
<body>
	<div id="sidebar">
		<nav>
			<a href="?tab=account">Account</a>
			<a href="?tab=docs">Documents</a>
		</nav>
	</div>
	<div id="account">
		<h1>Loading...</h1>
	</div>
	<div id="documents">
		<h1>Documents</h1>
		<nav id="docsNav">
			<?php
				if ($handle = opendir('../' . $_COOKIE["email"])) {

				    while (false !== ($entry = readdir($handle))) {
				    	if ($entry != "." && $entry != "..") {
				    		$entry2 = str_replace(".","-",$entry);
				    		echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'>$entry<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'><img src='edit.png' onclick=\"ren('$entry2');\" class='$entry2'><img src='gear.png' onclick=\"edit('$entry')\" class='$entry2'></a>";

				    		echo "<script>";
				    		echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
				    		echo "</script>";
				    	}
				    }

				    closedir($handle);
				}
			?>
		</nav>
	</div>
	<?php
		if (empty($_COOKIE["email"])) {
			echo '<script>$("body").html(\'<h1 style="text-align: center; font-family: Arial;">Please <a href="../../signin/signin.php">Sign In</a> To View This Page!</h1>\');</script>';
		} else {
			echo "test";
		}
	?>
</body>
</html>