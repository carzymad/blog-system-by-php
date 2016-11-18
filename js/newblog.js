$(function() {
	var flag = true;
	$("#input-text").val("");
	$("#input-abstract").val("");
	$("#output").hide();
	//var height = parseInt($("#input").css("height").match(/[0-9]*/)) + 50 + "px";
	$("#change").click(function(){
		$(document).scrollTop(230);
		if (flag) {
			$("#change").html("返回编辑");
			$("#input-div").hide();
			$("#output").show();
			//$("#output").html("");
			$("#text").html("");
			$("#abstract").html("");
			if ($("#input-text").val() == "") {
				$("#text").html("请输入正文");
			} else {  
				var lines = $("#input-text").val().split("\n");
				for (var i = 0; i < lines.length; i++) {
					$("#text").append(parse(lines[i]));
				}
			}
			if ($("#input-abstract").val() == "") {
				$("#abstract").html("请输入摘要");
			} else {
				var lines = $("#input-abstract").val().split("\n");
				for (var i = 0; i < lines.length; i++) {
					$("#abstract").append(parse(lines[i]));
				}
			}
			flag = false;
		} else {
			$("#change").html("预览效果")
			$("#output").hide();
			$("#input-div").show();
			flag = true;
		}
	})
})


function upload_ajax(title_, text_, abstra_, id_) {
$.ajax({
		url : "upload.php",
		type : "POST",
		data : {
			id : id_,
			title : title_,
			text : text_,
			abstract_ : abstra_	
		},
		error : function(
					XMLHttpRequest,
					textStatus,
					errorThrown) {
                   alert(XMLHttpRequest.status);
                   alert(textStatus);
                   alert(XMLHttpRequest.readyState);
		},
		success : function(data) {
			alert("上传成功");
			//location.href("show.php?id="+id_+"&title="+title_);
			//alert(data);
			location.href = "http://crazymad.cn/show.php?id=" + data + "&title=" + title_;
		}	
	})
}
