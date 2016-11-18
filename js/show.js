$(function(){
	$("#new-comment").html("");
	$("#write-comment").click(function(){
		if ($("#div-write-comment").prop("hidden")) {
			$("#div-write-comment").prop("hidden", false);
		} else {
			$("#div-write-comment").prop("hidden", true);
		}
	})
	$("#submit-comment").click(function(){
		$.ajax({
			type : "POST",
			url : "uploadComment.php",
			data : {
				articleid : article_id,
				text : $("#new-comment").val()
			},
			error : function() {
				alert("failed");
			},
			success : function(data) {
				alert(data)
				if (data != 'not login') {
					window.location.reload();			// 重新加载页面
				} else {
					$("#model-open").trigger("click");			
				}
			}
		})
	})
})
