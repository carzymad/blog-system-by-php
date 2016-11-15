var page_ = 0;
var maxpage = 1;
var amount_ = 3;
// 管理员登陆
$(function(){
	$("#login").click(function(){

	})
})
// 点击博客列表下一页，取得下一页或者上一页的博客人列表
$(function(){
	page_++;
	loadBlog();
	loadBoard();
	$("#prev-page").click(function(){
		if (page_ != 1) {
			$("#blog-list").html("");
			page_--;
			loadBlog();
			$(document).scrollTop(230);
		}
	});
	$("#next-page").click(function(){
		if (page_ < maxpage) {
			$("#blog-list").html("");
			page_++;
			loadBlog();
			$(document).scrollTop(230);
		}
	})
})
// 取得公告栏内容
function loadBoard() {
	$.ajax({
		url : "loadBoard.php",
		type : "GET",
		data : {
			amount: 3
		},
		error : function (
					XMLHttpRequest,
					textStatus,
					errorThrown
					) {
			alert("connect error!");
		},
		success : function (data) {
		//alert(data);
			var arr = eval(data);
			showBoard(arr);
		}	 
	})
	return false;
}
// 取得博客列表信息
function loadBlog() {
	$.ajax({
		url : "loadBlog.php",
		type : "GET",
		data : {
			page : page_,
			amount : amount_
		},
		error : function (
					XMLHttpRequest,
					textStatus,
					errorThrown
					) {
			alert("链接失败");
		},
		success : function(data) {
			//alert("链接成功");
			var arr = eval(data);
			output(arr);
		}
	})
	return false;
}
// 绘制公告栏
function showBoard(arr) {
	var n = arr.length;
	//alert(n);
	for (var i = 0; i < n; i++) {
		$("#board").append("<h4 style='margin-bottom: 5px;'>&nbsp;"+arr[i]['title']+"</h4>");
		$("#board").append("<p>"+arr[i]['content']+"</p>")
	}
}
// 处理取得的字符串数组，将其从markdown解析到html格式，然后输出
function output(arr) {
	//alert("开始处理数据");
	var n = arr.length;
	maxpage = Math.ceil(arr[0]/3);
	//alert(n);
	for (var i = 1; i < n; i++) {
		//alert(arr[i]['id']+arr[i]['title']);
		var id = "list" + i;
		var obj = "#" + id;
		$("#blog-list").append("<h2><a href='show.php?id="+arr[i]['id']+"'>"+arr[i]['title']+"</a></h2>")
		$("#blog-list").append("<div style='padding: 10px 10px 10px 10px' id='"+id+"'></div>")
		var result = $.ajax({url:"article/"+arr[i]['id']+".abs", async:false});
		var lines = result.responseText.split(/\n/g);
		for (var j = 0; j< lines.length; j++) {
			//alert(lines[i]);
			//alert(parse(lines[j]));
			$(obj).append(parse(lines[j]));
			//$(obj).append("<p>"+lines[j]+"</p>");
		}
		$(obj).append("<div style='margin-top: 25px;'><a style='color:#4BBF96;' href='show.php?id="+arr[i]['id']+"'><strong>继续阅读...</strong></a></div>")
		$("#blog-list").append("<hr class='blog-hr'/>");
		$("#blog-list").append("<div style='width: 1px; height: 50px;'></div>")
	}
}
