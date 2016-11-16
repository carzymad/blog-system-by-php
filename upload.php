<?php
header('Content-type: text/html; charset=utf8');
session_start();
if (!$_SESSION['login']) {
	echo "false";
} else if($_POST['delete_id'] != "") {
	$id = $_POST['delete_id'];
	$icon = mysql_connect("127.0.0.1", "root", "*********");
	mysql_query("use website", $icon);
	$result = mysql_query("delete from blog where id=$id;", $icon);
	$row = mysql_fetch_row($result);
	//echo $row[0];
	echo "test";
	mysql_close($icon);
} else {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$password = $_POST['psw'];
	$code = $_POST['code'];
	$session_code = strtolower($_SESSION['verify_code']);
	$icon = mysql_connect("127.0.0.1", "root", "r13858251304");
	mysql_query("SET NAMES 'UTF8';", $icon);
	mysql_query("SET CHARACTER SET 'UTF8';", $icon);
	mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
	mysql_query("use website", $icon);
	
	$result = mysql_query("select * from blog where id=$id;", $icon);
	$row = mysql_fetch_array($result);
	$title = $_POST['title'];
	$text = $_POST['text'];
	$abstra = $_POST['abstract_'];
	if (mysql_num_rows($result) == 0) {				// 查询无该文章id时，判断为添加新文章
		mysql_query("insert into blog (title) values('$title')", $icon);
		$result = mysql_query("select * from blog order by id desc limit 1;", $icon);
		$row = mysql_fetch_array($result);
		$id = $row['id'];
		$date = date("y-m-d", time());
		mysql_query("update blog set modify_date='$date' where id=$id;", $icon);	// 修改最后修改时间
		mysql_query("update blog set public_date='$date' where id=$id;", $icon);	// 修改最后修改时间
	} else {						// 查询出来有该文章id时，判断为修改文章
		mysql_query("update blog set title='$title' where id=$id;", $icon);		// 更新文章的标题
		$date = date("y-m-d", time());
		mysql_query("update blog set modify_date='$date' where id=$id;", $icon);	// 修改最后修改时间
	}
	$file = fopen("article/$id", "w");
	fwrite($file, $text);
	fclose($file);
	$file = fopen("article/$id.abs", "w");
	fwrite($file, $abstra);
	fclose($file);
	
	mysql_close($icon);
	echo $id;
}

?>
