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
    <title>双向选择</title>
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
                    <a class="nav-link" href="./choose.php">
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
                        双向选择管理
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">双选管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">双向选择管理</h4>
                                <p class="card-description">
                                    请完成双向选择
                                </p>
                                <div class="row">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>学号</th>
                                            <th>学生姓名</th>
                                            <th>论文名称</th>
                                            <th>开题报告完成状态</th>
                                            <th>开题报告下载</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody id="studentList">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
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
<script src="../login/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../login/js/dashboard.js"></script>
<<script src="../login/js/layer.js"></script>
<!-- End custom js for this page-->
<style>
</style>
</body>
<script>
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.listInit(resolve);
        }).then (res => {
            layer.closeAll();
            if (res == "2001")layer.msg("暂时无需进行相关操作！");
            if (res == "2000")layer.msg("加载完成");
        })
    })
    class pageReady {
        static listInit(callback){
            $.ajax({
                url: "https://bs.radiology.link/api/graduation.php",
                async: false,
                type: "GET",
                data: {
                    "do": "teacherChooseQuery",
                    "teacherName":"<?php echo $_SESSION['teacherName'] ?>",
                    "teacherMajor":"<?php echo $_SESSION['teacherMajor'] ?>"
                },
                success: function (data) {
                    let msg = JSON.parse(data).msg;
                    if (msg === "2001") {
                        callback("2001");
                    } else {
                        let studentList = JSON.parse(data).studentList;
                        for (let i in studentList){
                            let SI = studentList[i] //StudentInfo
                            pageReady.listAppend(SI['studentNumber'],SI['studentName'],SI['paperTitle'],SI['prepareStatus'],SI['paperType']);
                        }
                        callback("2000");
                    }
                }
            })
        }
        static listAppend(studentNumber,studentName,paperTitle,prepareStatus,paperType){
            let paperDownload;
            if (prepareStatus == 0){
                prepareStatus = "<label class = 'badge badge-danger'>未完成</label>";
                paperDownload = "<button class='btn btn-rounded btn-sm btn-gradient-danger'>暂不支持下载</button>";
            } else {
                prepareStatus = "<label class = 'badge badge-success'>已完成</label>";
                let paperUrl = `'https://bs.radiology.link/api/prepare_upload/${studentNumber}开题报告.${paperType}'`;
                paperDownload = `<button class="btn btn-rounded btn-sm btn-gradient-success" onclick="window.open(${paperUrl})">下载</button>`;
            }
            let operation = "<button class='btn btn-icon-append btn-sm btn-group btn-inverse-success' onclick = 'operate(this)'> <i class='mdi mdi-check-circle-outline'></i></buttion>       "
            let operation2 ="<button class='btn btn-icon-append btn-sm btn-group btn-inverse-danger' onclick='operate(this)'> <i class='mdi mdi-close-circle-outline'></i></buttion>"
            let operation3 = operation + operation2;
            let listAppend = `<tr><td>${studentNumber}</td><td>${studentName}</td><td>${paperTitle}</td><td>${prepareStatus}</td><td>${paperDownload}</td><td>${operation3}</td></tr>`;
            $("#studentList").append(listAppend);
        }
    }

    function operate(eol) {
        let option = $(eol)[0].innerHTML;
        let studentNumber = $(eol).parent().prev().prev().prev().prev().prev()[0].innerText;
        let studentName = $(eol).parent().prev().prev().prev().prev()[0].innerText;
        if (option.indexOf("check") == -1) {
            $.ajax({
                url: "https://bs.radiology.link/api/graduation.php",
                type: "GET",
                async: false,
                data: {
                    "do": "teacherChoose",
                    "option":0,
                    "studentNumber": studentNumber
                },
                success: function (data) {
                    try {
                        let msg = JSON.parse(data).msg;
                        if (msg === "2000") {
                            $(eol).parent().parent().remove();
                            layer.msg("操作成功！");
                        } else {
                            layer.msg("服务异常！");
                        }
                    } catch (e) {
                        console.log(data);
                        layer.msg("请求异常，请联系管理员。")
                    }
                }
            })
        } else {
            $.ajax({
                url: "https://bs.radiology.link/api/graduation.php",
                type: "GET",
                async: false,
                data: {
                    "do": "teacherChoose",
                    "option":1,
                    "studentNumber": studentNumber,
                    "studentName":studentName,
                    "teacherName":'<?php echo $_SESSION['teacherName'] ?>'
                },
                success: function (data) {
                    console.log(data);
                    try {
                        let msg = JSON.parse(data).msg;
                        if (msg === "2000") {
                            $(eol).parent().parent().remove();
                            layer.msg("操作成功！");
                        } else {
                            layer.msg("服务异常！");
                        }
                    } catch (e) {
                        console.log(data);
                        layer.msg("请求异常，请联系管理员。")
                    }
                }
            })
        }
    }


</script>

</html>
