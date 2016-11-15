
<?php
$amount = $_GET['amount'];
//echo $amount;

$icon = mysql_connect("127.0.0.1", "root", "**********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");
$command = "select * from board order by id desc limit 0, $amount";
$result = mysql_query("select count(*) from board;", $icon);
$count = mysql_fetch_array($result)[0];
$result = mysql_query($command, $icon);
//$output = array($count);
while ($row = mysql_fetch_array($result)) {
	$output[] = array('title'=>$row['title'], 'content'=>$row['content']);
	//echo json_encode($test);
}
echo json_encode($output);
mysql_close($icon);

?>

