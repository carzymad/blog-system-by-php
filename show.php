<html>

<title>
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
echo $row['title'];
?>
</title>
<head>
<link rel="stylesheet" type="text/css" href="css/blog.css">
<link rel="stylesheet" type="text/css" href="css/model.css">
<link rel="shortcut icon" type="image/x-icon" href="images/blog.icon">
<?php
echo "<script>var article_id = $id; </script>";
?>
<script src="js/jquery.js"></script>
<script src="js/model.js"></script>
<script src="js/markdown-parse.js"></script>
<script src="js/blog.js"></script>
<script src="js/show.js"></script>
<script>
$(function(){
	$("#submitreply").click(function(){
		alert("回复");
	})
})
</script>
</head>

<body style="background-image: url('images/body-bg.jpg')">

<div class="main" style=" margin-left: 100px; margin-right: 100px;">
    <h1 style="margin-bottom: 0px;"><a id="model-open" style="color: #009999; ">CRAZY_MAD</a></h1>
    <p style="font-size: 15px; color: gray; margin-top: 5px; margin-bottom: 40px;">为coding而生，为coding而疯狂</p>
    <hr class="blog-hr" style=""/>
        <table class="nav-bar">
            <tr id="nav-bar-row01">
                <td style="width: 100px;">
                    <a href="index.php" class="index-a"><strong>首页</strong></a>
                </td>
                <td style="width: 100px;">
                    <a href="curse.html" class="sub-a">课程表</a>
                </td>
                <td style="width: 100px;">
                    <a href="http://115.159.154.139/chat" class="sub-a">聊天室</a>
                </td>
                <td style="width: 150px;">
                    <a href="markdown.php" class="sub-a">markdown-parse</a>
                </td>
					 <?php
						session_start();
						if ($_SESSION['admin_login']) {
							echo "<td style='width: 100px;'><a id='write-blog' class='sub-a' href='newblog.php'>写博客</a></td>";
						}
					 ?>
            </tr>
        </table>
	<hr class="blog-hr"/>
	<center><h1 style="margin-bottom: 0px;">
<?php
echo $row['title'];
$title = $row['title'];
?>
	</h1><p style="font-size:15px; color: gray;">
<?php
echo "发表于:".$row['public_date']."&nbsp;&nbsp;最后编辑于:".$row['modify_date'];
?></p></center>

<script>
	var lines = [];
	$(function(){
		var url_ = "article/" + <?php echo$row['id']; ?>;
		var result = $.ajax({url: url_, async:false});
		lines = result.responseText.split(/\n/g);
		//alert(lines);
		var n = lines.length;
		for (var i = 0; i < n; i++) {
			$("#show").append(parse(lines[i]));
		}
	})
</script>
	<div class="row100">
		<div style="padding: 10px 10px 10px 60px;" id="show">
		</div>
		<div style="paddomg: 10px 10px 10px 10px;" id="admin">
<?php
session_start();
if ($_SESSION['admin_login']) {
	echo "
<div style='padding-left: 60px; margin-top: 10px;'>
<form action='newblog.php' style='float:left;' type='post'>
	<input hidden style='border: 0px;' class='btn' name='id' value='$id' type='text'/>
	<input hidden style='border: 0px;' class='btn' name='title' value='$title' type='text'/>
	<input style='border: 0px;' class='btn' value='编辑' type='submit'/>
</form> <input id='delete' class='btn' style='float: left; margin-left: 10px;' value='删除' type='submit'/>
<div style='clear: both;'></div>
</div>
";
}
?>
		</div>
		<div style="padding: 10px 60px 10px 60px; margin-top: 60px;">
			<div class="row100" style="border: 1px solid #C9C9C9; border-radius: 3px;">
				<div style="padding: 10px 10px 10px 10px;" id="comment">
					<p style="font-size: 15px; margin-top: 5px; margin-bottom: 5px;"><a id="write-comment">发表评论</a></p>
					<div id="div-write-comment" hidden="hidden" style="margin-bottom: 10px;">
						<textarea id="new-comment" style="width: 500px; height: 100px; border-radius: 3px;">
						</textarea><br />
						<input id="submit-comment" value="提交" type="submit" class="btn" style="margin-top: 10px;">
					</div>
					<hr class="blog-hr" style="margin-top: 0px; margin-bottom: 20px;"/>
				</div>
			</div>
		</div>
