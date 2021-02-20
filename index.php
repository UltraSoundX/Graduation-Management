<?php
    $lifeTime = 24 * 3600; //Session保存一天
    session_set_cookie_params($lifeTime);
    session_start();
    $_SESSION['username'] = null;
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					

					<!-- Start Sign In Form -->
					<div class="fh5co-form animate-box" data-animate-effect="fadeIn">
						<h2>山一医毕业设计管理系统</h2>
						<div class="form-group">
							<!--<div class="alert alert-info">山东第一医科大学毕业设计管理系统<br>问题反馈：<br>-->
                            <!--<span class="text-success">WeChat:Harold_Xin</span></div>-->
                            <div class="alert alert-danger" id = "LoginFail"></div>
                            <div class="alert alert-success" id = "LoginSuccess"></div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="学号/职工账号" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="密码" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <p>还没有注册？ <a href="signup.php">注册</a> | <a href="forgot.html">忘记密码？</a></p>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="登 录" class="btn btn-primary" onclick="Login()">
                        </div>
                        <div class="form-group">
                            <div class="alert alert-success">暂无公告
                                <!--<span class = 'text-danger'>依旧解决不了跨日期预约的难题</span>-->
						    </div>
					</div>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small>&copy; All Rights Reserved. Designed by <a href="https://Radiology.link">Radiology.link</a></small></p></div>
			</div>
		</div>

</body>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Placeholder -->
<script src="js/jquery.placeholder.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Main JS -->
<script src="js/main.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#LoginSuccess").hide();
        $("#LoginFail").hide();
        <?php
        if (isset($_SESSION['username']) && $_SESSION['username'] != null){
            echo "DivManage.LoginSuccess('欢迎回来！正在跳转...');";
            header("Refresh:2,url=./login/index.php");
        } else {
            echo "DivManage.LoginFail('请您登陆');";
        }
        ?>
    }) //页面加载完成

    function Login() {
        $("#LoginSuccess").hide();
        $("#LoginFail").hide();
        let username = $("#username").val();
        let password = $("#password").val();
        let text = null;
        $.ajax({
            "url":"https://bs.radiology.link/api/graduation.php",//TODO:在php中设置SESSION
            "type":"GET",
            "async":false,
            "data": {
                "do":"login",
                "username":username,
                "password":password
            },
            success:function (data) {
                let msg = JSON.parse(data).msg;
                switch (msg) {
                    case '9999':
                        text = "未知错误，请联系管理员";
                        DivManage.LoginFail(text);
                        break;
                    case '1000':
                        text = "登陆成功，欢迎" + username + "！";
                        DivManage.LoginSuccess(text);
                        setTimeout(function () {
                            window.location.replace("https://bs.radiology.link/login/index.php");
                        },1000);
                        break;
                    case '1001':
                        text = "请检查用户名密码或未注册";
                        DivManage.LoginFail(text);
                        break;
                }
            }
        })
    }

    class DivManage {
        static LoginFail(text){
            if (text == '请您登陆'){
                $("#LoginFail").attr("class","alert alert-info");
                $("#LoginFail").text(text);
                $("#LoginFail").show();
            } else {
                $("#LoginFail").text(text);
                $("#LoginFail").show();
            }

        }
        static LoginSuccess(text) {
            $("#LoginSuccess").text(text);
            $("#LoginSuccess").show();
        }
    } //DIV标签操作

    
    
    

</script>
</html>

