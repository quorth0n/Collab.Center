myFirebase.on('value', function(snapshot) {
	if (snapshot.val() != null) {
					//Do privacy stuff
					//alert(pemail); 
					/*alert(owner);
					alert(isPrivate)
					alert(Cookies.get('email'));*/
					if (isPrivate == true) {
						if (pemial == Cookies.get('email') || owner == Cookies.get('email') && Cookies.get('email') != "") {
							$("html").html("");
						} else {
							$("html").html("<body style='text-align: center;'><h1>Sorry, but You Need Permission to Edit this Document</h1><h3>If you believe this is an error, please contact the owner of the document</h3><h4>Wanna switch accounts? <a href='../../signin/signin.php?mode=out' target='_new'>Click here</a></h4><img src='../../logo.png' style='position: absolute; right: 0px; bottom: 0px;'></body>");
						}
					}
				}
			});