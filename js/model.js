var can_submit = false;
var true_verify = "";
var code_isset = false;
$(function(){
    $("#model-open").click(function(){
        $("#model-overlay").show();
        $("#model-data").show();
    })
})
$(function(){
    $("#model-close").click(function(){
        $("#model-overlay").hide();
        $("#model-data").hide();
    })
})
$(function(){
    $("#login-submit").click(function(){
        var name_ = $("#login-name").val();
        var psw_ = $("#login-psw").val();
        var code_ = $("#login-verify").val();
        var verify_ = $("#login-verify").val();
        var obj1 = $("#login-name").parent().nextAll("div.row75").find("font");
        var obj2 = $("#login-psw").parent().nextAll("div.row75").find("font");
        var obj3 = $("#login-verify").parent().nextAll("div.row25").find("font");
        if (name_ == "") {
            obj1.eq(0).attr("color", "red");
            obj1.eq(0).html("请输入账号");
            can_submit = false;
        } else {
            obj1.eq(0).html("&nbsp;");
        }
        if (psw_ == "") {
            obj2.eq(0).attr("color", "red");
            obj2.eq(0).html("请输入密码");
            can_submit = false;
        } else if (psw_ != "" && name_ != ""){
            obj2.eq(0).html("&nbsp;");
            can_submit = true;
        }
    
        can_submit = code_isset ? true : false;
        if (can_submit) {
            $.ajax({
                url : "login.php",
                type : "POST",
                data : {
                    name : name_,
                    psw : psw_,
                    code : code_ 
                },
                //cache : false,
                //dataType : "jsonp",
                error : function(
                           XMLHttpRequest,
                            textStatus,
                            errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(textStatus);
                    alert(XMLHttpRequest.readyState);
                },
                success : function(data) {
                    if (data == 'true') {
                        $("#model-overlay").hide();
						$("#model-data").hide();
                        code_isset = false;
                        //alert("登录成功！");
						if ($("#write-blog").html() == null)
							$("#nav-bar-row01").append("<td style='width: 100px;'><a href='newblog.php'>写博客</a></td>");
                    } else if (data == 'nouser') {
                        obj1.eq(0).attr("color", "red");
                        obj1.eq(0).html("账户不存在");
                        can_submit = false;
                    } else if (data == 'pswerror') {
                        obj2.eq(0).attr("color", "red");
                        obj2.eq(0).html("密码错误");
                        can_submit = false;
                    } else {
                        obj3.eq(0).attr("color", "red");
                        obj3.eq(0).html("验证码错误");
                        can_submit = false;
                        $("#code").attr("src", "code02.php?Math.random()");
                    }
                }
            });
			return false;
        } 
        return false;
    });
})
$(function(){
    $("#model-overlay").hide();
    $("#model-data").hide();
})
$(function(){
    $("#login-verify").bind("click", function(){
        //alert("code");
        if (!code_isset) {
            $("#code").attr("src", "code02.php?Math.random()");
            code_isset = true;
        }
    });
    $("#code").bind("click", function(){
        $("#code").attr("src", "code02.php?Math.random()");
        code_isset = true;
    });
})
