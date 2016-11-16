<?php
$file = fopen("article/test.txt", "w") or die("Can not open the file");
//fwrite($file, "test");
//fclose($file);
$icon = true;
?>
<?php
$icon = mysql_connect("127.0.0.1", "root", "*********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website", $icon);
$command = "select * from blog where id=1001";
$result = mysql_query($command, $icon);
$row = mysql_fetch_array($result);
echo $row[0];
?>

