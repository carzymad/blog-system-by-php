<?php
header('Content-type: text/html; charset=utf8');
session_start();
if (!$_SESSION['login']) {
	echo "false";
} else {
	$name = $_POST['name'];
	$password = $_POST['psw'];
	$code = $_POST['code'];
	$session_code = strtolower($_SESSION['verify_code']);
	$icon = mysql_connect("127.0.0.1", "root", "r13858251304");
	mysql_query("SET NAMES 'UTF8';", $icon);
	mysql_query("SET CHARACTER SET 'UTF8';", $icon);
	mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
	mysql_query("use website", $icon);

	$title = $_POST['title'];
	$text = $_POST['text'];
	$abstra = $_POST['abstract_'];
	mysql_query("insert into blog (title) values('$title')", $icon);
	$result = mysql_query("select * from blog order by id desc limit 1;", $icon);
	$row = mysql_fetch_array($result);
	$id = $row['id'];
	$file = fopen("article/$id", "w");
	fwrite($file, $text);
	fclose($file);
	$file = fopen("article/$id.abs", "w");
	fwrite($file, $abstra);
	fclose($file);
	
	mysql_close($icon);
}

?>
