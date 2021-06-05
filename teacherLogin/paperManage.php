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
    <title>论文管理</title>
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
                            <li class="breadcrumb-item active" aria-current="page">论文管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">需审阅论文名单</h4>
                                <p class="card-description">
                                    请完成论文管理操作
                                </p>
                                <div class="row">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>学生姓名</th>
                                            <th>论文编号</th>
                                            <th>论文名称</th>
                                            <th>上次存在问题</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody id="paperList">


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
                                <h4 class="card-title">论文审阅</h4>
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
                                    <div class="form-group col-md-12">
                                        <label for = "paperTitle">论文题目</label>
                                        <input class="form-control" id="paperTitle" placeholder="论文题目" readonly/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for = "uploadNumber">论文编号</label>
                                        <input class ="form-control" id = "uploadNumber" placeholder="请选择论文编号" readonly/>
                                    </div>
                                    <div class=" col-md-6">
                                        <label for = "paperFile">批注后论文上传</label>
                                        <input type="file" id="paperFile" name="paperFile" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <!--suppress HtmlFormInputWithoutLabel -->
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="请上传批注后论文">
                                            <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button"
                                                    onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">浏览</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTips">存在问题 ( 问题和问题间请用 分号 分隔 )</label>
                                    <textarea class="form-control" id="paperQues" rows="15"></textarea>
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
<script src="../login/js/file-upload.js"></script>
<!-- End custom js for this page-->
<style>
</style>
</body>
<script>
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.listInit(resolve);
        }).then(res => {
            layer.closeAll();
            if (res == 2000){
                layer.msg("加载完成");
            }
            if (res == 9999){
                layer.msg("系统错误");
            }
        })
    })

    function submit(){
       pageFinish.fileUpload();
    }

    class pageFinish{
        static fileUpload(){
            let file = $("#paperFile");

            let fileName = file.val();
            if (fileName === ""){
                layer.msg("文件名不能为空！");
                return false;
            }

            let fileExtend = fileName.substring(fileName.lastIndexOf(".") + 1).toLowerCase();
            if (fileExtend !== "docx" && fileExtend !== "doc"){
                layer.msg("请上传Word文件！");
                return false;
            }

            let fileSize = file[0].files[0].size;
            if (fileSize > 3145728){
                layer.msg("上传文件不能大于3M！");
                return false;
            }

            if ($("#uploadNumber").val() == ""){
                layer.msg("请选择学生信息");
                return false;
            }
            let newFilename = $("#uploadNumber").val() + "." +fileExtend;
            let newFile = new File([file[0].files[0]],newFilename,{
                type:file[0].files[0].type
            });

            let formData = new FormData();
            formData.append("file",newFile);
            formData.append("filename",newFilename);
            formData.append("fileDes","paper");
            $.ajax({
                type:"post",
                url : "https://bs.radiology.link/api/uploadfile.php",
                data: formData,
                async:false,
                processData:false,//不处理FormData
                contentType:false,//不改文件头
                cache:false,//上传文件不缓存
                success : function(data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "3000"){
                        pageFinish.formOperate(fileExtend);
                        return true;
                    } else {
                        layer.msg("上传失败");
                        return false;
                    }
                },
                error : function (){
                    layer.msg("服务器故障！");
                    return false;
                }
            })
        }
        static formOperate(fileExtend){
            let paperQues = $("#paperQues").val().replace(/\n/g,"");
            let paperNumber = $("#uploadNumber").val();
            if (paperNumber == "" || paperQues == ""){
                layer.msg ("请填写相关信息");
                return 0;
            }
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"teacherPaperUpload",
                    "paperType":fileExtend,
                    "paperQues":paperQues,
                    "paperNumber":paperNumber,
                },
                success:function (data){
                    try{
                        let msg = JSON.parse(data).msg;
                        if (msg === "2000"){
                            layer.msg("提交成功");
                            window.location.reload();
                        } else {
                            layer.msg("提交失败");
                        }
                    } catch(e) {
                        layer.msg("提交失败");
                    }
                }
            })
        }
    }

    class pageReady {
        static listInit (callback) {
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"teacherPaperInit",
                    "teacherName":'<?php echo $_SESSION['teacherName']?>',
                    "teacherMajor":'<?php echo $_SESSION['teacherMajor']?>'
                },
                success:function (data){
                    try{
                        let studentList = JSON.parse(data).studentList;
                        for (let i in studentList){
                            let studentInfo = studentList[i];
                            let paperQues = studentInfo['paperQues'].replace(/;|；/g,"<br>");
                            pageReady.listAppend(studentInfo['studentName'],studentInfo['paperNumber'],studentInfo['paperTitle'],paperQues,studentInfo['paperType']);
                        }
                        callback(2000);
                    } catch (e) {
                        callback(9999);
                    }
                }
            })
        }

        static listAppend(studentName,paperNumber,paperTitle,paperQues,paperType){
            let DownloadLink = `https://bs.radiology.link/api/paper_upload/${paperNumber}.${paperType}`;

            let operation1 = "<button class='btn btn-icon-append btn-sm btn-group btn-inverse-primary' onclick = 'operate(this)'> <i class='mdi mdi-settings'></i></buttion>";
            let operation2 =`<button class='btn btn-icon-append btn-sm btn-group btn-inverse-info' onclick="window.open('${DownloadLink}')"> <i class='mdi mdi-folder-download'></i></buttion>`;
            let operation3 ="<button class='btn btn-icon-append btn-sm btn-group btn-inverse-success' onclick='operate(this)'> <i class='mdi mdi-file-check'></i></buttion>";
            let operation = operation1 + operation2 + operation3;

            let appendContent = `<tr><td>${studentName}</td><td>${paperNumber}</td><td>${paperTitle}</td><td><label class = "badge badge-gradient-info">${paperQues}</label></td><td>${operation}</td></tr>`;
            $("#paperList").append(appendContent);
        }

    }
    function operate(eol){
        let operate = $(eol)[0].innerHTML;
        let studentName = $(eol).parent().prev().prev().prev().prev()[0].innerText;
        let paperTitle = $(eol).parent().prev().prev()[0].innerText;
        let paperNumber = $(eol).parent().prev().prev().prev()[0].innerText;
        let studentNumber = paperNumber.substr(0,10);

        if (operate.indexOf('settings') != -1) {
            layer.msg("请在下方继续完成审阅操作");
            $("#studentNumber").val(studentNumber);
            $("#studentName").val(studentName);
            $("#paperTitle").val(paperTitle);
            $("#uploadNumber").val(paperNumber);
        } else {
            layer.alert("请确定是否将该论文定稿！",{
                title:"提示",
                skin:"layui-layer-lan",
                closeBtn:0,
                anim:4,
                btn:['确定','取消']
            },function (){
                layer.closeAll();
                layer.msg("正在进行定稿操作...");
                paperFinish(paperNumber);
            });
        }
    }

    function paperFinish(paperNumber){
        let studentNumber = $("#studentNumber").val();
        $.ajax({
            url:"https://bs.radiology.link/api/graduation.php",
            type:"GET",
            async:false,
            data:{
                "do":"paperFinish",
                "studentNumber":studentNumber,
                "paperNumber":paperNumber
            },
            success:function (data){
                console.log(data);
                let msg = JSON.parse(data).msg;
                if (msg == "2000"){
                    layer.msg("定稿完成");
                    setTimeout(()=>{
                        window.location.reload();
                    },1200);
                } else {
                    layer.msg("服务器异常");
                    setTimeout(()=>{
                        window.location.reload();
                    },1200);
                }
            }
        })
    }




</script>

</html>
