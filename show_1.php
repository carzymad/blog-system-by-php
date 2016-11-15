<?php
$id = $_GET['id'];
$icon = mysql_connect("localhost", "root", "**********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");
$command = "select * from blog where id=$id;";
$result = mysql_query($command, $icon);
$row = mysql_fetch_array($result);
$title = $row['title'];
mysql_close($icon);

echo "<html>\n";
echo "<meta content=\"text/html; charset=utf-8\">\n";
echo "<title>$title</title>\n";
echo "<head>\n";
echo "</head>\n";
echo "<body>\n";
header("Content-Type:text/html;charset=utf-8");
echo "<div style='margin-left:100px; margin-right:100px;'>\n";
$filename = "article/" . $id;
//echo $filename . "<br />";
$a = file($filename);
foreach($a as $line => $content) {
	//echo 'line' . ($line+1) . ":" . $content . "<br />";
	if ($line == 0)
		echo "<div style='text-align: center;'><h2>\n" . $content . "</h2></div>\n<pre style='font-size: 17px;white-space: -moz-pre-wrap; white-space: pre-wrap;white-space: -pre-wrap;'></div>\n<div>";
	else {
		echo $content;
	}
}
echo "</div></pre>\n";
echo "</div>\n";
//echo fread($file, filesize("article/$id"));
fclose($file);
//phpinfo();
echo "</pre>\n";
echo "</body>\n";
echo "</html>\n";
?>

