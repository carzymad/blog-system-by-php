<html>
<head>
<style>

a:link {
	color: black;
	text-decoration: none;
}
a:visited {
	color: black;
	text-decoration: none;
}
a:hover {
	color: red;
}
</style>
</head>
<body>
<?php
session_start();
$icon = mysql_connect("127.0.0.1", "root", "*********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");
$command = "select * from blog;";
$result = mysql_query($command, $icon);
while ($row = mysql_fetch_array($result)) {
	$id = $row['id'];
	echo "<a href=\"show.php?id=$id\" target='_blank'>" . $row['title'] . "</a> <br />";
}
mysql_close($icon);
?>
test
</body>
</html>
