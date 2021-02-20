
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bind</title>
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
						<h2>教务身份核验</h2>
						<div class="form-group">
							<div class="alert alert-info">本页面仅与教务系统进行核验，<br></br>不保存任何用户名或密码。</div>
							<div class="alert alert-danger" id="Error">请重试绑定</div>
							<div class="alert alert-success" id="Success" role="alert">感谢您的注册，请返回注册</div>
						</div>
						<div class="form-group">
							<label for="name" class="sr-only">Name</label>
							<input type="text" class="form-control" id="user" placeholder="学号" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="pass" placeholder="密码" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="text" class="sr-only">Code</label>
							<input type="text" class="form-control" id="code" placeholder="验证码" autocomplete="off">
                            <img id = "img" src="https://api.radiology.link/Library/image/e93e62372d97fc9cebbac58081f3fc45.jpg">
						</div>
						<div class="form-group">
							<p>已经注册了？ <a href="index.php">登录</a></p>
						</div>
						<div class="form-group">
							<input type="submit" value="核验" class="btn btn-primary" onclick="Verify()">
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
    let cookie = 0;
    let img = 0;
		$(document).ready(function(){
			$("#Success").hide();
			$("#Error").hide();
            getImg();
		})

        function getImg(){
            $.ajax({
				url:"https://bs.radiology.link/api/verify.php",
				async:false,
				type:"GET",
				data:{
					"do":'code',
				},
				success: function(data){
					cookie = JSON.parse(data).Cookie;
                    img = JSON.parse(data).img;
                    pic = "https://bs.radiology.link/api/image/"+img;
                    document.getElementById('img').src = pic ;
				}
			})           
        }

        function Verify(){
            let user = $("#user").val();
            let pass = $("#pass").val();
            let code = $("#code").val();
             $.ajax({
				url:"https://bs.radiology.link/api/verify.php",
				async:false,
				type:"GET",
				data:{
					"do":'login',
                    "user":user,
                    "pass":pass,
                    "code":code,
                    "cookie":cookie,
                    "img":img
				},
				success: function(data){
					if (data == 'true'){
                        layer.alert('核验成功', function(index){
                        	top.location = 'https://bs.radiology.link/signup.php';
							layer.close(index);
						});       
                    } else {
                        layer.alert('核验失败，请重试');
                        getImg();
                    }
				}
			})      
        }



	</script>
		</body>
</html>

