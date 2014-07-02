//code.stephenmorley.org
var Cookies={set:function(b,c,a){b=[encodeURIComponent(b)+"="+encodeURIComponent(c)];a&&("expiry"in a&&("number"==typeof a.expiry&&(a.expiry=new Date(1E3*a.expiry+ +new Date)),b.push("expires="+a.expiry.toGMTString())),"domain"in a&&b.push("domain="+a.domain),"path"in a&&b.push("path="+a.path),"secure"in a&&a.secure&&b.push("secure"));document.cookie=b.join("; ")},get:function(b,c){for(var a=[],e=document.cookie.split(/; */),d=0;d<e.length;d++){var f=e[d].split("=");f[0]==encodeURIComponent(b)&&a.push(decodeURIComponent(f[1].replace(/\+/g,"%20")))}return c?a:a[0]},clear:function(b,c){c||(c={});c.expiry=-86400;this.set(b,"",c)}};

/**
Dialog.Js, Copyright, (c) 2014 by Liam O'Flynn
*/
var dialogs = 0;
var previous = "";


function dialog(id, icon, closefor) {

	if (Cookies.get(id + 'closed') != "closed") {
		dialogs = dialogs + 1;
		
		if (icon != "none") {
			$("#" + id.toString()).html('<div style="position: relative;text-align: right;top: -16px;right:10px;width:auto;height:auto;margin:0;padding:0;background:0;cursor:pointer;" onclick="$(\'#' + id + '\').hide();Cookies.set(\'' + id + 'closed\', \'closed\', {expiry : ' + closefor + '})">X</div><img src="'+ icon + '" style="vertical-align:middle;cursor: pointer;"/>&nbsp;&nbsp;&nbsp;<span class="txt">' + $("#" + id.toString()).html()) + '</span>';
		} else {
			$("#" + id.toString()).html('<div style="position: relative;text-align: right;top: -16px;right:10px;width:auto;height:auto;margin:0;padding:0;background:0;cursor:pointer;" onclick="$(\'#' + id + '\').hide();Cookies.set(\'' + id + 'closed\', \'closed\', {expiry : ' + closefor + '})">X</div><span class="txt">' + $("#" + id.toString()).html()) + '</span>';
		}

		$("#" + id.toString()).attr('style', 'background-color: #fff;border: 1px solid #E5E5E5;color: #666;font-size: 13px;padding: 0;padding-bottom: 20px;padding-top: 20px;z-index: 986;width: 250px;');
		$(".txt").attr('style', 'font-size: 100%;color: #666;font-weight:bold;');

	} else {
		$("#" + id.toString()).hide();
		$("#" + id.toString()).html("The user has closed this dialog");
	}

}