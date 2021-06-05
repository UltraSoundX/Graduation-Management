<?php
session_start();
if (!isset($_SESSION['username']) && $_SESSION['username'] == null){
    unset($_SESSION['username']);
    $url = "https://bs.radiology.link/";
    header ( 'Location:' . $url );
}
?>
<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>毕业管理</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="http://www.sdfmu.edu.cn"><img src="http://www.sdfmu.edu.cn/static/images/logo.jpg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item">
                    <a class="nav-link" href="./graduate.php">
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
            <span class="nav-link">
                <a href="./create.php"><button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ 新建题目</button></a>
            </span>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">
                        <span class="menu-title">概览</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href="./studentmanage.php">
                        <span class="menu-title">设计题目管理</span>
                        <i class="mdi mdi-clipboard-text menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./choose.php">
                        <span class="menu-title">双向选择</span>
                        <i class="mdi mdi-vector-intersection menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./paperupload.php">
                        <span class="menu-title">论文申报/指导记录</span>
                        <i class="mdi mdi-folder-upload menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./scorequery.php">
                        <span class="menu-title">历史成绩查询/申诉</span>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./graduate.php">
                        <span class="menu-title">毕业去向申请</span>
                        <i class="mdi mdi-flag-variant menu-icon"></i>
                    </a>
                </li>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        毕业去向管理
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">毕业管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">毕业去向管理</h4>
                                <p class="card-description">
                                    请完成毕业去向管理
                                </p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-center" for = "studentNumber">学   号</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="studentNumber" placeholder=<?php echo $_SESSION['username']?> readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-center" for = "studentName">姓   名</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="studentName" placeholder="姓名" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for = "studentMajor">专   业</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="studentMajor" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label for = "uploadNumber">毕业去向选择</label>
                                        <select class ="form-control" id = "graduateOption">
                                            <option selected disabled style="display: none" value="0">请选择毕业去向</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-6">
                                        <label for = "appealText">具体信息(单位/学校/待业)</label>
                                        <input type="textarea" id="graduateSpec" class="form-control" oninput="$(this).val($(this).val().substr(0,100))">
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
</body>

<!-- plugins:js -->
<script src="./vendors/js/vendor.bundle.base.js"></script>
<script src="./vendors/js/vendor.bundle.addons.js"></script>
<!-- inject:js -->
<script src="./js/off-canvas.js"></script>
<script src="./js/misc.js"></script>
<!-- Custom js for this page-->
<script src="./js/layer.js"></script>
<!-- End custom js for this page-->


<!--suppress JSUnfilteredForInLoop, JSUnusedAssignment -->
<script type="text/javascript">
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.basicInfoInit(resolve);
        }).then(res => {
            layer.closeAll();
            if (res === "2001"){
                layer.alert("请等待成绩审阅完成结束后填写",{
                    title:"提示",
                    skin:"layui-layer-lan",
                    closeBtn:0,
                    anim:4
                },function (data){
                    layer.closeAll();
                    window.location.href = "https://bs.radiology.link/login/index.php";
                })
            } else {
                layer.msg("加载完成");
            }
        })
    })

    class pageReady {
        static basicInfoInit(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"studentGraduate",
                    "studentNumber":<?php echo $_SESSION['username'] ?>
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2001"){
                        callback("2001");
                    }
                    $("#studentName").val(JSON.parse(data).studentName);
                    $("#studentMajor").val(JSON.parse(data).studentMajor);
                    let graduateList = JSON.parse(data).graduateList;
                    for(let i in graduateList){
                        let option = "<option>" + graduateList[i] + "</option>";
                        $("#graduateOption").append(option);
                    }
                    callback("2000");
                }
            })
        }
    }

    function submit(){
        layer.alert("机会仅有一次，请谨慎填写！",{
            title:"提示",
            skin:"layui-layer-lan",
            closeBtn:0,
            anim:4,
            btn:['确定','取消']
        },function (){
            layer.closeAll();
            upload();
        })

    }

    function upload(){
        if ($("#graduateOption").val() == null){
            layer.msg("请选择就业去向！");
            return 0;
        }
        if ($("#graduateSpec").val() == ""){
            layer.msg("请填写具体信息");
            return 0;
        }
        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php",
            type:"GET",
            async:false,
            data:{
                "do":"studentGraduateSubmit",
                "studentNumber":<?php echo $_SESSION['username'] ?>,
                "studentName":$("#studentName").val(),
                "studentMajor":$("#studentMajor").val(),
                "studentJob":$("#graduateOption").val(),
                "graduateSpec":$("#graduateSpec").val()
            },
            success:function (data) {
                let msg = JSON.parse(data).msg;
                if (msg === "2001"){
                    layer.msg("您已提交过就业去向！");
                } else {
                    layer.msg("提交成功！祝您前途似锦！");
                }
            }
        })
    }


</script>

</html>
