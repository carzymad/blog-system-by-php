var page_ = 0;
var maxpage = 1;
var amount_ = 3;

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
		$("#blog-list").append("<h2 style='margin-bottom: 0px;'><a href='show.php?id="+arr[i]['id']+"'>"+arr[i]['title']+"</a></h2>")
		$("#blog-list").append("<p style='font-size:15px; color:gray;'>发表于:" + arr[i]['public_date'] + "&nbsp;&nbsp;最后修改于:" + arr[i]['modify_date'] + "</p>")
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
		$("#blog-list").append("<hr style='margin-bottom: 5px;' class='blog-hr'/>");
		$("#blog-list").append("<hr style='margin-top: 5px;' class='blog-hr'/>");
		$("#blog-list").append("<div style='width: 1px; height: 50px;'></div>")
	}
}

var reply_div = "";		// 回复窗口从属的div id
// 显示所有评论和回复信息
function showComment(arr) {
	var n = arr.length;
	var userlist = {
		10 : 'admin'			// id号为10的是admin管理员账号
	}
	var headlist = {
		10 : 'head.jpg'		// 用户头像列表
	}
	for (var i = 0; i < n; i++) {
		var from_user = arr[i]['from_user'];	// 当前评论从属的对象账号id
		var to_user = arr[i]['to_user'];			// 当前评论回复的对象账号id
		var text = arr[i]['text'];					// 当前评论的文本内容
		var reply = arr[i]['reply'];				// 当前评论回复的是评论id号
		var id = arr[i]['id'];						// 当前评论的id号
		var public_date = arr[i]['public'];		
		if (userlist[""+from_user] == null) {
			$.ajax({
				async : false,
				type : "GET",
				url : "loadUser.php",
				data : {
					user_id : from_user,
					type_ : 1				// type1表明是简略用户信息 
				},
				error : function() {
					console.warn('database has no user as ' + id);
					alert("error");
				},
				success : function(data) {
					//alert(data);
					var obj = eval('('+data+')');
					userlist[''+from_user] = obj['name'];
					headlist[''+from_user] = obj['head'];
				}
			})
		}
		var add = "<div id='command"+id+"'style='padding-bottom: 40px;'><img src='images/"+headlist[""+from_user]+"' style='width: 70px; float: left; border-radius: 5px;' />";
		add += "<div style='float: left; margin-left: 10px;'>";
		add += "<p style='margin:0px;'>"+userlist[""+from_user]+" 发表于: "+public_date + "&nbsp;#" + (i+1) + "楼&nbsp;";
		add += "<a onclick='reply("+from_user+","+id+", \"reply"+id+"\")' style=''>&nbsp;回复</a></p>"
		add += "<hr style='margin-top: 0px;margin-bottom: 8px;  border-top:1px dotted #185598;'/>"
		if (reply != null) {
			add += "<div class='' style='padding: 10px; margin-bottom: 5px; background-color: #E8E8E8;'>" + findComment(arr, reply, userlist) + "</div>";
		}
		add += "<div style=''>&nbsp;" + arr[i]['text'] + "</div></div><div style='clear:both;'></div>";
		add += "<div id='reply"+id+"' style='margin-left: 80px; margin-top: 10px;'></div></div>"
		add += "<hr class='blog-hr' />"
		$("#comment").append(add);
	}
}
// 找到对应的评论信息以绘制要回复的信息
function findComment(arr, id, userlist) {
	var n = arr.length;
	for (var i = 0; i < n; i++) {
		if (arr[i]['id'] == id) {
			return "<p style='margin:0px;'>"+userlist[""+arr[i]['from_user']]+" 发表于: "+arr[i]['public']+"&nbsp;#"+(i+1)+"楼</p><hr style='margin-top: 0px;margin-bottom: 8px;  border-top:1px dotted #185598;'/>"+arr[i]['text'];
		}
	}
}
// 绘制回复窗口
function reply(to_user, reply_id, id) {		// to_user:要回复的对象， reply_id:要回复的评论的id号, id:当前回复窗口从属的div对象
	if (reply_div != "") {
		$(reply_div).html("");
	}
	reply_div = "#" + id;
	var add = "<textarea id='reply-text' style='width: 400px; height: 100px;'></textarea><br />";
	add += "<input id='submitreply' onclick='submitReply("+to_user+","+reply_id+")' style='margin-top: 10px;' class='btn' type='submit' value='提交'> <input id='test' class='btn' type='submit' value='取消' onclick='cancel()'>"
	$(reply_div).html(add);
}
// 取消回复
function cancel() {
	$(reply_div).html("");
	reply_div = "";
}
var line = "";
$(function(){
	$(document).on("change", "#reply-text", function(e){
		line = $("#reply-text").val();
	})
	/*$(document).on("click", "#submitreply", function(e){
		alert("获取到了");
		alert(line);
	})*/
})
// 提交回复
function submitReply(to_user_, reply_id) {
	//alert(reply_id);
	//alert(to_user_);
	//alert(line);
	//alert(article_id);
	if (!to_user_ || !reply_id || !line) {
		alert("请输入有效内容");
		return;
	}
	$.ajax({
		type : "POST",
		url : "uploadReply.php",
		data : {
			reply : reply_id,
	   	to_user	: to_user_,
			text : line,
			articleid : article_id,
			reply : reply_id
		},
		error : function() {
			alert("连接失败");
		},
		success : function(data) {
			alert(data);
			var res = data;
			if (res == 'not login\n') {
				$("#model-open").trigger("click");			
			} else {
				alert("提交成功");
				window.location.reload();			// 重新加载页面
			}
		}
	})
}
