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
    <title>成绩管理</title>
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
                        论文管理
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">成绩管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">需进行成绩管理的名单</h4>
                                <p class="card-description">
                                    请完成成绩管理操作
                                </p>
                                <div class="row">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>学生姓名</th>
                                            <th>论文编号</th>
                                            <th>论文名称</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody id="scoreList">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">成绩管理</h4>
                                <p class="card-description">
                                    请在上方选取相关学生信息
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-center" for = "studentNumber">学   号</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="studentNumber" placeholder=请选择学号 readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-center" for = "studentName">姓   名</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="studentName" placeholder="姓名" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label for = "paperTitle">论文题目</label>
                                        <input class="form-control" id="paperTitle" placeholder="论文题目" readonly/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for = "uploadNumber">论文编号</label>
                                        <input class ="form-control" id = "uploadNumber" placeholder="请选择论文编号" readonly/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class = "form-group col-md-3">
                                        <label for = "PSBX">平时表现成绩</label>
                                        <div class ="input-group">
                                            <input type="text" class="form-control" id = "PSBX" placeholder="平时表现">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-gradient-info text-white">占20%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "form-group col-md-3">
                                        <label for = "PYR">评阅人成绩</label>
                                        <div class ="input-group">
                                            <input type="text" class="form-control" id = "PYR" placeholder="评阅人成绩">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-gradient-info text-white">占20%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "form-group col-md-3">
                                        <label for = "ZDJS">指导教师成绩</label>
                                        <div class ="input-group">
                                            <input type="text" class="form-control" id = "ZDJS" placeholder="指导教师">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-gradient-info text-white">占20%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "form-group col-md-3">
                                        <label for = "DBCJ">答辩成绩</label>
                                        <div class ="input-group">
                                            <input type="text" class="form-control" id = "DBCJ" placeholder="答辩成绩">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-gradient-info text-white">占40%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg mr-2" onclick="submit()" onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">提交</button>
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
            pageReady.scoreManageInit(resolve);
        }).then(res=>{
            layer.closeAll();
            layer.msg(res);
        })
    })
    class pageReady {
        static scoreManageInit (callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"scoreManageInit",
                    "teacherName":'<?php echo $_SESSION['teacherName'] ?>',
                    "teacherMajor":'<?php echo $_SESSION['teacherMajor'] ?>'
                },
                success:function (data){
                    let scoreList = JSON.parse(data).scoreList;
                    for (let i in scoreList){
                        let scoreSolo = scoreList[i];
                        scoreAppend(scoreSolo['studentName'],scoreSolo['paperTitle'],scoreSolo['paperNumber']);
                    }
                    callback('加载成功');
                }
            })
        }
    }

    function scoreAppend(studentName,paperTitle,paperNumber){
        let btn = "<button class='btn btn-icon-append btn-sm btn-group btn-inverse-primary' onclick = 'modify(this)'> <i class='mdi mdi-settings'></i></buttion>";
        let append = `<tr><td>${studentName}</td><td>${paperNumber}</td><td>${paperTitle}</td><td>${btn}</td></tr>`;
        $("#scoreList").append(append);
    }

    function modify(eol){
        let studentNumber = $(eol).parent().prev().prev()[0].innerText.substr(0,10);
        let studentName = $(eol).parent().prev().prev().prev()[0].innerText;
        let paperTitle = $(eol).parent().prev()[0].innerText;
        let paperNumber = $(eol).parent().prev().prev()[0].innerText;
        $("#studentNumber").val(studentNumber);
        $("#studentName").val(studentName);
        $("#paperTitle").val(paperTitle);
        $("#uploadNumber").val(paperNumber);
    }

    function submit(){
        for(let i = 0;i<=7;i++){
            if ( $("input")[i].value == "" ){
                layer.msg("请完成对应信息填写！");
                return 0;
            }
        }
        let TotalScore = $("#PSBX").val() * 0.2 + $("#PYR").val() * 0.2 + $("#ZDJS").val() * 0.2 + $("#DBCJ").val() * 0.4;
        layer.alert(`请核对总成绩！总成绩为：${TotalScore}`,{
            title:"提示",
            skin:"layui-layer-lan",
            closeBtn:0,
            anim:4,
            btn:['确定','取消']
        },function (){
            layer.closeAll();
            upload(TotalScore);
        })
    }

    function upload(TotalScore){
        let PSBX = $("#PSBX").val();
        let PYR = $("#PYR").val();
        let ZDJS = $("#ZDJS").val();
        let DBCJ = $("#DBCJ").val();
        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php",
            type:"GET",
            async:false,
            data:{
                "do":"uploadScore",
                "studentNumber":$("#studentNumber").val(),
                "paperNumber":$("#uploadNumber").val(),
                "PSBX":PSBX,
                "PYR":PYR,
                "ZDJS":ZDJS,
                "DBCJ":DBCJ,
                "ZCJ":TotalScore
            },
            success:function (data){
                let msg = JSON.parse(data).msg;
                if (msg === "2000"){
                    layer.msg("成绩上传成功");
                } else {
                    layer.msg("成绩上传失败");
                }
            }
        })
    }



</script>

</html>
