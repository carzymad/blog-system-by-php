<?php
$id = $_GET['user_id'];
$type = $_GET['type_'];

$icon = mysql_connect("127.0.0.1", "root", "**********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");

if ($type == 1) {
	$result = mysql_query("select * from user where id=$id", $icon);
	$row = mysql_fetch_array($result);
	$return = array('from_user'=>$id, 'name'=>$row['name'], 'head'=>$row['head']);
	echo json_encode($return);
}
mysql_close($icon);

?>
