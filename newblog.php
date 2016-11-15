<html>

<title>crazy_mad's blog</title>
<head>
<link rel="stylesheet" type="text/css" href="css/blog.css">
<link rel="stylesheet" type="text/css" href="css/model.css">
<script src="js/jquery.js"></script>
<script src="js/markdown-parse.js"></script>
<script src="js/blog.js"></script>
<script src="js/newblog.js"></script>
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
                    <a href="markdown.php" class="sub-a">markdown-parse</a>
                </td>
                <td style="width: 130px;">
						  <a href="http://115.159.154.139/blog" class="sub-a">博客系统1.0</a>
					 </td>
					 <td style='width: 100px;'>
						<a id='write-blog' class='index-a' href='newblog.php'><strong>写博客</strong></a>
					</td>
            </tr>
        </table>
   <hr class="blog-hr"/>
	<div id="inner" class="row100" style="margin-bottom: 30px; margin-top: 40px;">
		<div id="input-div" style="margin-top: 10px;">
			<p style="margin-bottom: 5px;">文章标题&nbsp;</p>
			<input id="title" type="text" class="input-middle" style="width: 75%; margin-bottom: 15px;"/><br />
			<p style="margin-bottom: 5px;">正文&nbsp;</p>
			<textarea id="input-text" style="padding: 3px 3px 3px 3px; border-radius: 4px; width: 1000px; height: 450px; margin-bottom: 10px; font-size:17px;">
			</textarea> <br />
			<p style="margin-bottom: 5px;">摘要&nbsp;</p>
			<textarea id="input-abstract" style="padding: 3px 3px 3px 3px; border-radius: 4px; width: 1000px; height: 150px; margin-bottom: 10px; font-size:17px;">
			</textarea>
		</div>
		<div id="output" style="">
			<p>正文</p>
			<div style="width: 100%; border: 1px solid gray; border-radius: 3px;">
				<div id="text" style="padding: 5px 5px 5px 5px;">
				</div>
			</div>
			<p>摘要</p>
			<div style="width: 100%; border: 1px solid gray; border-radius: 3px;">
				<div id="abstract" style="padding: 5px 5px 5px 5px;">
				</div>
			</div>
		</div>
	</div>
	<a id="change" class="btn">预览效果</a> <a id="upload" class="btn">上传博客</a>
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
