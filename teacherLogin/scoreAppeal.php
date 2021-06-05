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
    <title>成绩申诉</title>
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
                    <a class="nav-link" href="./paperManage.php">
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
                        成绩申诉
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">成绩申诉</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">需进行成绩申诉的名单</h4>
                                <p class="card-description">
                                    请完成成绩申诉操作
                                </p>
                                <div class="row">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>学生姓名</th>
                                            <th>论文编号</th>
                                            <th>论文题目</th>
                                            <th>申诉信息</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody id="appealList">


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
<script src="../login/js/layer.js"></script>
<!-- End custom js for this page-->
<style>
</style>
</body>
<script>
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.appealManageInit(resolve);
        }).then(res => {
            layer.closeAll();
            layer.msg(res);
        })
    })
    class pageReady {
        static appealManageInit (callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"appealManageInit",
                    "teacherName":'<?php echo $_SESSION['teacherName'] ?>',
                    "teacherMajor":'<?php echo $_SESSION['teacherMajor'] ?>'
                },
                success:function (data){
                    let appealList = JSON.parse(data).appealList;
                    for (let i in appealList){
                        let appealSolo = appealList[i];
                        appealAppend(appealSolo['studentName'],appealSolo['paperNumber'],appealSolo['paperTitle'],appealSolo['appealText']);
                    }
                    callback("加载成功");
                }
            })
        }
    }

    function appealAppend(studentName,paperNumber,paperTitle,appealText){
        let btn = "<button class='btn btn-icon-append btn-sm btn-group btn-inverse-success' onclick = 'modify(this)'> <i class='mdi mdi-check'></i></buttion>";
        let btn2 = "<button class='btn btn-icon-append btn-sm btn-group btn-inverse-danger' onclick = 'modify(this)'> <i class='mdi mdi-close'></i></buttion>";
        let btn3 = btn + btn2;
        appealText = appealText.replace(/.{9}\x01?/g,"$&<br>");
        let append = `<tr><td>${studentName}</td><td>${paperNumber}</td><td>${paperTitle}</td><td>${appealText}</td><td>${btn3}</td></tr>`;
        $("#appealList").append(append);
    }

    function modify(eol) {
        let status = $(eol)[0].innerHTML;
        let paperNumber = $(eol).parent().prev().prev().prev()[0].innerText;
        let studentNumber = paperNumber.substr(0,10);
        console.log(paperNumber);
        if (status.indexOf('check') != -1){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"appealModify",
                    "agree":'1',
                    "paperNumber":paperNumber,
                    "studentNumber":studentNumber
                },
                success:function (data){
                    console.log(data);
                    let msg = JSON.parse(data).msg;
                    if (msg == "2000"){
                        layer.msg('操作成功');
                        window.location.reload();
                    } else {
                        layer.msg('操作失败');
                    }
                }
            })
        } else {
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"appealModify",
                    "agree":'0',
                    "paperNumber":paperNumber,
                    "studentNumber":studentNumber
                },
                success:function (data){
                    console.log(data);
                    let msg = JSON.parse(data).msg;
                    if (msg == "2000"){
                        layer.msg('操作成功');
                        window.location.reload();
                    } else {
                        layer.msg('操作失败');
                    }
                }
            })
        }
    }


</script>

</html>
