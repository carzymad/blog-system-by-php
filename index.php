<html>

<title>crazy_mad's blog</title>
<head>
<link rel="stylesheet" type="text/css" href="css/blog.css">
<link rel="stylesheet" type="text/css" href="css/model.css">
<script src="js/jquery.js"></script>
<script src="js/model.js"></script>
<script src="js/markdown-parse.js"></script>
<script src="js/blog.js"></script>
</head>

<body style="background-image: url('images/body-bg.jpg')">

<div class="main" style="position: absolute; top: 0px;">
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
                <td style="width: 130px;">
                    <a href="http://115.159.154.139/blog" class="sub-a">博客系统1.0</a>
                </td>
					 <?php
						session_start();
						if ($_SESSION['login']) {
							echo "<td style='width: 100px;'><a id='write-blog' class='sub-a' href='newblog.php'>写博客</a></td>";
						}
					 ?>
            </tr>
        </table>
    <hr class="blog-hr"/>
    <div class="row70">
        <div id="blog-list" class="left"></div>
        <div class="left">
            <a class="btn" id="prev-page" style="float: left;">prev</a>
            <a class="btn" id="next-page" style="float: left;">next</a>
            <a class="btn" style="float: right; margin-right: 30px;">高级搜索</a>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="row30">
		<div id="right" class="right" style="padding-left: 20px; margin-top: 30px;">
        <div style="-webkit-box-shadow: 1px 1px 5px gray; width: 150px; border-radius: 5px;">
            <img src="images/head.jpg" style="border-radius: 5px; width: 150px; height:150px;" />
        </div>
        <div id="brief-introduction">
            <h2 style="margin-bottom: 10px; color: #00B5B5"><strong>crazy_mad</strong></h2>
            <p>一个会写点代码的智障</p>
            <p>一个会画点漫画的智障</p>
            <p>总而言之，是一个很有才华的智障</p>
            <br />
            <p>github账号:&nbsp;<a href="http://github.com"><strong>carzymad</strong></a></p>
            <p>mail账号:&nbsp;<strong>crazy_mad01@163.com</strong></p>
		  </div>
			<hr class="blog-hr" />
		</div>
		<div id="board" class="right" style="margin-top: 40px;"> 
			<h3>公告栏</h3>
		</div>
    </div>
    <div style="clear: both;"></div>
	<hr class="blog-hr" style="margin-top: 100px; margin-bottom: 30px;"/>
	<center>
   <?php 
       echo "<p style='font-size: 17px; margin: 5px 0 5px 0'>Copyright © 2016-" . date("Y") . " by crazymad</p>\n";
	?>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>mail: crazy_mad01@163.com or 2116913961@qq.com</p>
		<p style='font-size: 16px; margin: 5px 0 5px 0'>NBUT CS-154</p>
	</center>
	</div>
    <div class="model-data" id="model-data" style="position: absolute; background: -webkit-gradient(linear, 0 0, 20% 0%, from(#FFF), to(#FaFaFa));">
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
<div>
<script>
$(function(){
	var left = $(document).width() / 2;
	var width = $("#model-data").css("width").split("px")[0] / 2;
	$("#model-data").css("left", left-width+"px");
})
</script>

</body>

</html>
