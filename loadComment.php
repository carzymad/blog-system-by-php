<?php
$article_id = $_GET['id'];			// 需要查询的文章的id号

$icon = mysql_connect("127.0.0.1", "root", "**********");
mysql_query("SET NAMES 'UTF8';", $icon);
mysql_query("SET CHARACTER SET 'UTF8';", $icon);
mysql_query("SET CHARACTER_SET_RESULTS='UTF8';", $icon);
mysql_query("use website");
	
$result = mysql_query("select * from comment where article_id=$article_id", $icon);		// 将从属这篇文章的所有评论都查询出来
$return = array();
while ($row = mysql_fetch_array($result)) {
	$return[] = array('id'=>$row['id'], 'from_user'=>$row['from_user'], 'to_user'=>$row['to_user'], "reply"=>$row['reply'], "text"=>$row["text"], "public"=>$row['public']);
}
echo json_encode($return);

mysql_close($icon);
?>
