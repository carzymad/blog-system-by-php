<html>

<title>crazy_mad's blog</title>
<head>
<link rel="stylesheet" type="text/css" href="css/blog.css">
<link rel="shortcut icon" type="image/x-icon" href="images/blog.icon">
<script src="js/jquery.js"></script>
<script src="js/markdown-parse.js"></script>
<script src="js/blog.js"></script>
</head>

<body style="background-image: url('images/body-bg.jpg')">
<div class="main">
    <h1 style="margin-bottom: 0px;"><a id="login" style="color: #009999; ">CRAZY_MAD</a></h1>
    <p style="font-size: 15px; color: gray; margin-top: 5px; margin-bottom: 40px;">为coding而生，为coding而疯狂</p>
    <hr class="blog-hr" style=""/>
        <table class="nav-bar">
            <tr>
                <td style="width: 100px;">
                    <a href="index.php" class="sub-a">首页</a>
                </td>
                <td style="width: 100px;">
                    <a href="curse.html" class="sub-a">课程表</a>
                </td>
                <td style="width: 100px;">
                    <a href="http://115.159.154.139/chat" class="sub-a">聊天室</a>
                </td>
                <td style="width: 150px;">
                    <a href="markdown.php" class="index-a"><strong>markdown-parse</strong></a>
                </td>
            </tr>
        </table>
   <hr class="blog-hr"/>
	<div id="inner" class="row100" style="position: relative; margin-bottom: 30px;">
<script>
$(function(){
	var flag = true;
	$("#inner").css("height", $("#input").css("height"));
	$("#change").click(function(){
		$(document).scrollTop(230);
		if (flag) {
			$("#change").html("返回编辑");
			$("#input").hide();
			$("#output").show();
			$("#output").html("");
			var lines = $("#input").val().split("\n");
			for (var i = 0; i < lines.length; i++) {
				$("#output").append(parse(lines[i]));
			}
			$("#inner").css("height", $("#output").css("height"));
			flag = false;
		} else {
			$("#change").html("预览效果")
			$("#output").hide();
			$("#input").show();
			$("#inner").css("height", $("#input").css("height"));
			flag = true;
		}
	})
})

</script>
		<textarea id="input" style="padding: 3px 3px 3px 3px; border-radius: 4px; width: 1000px; height: 500px; margin-bottom: 30px; font-size:17px; position: absolute;">
		</textarea> <br />
		<div id="output" style="position: absolute;">
		</div>
	</div>
	<a id="change" class="btn">预览效果</a>
	<hr class="blog-hr" style="margin-top: 100px; margin-bottom: 30px;"/>
	<center>
   <?php 
       echo "<p style='font-size: 17px; margin: 5px 0 5px 0'>Copyright © 2016-" . date("Y") . " by crazymad</p>\n";
	?>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>mail: crazy_mad01@163.com or 2116913961@qq.com</p>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>NBUT CS-154</p>
	</center>
</div>
</body>

</html>
