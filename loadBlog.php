<?php
$page = $_GET['page'];
$amount = $_GET['amount'];
$begin = ($page-1)*$amount;

$icon = mysql_connect("127.0.0.1", "root", "r13858251304");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");
$command = "select * from blog order by id desc limit ".$begin.",".$amount;
$result = mysql_query("select count(*) from blog;", $icon);
$count = mysql_fetch_array($result)[0];
$result = mysql_query($command, $icon);
$output = array($count);
while ($row = mysql_fetch_array($result)) {
	$output[] = array('id'=>$row['id'], 'title'=>$row['title']);
	//echo json_encode($test);
}
echo json_encode($output);
mysql_close($icon);

?>

