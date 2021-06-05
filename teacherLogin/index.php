<?php
session_start();
if (!isset($_SESSION['username']) && $_SESSION['username'] == null) {
    unset($_SESSION['username']);
    $url = "https://bs.radiology.link/";
    header('Location:' . $url);
}
    $conn = new mysqli("localhost", "bs", "bs", "bs");
    $checkAuth = $conn -> prepare("SELECT * From teacherInfo WHERE teacherNumber = ?");
    $checkAuth -> bind_param("s",$_SESSION['username']);
    $checkAuth -> execute();
    $checkAuth -> store_result();
    if (!$checkAuth -> num_rows){
        unset($_SESSION['username']);
        $url = "https://bs.radiology.link/";
        header ( 'Location:' . $url );
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>主页</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../login/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../login/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../login/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../login/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="http://www.sdfmu.edu.cn"><img src="http://www.sdfmu.edu.cn/static/images/logo.jpg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../login/images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">
                        <i class="mdi mdi-cached text-success"></i>
                    </a>
                </li>
                <li class="nav-item nav-logout d-none d-lg-block">
                    <a class="nav-link" href="../index.php?exit=1">
                        <i class="mdi mdi-power text-danger"></i>
                    </a>
                </li>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item sidebar-actions">
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">
                        <span class="menu-title">概览</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./choose.php" >
                        <span class="menu-title">双向选择</span>
                        <i class="mdi mdi-vector-intersection menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./paperManage.php">
                        <span class="menu-title">论文管理</span>
                        <i class="mdi mdi-folder-upload menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./scoreManage.php">
                        <span class="menu-title">成绩管理</span>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./scoreAppeal.php">
                        <span class="menu-title">成绩申诉</span>
                        <i class="mdi mdi-alert menu-icon"></i>
                    </a>
                </li>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>
                        概览
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="../login/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">登录账号
                                    <i class="mdi mdi-human-greeting mdi-24px float-right"></i>
                                </h4>
                                <?php
                                $username = $_SESSION['username'];
                                echo "<h2 class='mb-5'>$username</h2>";
                                ?>
                                <h6 class="card-text">欢迎回来</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="../login/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3" >教师姓名
                                    <i class="mdi mdi-chevron-double-right mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5" id = "teacherName"><?php echo $_SESSION['teacherName'] ?></h2>
                                <h6 class="card-text">您辛苦了</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="../login/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">负责院系
                                    <i class="mdi mdi-playlist-check mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5" id = "status"><?php echo $_SESSION['teacherMajor'] ?></h2>
                                <h6 class="card-text">请及时处理相关工作</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2021.山东第一医科大学</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="../login/vendors/js/vendor.bundle.base.js"></script>
<script src="../login/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../login/js/off-canvas.js"></script>
<script src="../login/js/layer.js"></script>
<script src="../login/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../login/js/dashboard.js"></script>
<!-- End custom js for this page-->
<style>
</style>
</body>
<script>
    new Promise(resolve => {
        layer.load(2);
        $(document).ready(function (){
            resolve();
        })
    }).then(res=>{
            layer.closeAll();
            layer.msg("加载完成");
        }
    )
</script>

</html>
