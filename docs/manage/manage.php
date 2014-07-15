<!DOCTYPE html>
<html>
<head>
	<title>Manage - Collab.Center</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src='https://cdn.firebase.com/js/client/1.0.17/firebase.js'></script>
	<link rel="stylesheet" href="../tools/style.css" />
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
    			return null;
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

			switch (getURLParameters("sort")) {
				case 'name':
					$("option").prop('selected', 'false');
					$("option[value=1]").attr('selected', 'selected');
					break;

				case 'datec':
					$("option").prop('selected', 'false');
					$("option[value=2]").attr('selected', 'selected');
					break;
			}

			$("#sort").change(function () {
				var sort = $("#sort option:selected").text().toLowerCase();
				//alert(sort)
				switch (sort) {
					case "sort by name":
						window.location.replace("?sort=name");
						break;
					case "sort by date created":
						window.location.replace("?sort=datec");
						break;
					case "sort by date modified":
						window.location.replace("?sort=datem");
						break;
				}
			});

			if (getURLParameters("sort") == null && getURLParameters("tab") != "account") {
				window.location.replace("?sort=datec")
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
			var langBase = new Firebase("https://collab-coding-lang.firebaseio.com").child(doc);

			langBase.child("lang").once('value', function(snapshot) {
				if (snapshot.val() != undefined) {
					var fileext = {"Plain Text" : "txt", "apl" : "apl", "asterisk" : "conf", "c" : "c", "c++" : "cc", "c#" : "cs", "clojure" : "clj", "cobol" : "cob", "coffeescript" : "coffee", "commonlisp" : "lisp", "css" : "css", "d" : "d", "diff" : "diff", "dtd" : "dtd", "ecl" : "ecl", "eiffel" : "e", "erlang" : "erl", "fortran" : "f", "gas" : "s", "gfm" : "gfm", "gherkin" : "feature", "go" : "go", "groovy" : "groovy", "haml" : "haml", "haskell" : "hs", "haxe" : "hx", "htmlembedded" : "html", "htmlmixed" : "html", "http" : "none", "jade" : "jade", "java" : "java", "javascript" : "js", "jinja2" : "py", "julia" : "jl", "livescript" : "ls", "lua" : "lua", "markdown" : "md", "mirc" : "mrc", "f#" : "fs", "ocaml" : "ml", "nginx" : "conf", "ntriples" : "nt", "octave" : "m", "pascal" : "pas", "pegjs" : "pegjs", "perl" : "pl", "php" : "php", "pig" : "pig", "properties" : "properties", "puppet" : "pp", "python" : "py", "q" : "q", "r" : "r", "rpm" : "rpm", "rst" : "rst", "ruby" : "rb", "rust" : "rs", "sass" : "scss", "scheme" : "scm", "shell" : "none", "sieve" : "none", "smalltalk" : "st", "smarty" : "tpl", "smartymixed" : "tpl", "solr" : "none", "sparql" : "sparql", "sql" : "sql", "stex" : "tex", "tcl" : "tcl", "tiddlywiki" : "none", "tikiwiki" : "none", "toml" : "toml", "turtle" : "ttl", "vb" : "vb", "vbscript" : "vbs", "velocity" : "vm", "verilog" : "v", "xml" : "xml", "xquery" : "xq", "yaml" : "yaml", "z80" : "z80"};

					var renameto = prompt('Enter a new name for the document (Do not include file extension):' , 'UntitledDoc');
					window.location.replace('../' + '<?php echo $_COOKIE["email"]?>' + "/" + doc + "?renameto=" + renameto + "." + fileext[snapshot.val()]);
				} else {
					alert('Error. Code: LANGBASE_CHILD_UNDEFINED');
				}
			});

			return false;
		}

		function edit(doc) {
			window.location.replace('../' + '<?php echo $_COOKIE["email"]?>' + "/" + doc + "/?edit=edit");

			return false;
		}
        
        /*function sortNav(ul, sortDescending) {
          if(typeof ul == "string")
            ul = document.getElementById(ul);

          var lis = ul.getElementsByTagName("a");
          var vals = [];

          for(var i = 0, l = lis.length; i < l; i++)
            vals.push(lis[i].innerHTML);

          vals.sort();

          if(sortDescending)
            vals.reverse();

          for(var i = 0, l = lis.length; i < l; i++)
            lis[i].innerHTML = vals[i];
        }*/
        
        /*window.onload = function() {
          var desc = false;
          document.getElementById("test").onclick = function() {
            sortUnorderedList("list", desc);
            desc = !desc;
            return false;
          }
        }*/

        /*$("select").change(function () {
        	switch ($("#sort").text().toLowerCase()) {
        		case "sort by name":
        			sortNav("docsNav", false);
        			break;
        	}
        }).change();*/
		
	</script>
