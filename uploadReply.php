<?php
session_start();
if (!$_SESSION['login']) {
	echo "not login";
} else {
	$text = $_POST['text'];
	$article_id = $_POST['articleid'];
	$from_user = $_SESSION['user_id'];
	$to_user = $_POST['to_user'];
	$reply = $_POST['reply'];
	
	$icon = mysql_connect("127.0.0.1", "root", "**********");
	mysql_query("SET NAMES 'UTF8';", $icon);
	mysql_query("SET CHARACTER SET 'UTF8';", $icon);
	mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
	mysql_query("use website", $icon);
	$command = "insert into comment (from_user, to_user, reply, text, article_id, public) values($from_user, $to_user, $reply, '$text', $article_id, '".date("y-m-d", time())."')";
	mysql_query($command, $icon);
	
	//echo "success $text $article_id $from_user $to_user $reply";
	echo $command;
}
?>

