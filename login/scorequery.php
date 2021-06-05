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
    <title>成绩管理</title>
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
                    <a class="nav-link" href="./scorequery.php">
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
                        历史成绩查询/申诉
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">成绩查询</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">成绩管理/申诉</h4>
                                <p class="card-description">
                                    历史成绩查询
                                </p>
                                <canvas id="scoreChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">成绩申诉</h4>
                                <p class="card-description">
                                    如有异议，可申请成绩申诉
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
                                            <label class="col-sm-4 col-form-label" for = "teacherName">导   师</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="teacherName" placeholder="指导教师" readonly></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label for = "uploadNumber">定稿论文编号</label>
                                        <select class ="form-control" id = "uploadNumber">
                                            <option selected disabled style="display: none" value="0">请选择论文编号</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-6">
                                        <label for = "appealText">申诉信息（100字内）</label>
                                            <input type="textarea" id="appealText" class="form-control" oninput="$(this).val($(this).val().substr(0,100))">
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
<script src="./js/chart.min.js"></script>
<!-- End custom js for this page-->


<!--suppress JSUnfilteredForInLoop, JSUnusedAssignment -->
<script type="text/javascript">
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.getInfo(resolve);
        }).then(res => {
            layer.closeAll();
            layer.msg("加载完成");
        })
    })
    class pageReady{
        static getInfo(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"scoreQuery",
                    "studentNumber":<?php echo $_SESSION['username'] ?>
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2001"){
                        layer.alert("暂无成绩，请稍后再试",{title:"提示",
                            skin:"layui-layer-lan",
                            closeBtn:0,
                            anim:4
                        },function (){
                            layer.closeAll();
                            window.location.href = "https://bs.radiology.link/login/paperupload.php";
                        });
                    } else {
                        let chartTitle = "论文编号：" + JSON.parse(data).paperNumber + "成绩";
                        let scoreSets = JSON.parse(data).scoreSets;
                        pageReady.chartDraw(chartTitle,scoreSets);
                        pageReady.appealInfo(callback);
                    }
                }
            })
        }
        static chartDraw(chartTitle,scoreSets){
            let eol = $("#scoreChart");
            let scoreChart = new Chart(eol,{
                type: 'bar',
                data: {
                    labels: ["平时表现", "评阅人评分", "指导教师评分", "答辩小组评分", "综合成绩"],
                    datasets: [{
                        label: '百分制得分',
                        data: scoreSets,
                        backgroundColor: [
                            'rgba(255,99,132,0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                max:100,
                                stepSize:20,
                                beginAtZero:true
                            }
                        }]
                    },
                    title:{
                        display:true,
                        text:chartTitle,
                        fontSize:20
                    }
                }
            });
        }
        static appealInfo(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"appealInfo",
                    "studentNumber":<?php echo $_SESSION['username'] ?>
                },
                success:function (data){
                    let studentName = JSON.parse(data).studentName;
                    let teacherName = JSON.parse(data).teacherName;
                    let paperList = JSON.parse(data).paperList;
                    $("#studentName").val(studentName);
                    $("#teacherName").val(teacherName);
                    for(let i in paperList){
                        let option = "<option>" + paperList[i] + "</option>";
                        $("#uploadNumber").append(option);
                    }
                    callback();
                }
            })
        }
    }

    function submit(){
        layer.alert("上诉次数仅有一次，请妥善使用",{
            title:"提示",
            skin:"layui-layer-lan",
            closeBtn:0,
            anim:4,
            btn:['确定','取消']
        },function (){
            layer.closeAll();
            appeal();
        })
    }

    function appeal(){
        if ($("#uploadNumber").val() === null){
            layer.msg('请选择定稿论文编号！');
            return 0;
        }
        if ($("#appealText").val() === ""){
            layer.msg('请填写上诉理由！');
            return 0;
        }

        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php",
            type:"GET",
            async:false,
            data:{
                "do":"studentAppeal",
                "studentNumber":<?php echo $_SESSION['username'] ?>,
                "paperNumber":$("#uploadNumber").val(),
                "teacherName":$("#teacherName").val(),
                "appealText":$("#appealText").val()
            },
            success:function (data) {
                let msg = JSON.parse(data).msg;
                if (msg === "2000"){
                    layer.msg("已提交成绩复核，请等待申诉处理");
                } else {
                    layer.msg("已经提交过成绩复核");
                }
            }
        })
    }
</script>

</html>