</head>
<body>
	<div id="sidebar">
		<nav>
			<a href="?tab=account">Account</a>
			<a href="?tab=docs&sort=datec">Documents</a>
		</nav>
	</div>
	<div id="account">
		<h1>Loading...</h1>
	</div>
	<div id="documents">
		<h1>Documents</h1>
		<nav id="docsNav">
			<select id="sort">
				<option value="1">Sort by name</option>
				<option value="2">Sort by date created</option>
				<!--<option value="3">Sort by date modified</option>-->
			</select> <span class="select-arrow"></span>
			<?php 
				$file = '*';
				$dir = '../' . $_COOKIE['email'] . '/';

				$sorted_array = array();
				$sorted_name_files = array();

				if (file_exists('../' . $_COOKIE['email']) && is_dir('../' . $_COOKIE['email'])) {
					$sorted_array = listdir_by_date($dir.$file);
					$sorted_name_files = listdir_by_name($dir);
				}

				function listdir_by_date($pathtosearch)
				{
					foreach (glob($pathtosearch) as $filename)
					{
						$file_array[filectime($filename)]=basename($filename); // or just $filename
					}

					ksort($file_array);
					return $file_array;
				}

				function listdir_by_name($pathtosearch) {
					$files = array();
					$dir = opendir($pathtosearch); // open the cwd..also do an err check.
					while(false != ($file = readdir($dir))) {
					        if(($file != ".") and ($file != "..") and ($file != "index.php")) {					      
					                if (file_exists('../' . $_COOKIE["email"] . "/$file/name.php")) {
					                	INCLUDE '../' . $_COOKIE["email"] . "/$file/name.php"; 
					                	$files[] = str_replace('˙', '.', $padName);

					                } else {
					                	 $files[] = $file; // put in array.
					                	 //echo $file;
					                }
					        }   
					}
					
					sort($files); // sort.
					// print.
					/*foreach($files as $file) {
					        echo("<a href='$file'>$file</a> <br />\n");
					}*/
					return $files;
				}

				if (file_exists('../' . $_COOKIE['email']) && is_dir('../' . $_COOKIE['email'])) {
					if ($_GET["sort"] == "datec") {
						foreach (array_reverse($sorted_array) as $entry) {
							if (file_exists('../' . $_COOKIE["email"] . "/$entry/name.php")) {
								INCLUDE '../' . $_COOKIE["email"] . "/$entry/name.php"; 

								$newPadName = str_replace('˙', '.', $padName);
								$entry2 = str_replace(".","-",$entry);
								echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'>$newPadName &nbsp;&nbsp;&nbsp; " . date('F d Y H:i:s', filectime('../' . $_COOKIE['email'] . "/$entry")) . "<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'><img src='edit.png' onclick=\"return ren('$entry2')\" class='$entry2'><img src='gear.png' onclick=\" return edit('$entry')\" class='$entry2'></a>";

								echo "<script>";
								echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
								echo "</script>";
							} else {
								$entry2 = str_replace(".","-",$entry);
								echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'>$entry<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'></a>";
								echo '<a href="javascript:void(0)" style="color: black; font-size: smaller;"><strong>NOTE:</strong> This document was created before 7/10/14 and document-specific settings are not supported (Rename, etc.)';

								echo "<script>";
								echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
								echo "</script>";
							}
						}
					} elseif ($_GET["sort"] == "name") {
						foreach ($sorted_name_files as $entry) {
							if (file_exists('../' . $_COOKIE["email"] . "/$entry/name.php")) {
								INCLUDE '../' . $_COOKIE["email"] . "/$entry/name.php"; 

								$newPadName = str_replace('˙', '.', $padName);
								$entry2 = str_replace(".","-",$entry);
								echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'>$newPadName<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'><img src='edit.png' onclick=\"return ren('$entry2')\" class='$entry2'><img src='gear.png' onclick=\" return edit('$entry')\" class='$entry2'></a>";

								echo "<script>";
								echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
								echo "</script>";
							} else {
								$entry2 = str_replace(".","-",$entry);
								echo "<a href='../" . $_COOKIE["email"] . "/$entry' class='$entry2'>$entry<img src='delete.png' onclick=\"return del('$entry')\" class='$entry2'></a>";
								echo '<a href="javascript:void(0)" style="color: black; font-size: smaller;"><strong>NOTE:</strong> This document was created before 7/10/14 and document-specific settings are not supported (Rename, etc.)';

								echo "<script>";
								echo '$("a.' . $entry2 . '").hover(function () {$("img.' . $entry2 .'").attr("style", "display: inline;")}, function () {$("img.' . $entry2 .'").hide()});';
								echo "</script>";
							}
						}
					}
				} else {
					echo "<br /><h1>No Documents Here!</h1>";
				}
			?>
		</nav>
	</div>
	<?php
		if (empty($_COOKIE["email"])) {
			echo '<script>$("body").html(\'<h1 style="text-align: center; font-family: Arial;">Please <a href="../../docs/signin/signin.php">Sign In</a> To View This Page!</h1>\');</script>';
		}
	?>
</body>
</html>