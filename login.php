<?php
header('Content-type: text/html; charset=utf8');
session_start();
$name = $_POST['name'];
$password = $_POST['psw'];
$code = $_POST['code'];
$session_code = strtolower($_SESSION['verify_code']);
$icon = mysql_connect("127.0.0.1", "root", "**********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website", $icon);
$command = "select * from user where binary name='$name'";
$result = mysql_query($command, $icon);
$row = mysql_fetch_array($result);
if ($code != $session_code) {
   echo "codeerror " . $code . " " . $session_code;
} elseif ($row['name'] == "") {
   echo "nouser";
   //echo "{result : false}"; 
} elseif ($password == $row['password']) {
   echo "true";
	$login = 'true';
	$_SESSION['login'] = true;
	if ($row['name'] == 'admin' || $row['admin']) {
		$_SESSION['admin_login'] = true;
	} else {
		$_SESSION['admin_login'] = false;
	}
	$_SESSION['user_id'] = $row['id'];
	//echo "{result : true}";
} else {
    echo "pswerror ";
}
mysql_close($icon);
?>
