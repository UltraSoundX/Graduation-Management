<?php
    $lifeTime = 24 * 3600; //Session保存一天
    session_set_cookie_params($lifeTime);
    session_start();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

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
						<h2>注册</h2>
						<div class="form-group">
							<div class="alert alert-warning">请使用教务系统身份核验绑定账号</div>
							<div class="alert alert-danger" id="Error"></div>
							<div class="alert alert-success" id="Success" role="alert">感谢您的注册，请返回登录</div>
						</div>
						<div class="form-group">
							<label for="name" class="sr-only">Name</label>
							<input type="text" class="form-control" id="username" readonly="readonly" placeholder="学号/职工账号" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="password" placeholder="密码" autocomplete="off">
						</div>
						<div class="form-group">
							<p>已经注册了？ <a href="index.php">登录</a></p>
						</div>
						<div class="form-group">
							<input type="submit" value="注册" class="btn btn-primary" onclick="Register()">
                            <input type="submit" value="重新绑定" class="btn btn-primary" onclick="Bind()">
						</div>
					</div>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small>&copy; All Rights Reserved. Designed by <a href="https://Radiology.link">Radiology.link</a></small></p></div>
			</div>
		</div>
	
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
	<script src="login/assets/js/layer/layer.js" type="text/javascript"></script>

	<script type="text/javascript">
        function verify(){
            layer.confirm('点击确定将进入教务系统身份核验', {
                btn: ['确定','取消']
            }, function(){
                window.location.href = 'https://bs.radiology.link/bind.php';
            });
        }

        class DivManage {
            static Hide(){
                $("#Success").hide();
                $("#Error").hide();
            }
        }

		$(document).ready(function(){
		    DivManage.Hide();
			<?php
                if (isset($_SESSION['verify']) && $_SESSION['verify'] != null){
                    $username = $_SESSION['verify'];
                    echo "$('#username').val($username)";
                } else {
                    echo "verify();";
                }
			?>
		})

        function Register(){
            let username = $("#username").val();
            let password = $("#password").val();
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                async:false,
                type:'GET',
                data:{
                    "do":'register',
                    "username":username,
                    "password":password,
                },
                success: function(data){
                    console.log(data);
                    let msg = JSON.parse(data).msg;
                    switch (msg) {
                        case '1000':
                            $("#Success").show();
                            window.location.href = "http://bs.radiology.link/"
                            break;
                        case '1001':
                            $("#Error").html("注册失败");
                            break;
                    }
                }
            })
        }

        function Bind() {
            <?php
                unset($_SESSION['verify']);
            ?>
            verify();
        }
	</script>
	</body>
</html>