<?php
echo "
<script>
$(function(){
	$.ajax({
		type : \"GET\",
		url : \"loadComment.php\",
		data : {
			id : $id
		},
		error : function() {
			alert(\"failed\");
		},
		success : function(data) {
			//alert(data);
			var arr = eval(data);
			showComment(arr);
		}
	})
})
</script>";
?>
	</div>

	<hr class="blog-hr" style="margin-top: 100px; margin-bottom: 30px;"/>
	<center>
   <?php 
       echo "<p style='font-size: 17px; margin: 5px 0 5px 0'>Copyright © 2016-" . date("Y") . " by crazymad</p>\n";
	?>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>mail: crazy_mad01@163.com or 2116913961@qq.com</p>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>NBUT CS-154</p>
	</center>
</div>
    <div class="model-data" id="model-data" style="background: -webkit-gradient(linear, 0 0, 20% 0%, from(#FFF), to(#FaFaFa));">
        <div class="closeIcon" id="model-close">
            <img style="width:20px; height: 20px;" src="images/close.png">
        </div><div class="clear"></div>
        <div style="text-align:center; margin-top:-20px;"><h2>登录</h2></div>
        <form method="get">
            <div class="row25 align-right input-label-middle">账号&nbsp;</div>
            <div class="row75 align-left">
                <input id="login-name" class="input-middle" type="text" name="name" />
            </div> <div class="clear"></div>
            <div class="row25">&nbsp;</div><div id="test" class="row75"><font size="2">&nbsp;</font></div>
            <br><br>
            <div class="row25 align-right input-label-middle">密码&nbsp;</div>
            <div class="row75 align-left">
                <input id="login-psw" class="input-middle" type="password" name="password"/>
            </div> <div style="" class="clear"></div>
            <div class="row25">&nbsp;</div><div class="row75"><font size="2">&nbsp;</font></div>
            <br><br>
            <div class="row25 align-right input-label-middle">验证码&nbsp;</div>
            <div class="row25 align-left" style="">
                <input id="login-verify" class="input-middle" style="width:70px;" type="text" name="verify_code" />
            </div> 
            <div class="row50" style="">
                <img width="100px" height="40px" src="" id="code" /> 
            </div> <div class="clear"></div>
            <div class="row25">&nbsp;</div><div class="row25"><font size="2">&nbsp;</font></div>
            <br><br>
            <div class="row25 align-right">&nbsp;</div>
            <div class="row75 align-left" style="">
                <!--<input id="login-submit" class="submit-middle" type="submit" name="" value="登录"/>-->
                <button id="login-submit" class="submit-middle">登录</button>
            </div> <div class="clear"></div>

            <div class="" style="margin-top:20px; text-align: center;">
                <font size="2"><a href="../php/registerLogin.php">没有账号？注册一个!</a></font>
            </div>
        </form>
</div>
<div class="model-overlay" id="model-overlay">
</div>
<script>
$("#delete").click(function(){
	//alert(<?php echo $id;?>);
	if (window.confirm("你确定要删除吗？")) {
		$.ajax({
			url: "upload.php",
			type: "POST",
			data : {		
				delete_id: <?php echo $id;?>
			},
			error : function() {
				alert("连接失败");
			},
			success:function(data){
				alert("删除成功");
				location.href = "http://crazymad.cn";
			}
		});
		//alert("确定");
	} else {
		//alert("取消");
	}
});
</script>
</body>
<?php
mysql_close($icon);
?>

</html>
