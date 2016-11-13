<html>
<title>markdown-parse</title>
<head>
<link rel="stylesheet" type="text/css" href="css/blog.css">
<script src="js/jquery.js"></script>
<script src="js/markdown-parse.js"></script>
<script>
$(function(){
	$("#parse").click(function(){
		var lines = $("#before-parse").val().split('\n');
		//alert(lines);
		$("#after-parse").html("");
		mosaic(lines, "#after-parse");
	})
})

</script>
</head>
<body>
<div class="row100">
	<h3>目前仅支持&lt;a&gt;&lt;h&gt;&lt;img&gt;三种特殊标签</h3>
	<div class="row50">
		<div id="after-parse" style="padding: 10px 10px 10px 10px; margin: 10px 10px 10px 10px; border: 1px solid gray; height: 1100px;">
		</div>
	</div>
	<div class="row50">
		<div style="padding: 10px 10px 10px 10px">
			<textarea id="before-parse" style="float: left; resize: none; width: 600px; height: 1100px; font-size: 20px; padding: 10px 10px 10px 10px">
			</textarea>
			<button id="parse" style="float: left;">转换</button>
			<div style="clear:both"></div>
		</div>
	</div>
	<div style="clear: both;"></div>
</div>
</body>

</html>
