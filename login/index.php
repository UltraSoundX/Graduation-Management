<?php
    session_start();
    if (!isset($_SESSION['username']) && $_SESSION['username'] == null){
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
<title>Home</title>
<!-- plugins:css -->
<link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- inject:css -->
<link rel="stylesheet" href="css/style.css">
<!-- endinject -->
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
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline text-info"></i>
              <span class="count-symbol bg-danger"></span><!-- 新消息提示 -->
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">消息提示</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-clock-alert"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">您有一个新消息</h6>
                  <p class="text-gray ellipsis mb-0">
                    消息内容
                  </p>
                </div>
              </a>
            </div>
          </li>
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
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">设计题目管理</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-clipboard-text menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
              <span class="menu-title">双向选择</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-vector-intersection menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <span class="menu-title">论文申报</span>
              <i class="mdi mdi-folder-upload menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-title">指导记录</span>
              <i class="mdi mdi-chart-pie menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-title">历史成绩查询</span>
              <i class="mdi mdi-chart-areaspline menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
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
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
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
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3" >论文课题
                    <i class="mdi mdi-chevron-double-right mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5" id = "subject">暂未申请</h2>
                  <h6 class="card-text">请及时上传</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">当前进度
                    <i class="mdi mdi-playlist-check mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5" id = "status">双向选择</h2>
                  <h6 class="card-text">请及时处理</h6>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">项目概览</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <i class="mdi mdi-calendar icon-sm"></i>
                                            项目进度
                                        </th>
                                        <th>
                                            <i class="mdi mdi-comment-processing icon-sm"></i>
                                            具体信息
                                        </th>
                                        <th>
                                            <i class="mdi mdi-flash icon-sm"></i>
                                            当前状态
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="card-columns">开题申请</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-columns" id = "title">请新建题目</h5>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-success">已完成</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="card-columns">双向选择</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-columns" id = "choseMsg" >待导师同意</h5>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-warning" id = "chose">处理中</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="card-columns">论文上传</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-columns" id = "uploadmsg">暂未上传</h5>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-danger" id = "upload">未完成</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="card-columns">指导意见</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-columns" id ="commentmsg">暂无内容</h5>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-danger" id ="comment">未完成</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="card-columns">毕业去向</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-columns" id = "graduatemsg">暂未完成</h5>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-danger" id = "graduate">未完成</label>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
<style>
</style>
</body>
<script>
    var subject = null ; //定义课题标题
    var status = null;//内容进度

    class Tools{
        static ChangeClass(classTag,className) {
            $(classTag).removeClass();
            $(classTag).addClass(className);
        }
    }

    $(document).ready(function () {
        index_query();
        overview();
    })

    function index_query() {
        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php",
            type:"GET",
            async:false,
            data:{
                "do":"index_query",
                "username":<?php echo $_SESSION['username']?>
            },
            success:function (data) {
                let msg = JSON.parse(data).msg;
                if (msg === "2001"){
                    subject = "暂未申请";
                    status = "新建项目";
                    $("#subject").html(subject);
                    $("#status").html(status);
                } else {
                    subject = JSON.parse(data).subject;
                    status = JSON.parse(data).status;
                    $("#subject").html(subject);
                    $("#status").html(status);
                }
            }
        })
    }

    function overview() {
        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php/",
            type:"GET",
            async:false,
            data:{
                "do":"overview",
                "username": <?php echo $_SESSION['username']?>
            },
            success:function (data) {
                let recv = new Array(5);
                let i = 0;
                $.each($.parseJSON(data),function (key,value){
                    recv[i] = value;
                    i++;
                })
                if (recv[0] === "2001") {
                    Tools.ChangeClass("label","badge badge-gradient-danger")
                    $("label").html("未完成");
                } else if (recv[0] === "2000") {
                    $('#title').html(subject);
                    switch (recv[1]){
                        case "-1":
                            break;
                        case "0":
                            $("#choseMsg").html("请完成双向选择");
                            $("#chose").html("未完成");
                            Tools.ChangeClass("#chose","badge badge-gradient-danger");
                            break;
                        case "1":
                            $("#choseMsg").html("双向选择已完成");
                            $("#chose").html("已完成");
                            Tools.ChangeClass("#chose","badge badge-gradient-success");
                            break;
                    }
                    switch (recv[2]){
                        case "0":break;
                        case "1":
                            $("#uploadmsg").html("已经上传");
                            $("#upload").html("已完成");
                            Tools.ChangeClass("#upload","badge badge-gradient-success");
                            break;
                    }
                    switch (recv[3]){
                        case "-1":
                            $("#commentmsg").html("已经更新，请注意查收");
                            Tools.ChangeClass("#comment","badge badge-gradient-warning");
                            $("#comment").html("待完成");
                            break;
                        case "0":break;
                        case "1":
                            $("#commentmsg").html("导师已经结束修改流程");
                            Tools.ChangeClass("#comment","badge badge-gradient-success");
                            $("#comment").html("已完成");
                            break;
                    }
                    switch (recv[4]){
                        case "0":break;
                        case "1":
                            Tools.ChangeClass("#graduate","badge badge-gradient-success");
                            $("#graduatemsg").html("恭喜毕业🎉 ！");
                            $("#graduate").html("已完成");
                            break;
                    }


                }
            }
        })
    }


</script>

</html>
