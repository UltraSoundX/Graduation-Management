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
    <title>双选管理</title>
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
                                                <select class="form-control" id="studentMajor" disabled></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paperTitle">论文题目</label>
                                            <input type="text" class="form-control" id="paperTitle" placeholder="论文题目" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paperTitle">导师选择</label>
                                            <select class ="form-control" id="teacherList">
                                                <option selected disabled style="display: none" value="none">请选择导师</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTips" >备注</label>
                                    <textarea class="form-control" id="paperTips" rows="4" readonly></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg mr-2" onclick="chooseOperate.submit()" onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">提交</button>
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
<script src="./js/file-upload.js"></script>
<script src="./js/layer.js"></script>
<!-- End custom js for this page-->


<!--suppress JSUnfilteredForInLoop, JSUnusedAssignment -->
<script type="text/javascript">

    $(document).ready(function () {
        new Promise(resolve => {
            layer.load(2);
            pageReady.downloadPrepare(resolve);
        }).then(res => {
            layer.closeAll();
            if (res === "请新建题目！"){
                layer.msg(res);
                setTimeout(() => {window.location.href = "https://bs.radiology.link/login/create.php"},2000);
            }
            if( res == "pass"){
                layer.alert("恭喜您通过双选环节",{
                    title:"提示",
                    skin:"layui-layer-lan",
                    closeBtn:0,
                    anim:4
                },function (){
                    window.location.href="https://bs.radiology.link/login/paperupload.php";
                })
            }
            if (res == "refresh"){
                layer.alert("您已经完成双选流程，请等待教师审核！",{
                    title:"提示",
                    skin:"layui-layer-lan",
                    closeBtn:0,
                    anim:4
                },function (){
                    window.location.href="https://bs.radiology.link/login/index.php";
                })
            }
        })
    })

    class pageReady {
        static checkStatus(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"chooseStatus",
                    "studentNumber":<?php echo $_SESSION['username']; ?>,
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2000"){
                        callback("refresh");
                    }
                    if (msg === "2100"){
                        callback("pass");
                    }
                }
            })
        }
        static downloadPrepare(callback){
            this.checkStatus(callback);
            this.studentManage(callback);
            this.checkMajor();
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"downloadPrepare",
                    "username":<?php echo $_SESSION['username']; ?>,
                },
                success:function (data){
                    let parse = JSON.parse(data);
                    for(let key in parse){
                        if (data[key] === "2001")callback('请新建题目！');
                        DivManage("#"+key,parse[key]);
                    }
                    pageReady.checkTeacher();
                    callback("加载完成");
                }
            })
        }

        static checkMajor(){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"checkMajor",
                },
                success:function (data){ //JSON:"{"list":[["医学信息工程"],["眼视光学"]]}"
                    let list = JSON.parse(data).list; //[["医学信息工程"],["眼视光学"]]
                    for (let i in list){
                        let option = "<option>" + list[i] + "</option>";
                        $("#studentMajor").append(option);
                    }
                }
            });
        }

        static checkTeacher(){
            let studentMajor = $("#studentMajor").val();
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"checkTeacher",
                    "major":studentMajor
                },
                success:function (data){ //JSON:"{"list":[["医学信息工程"],["眼视光学"]]}"
                    let list = JSON.parse(data).list; //[["医学信息工程"],["眼视光学"]]
                    for (let i in list){
                        let option = "<option>" + list[i] + "</option>";
                        $("#teacherList").append(option);
                    }
                }
            });
        }

        static studentManage(callback){
            <?php
            if ( !isset($_SESSION['subject']) and $_SESSION['subject'] === "暂未申请" ){
                echo ' layer.alert("请新建论文后进行管理",{
                            title:"提示",
                            skin:"layui-layer-lan",
                            closeBtn:0,
                            anim:4
                        },function (){
                            callback("请新建题目！");
                        }) 
                        ';
            }
            ?>
        }
    }


    class chooseOperate {
        static uploadOperate(callback){
            let studentNumber = <?php echo $_SESSION['username'] ?>;
            let studentName = $("#studentName").val();
            let paperTitle = $("#paperTitle").val();
            let major = $("#studentMajor").val();
            let teacherName = $("#teacherList").val();
            if (teacherName === null ){
                callback("请选择导师");
            }
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"studentChooseUpload",
                    "studentNumber":studentNumber,
                    "studentName":studentName,
                    "paperTitle":paperTitle,
                    "major":major,
                    "teacherName":teacherName
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2000"){
                        callback("创建完成！");
                    } else {
                        callback("未知错误");
                    }
                }
            })

        }

        static submit(){
            new Promise(resolve => {
                layer.load(2);
                chooseOperate.uploadOperate(resolve);
            }).then(res => {
                if (res === "创建完成！") {
                    layer.closeAll();
                    window.location.reload();
                } else {
                    layer.closeAll();
                    layer.msg(res);
                }
            });
        };
    }

    function DivManage(eol,text){
        $(eol).val(text);
    }



</script>

</html>
