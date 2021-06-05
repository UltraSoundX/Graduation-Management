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
    <title>论文管理</title>
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
                    <a class="nav-link" href="./paperupload.php.php">
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
                        论文申报/指导记录
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">申报管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">指导记录</h4>
                                <p class="card-description">
                                    指导记录查询
                                </p>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>论文编号</th>
                                        <th>存在问题</th>
                                        <th>当前状态</th>
                                        <th>论文下载</th>
                                    </tr>
                                    </thead>

                                    <tbody id="commentList">


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">论文申报</h4>
                                <p class="card-description">
                                    请完成论文申报
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
                                        <label for = "uploadNumber">论文编号</label>
                                        <select class ="form-control" id = "uploadNumber">
                                            <option selected disabled style="display: none" value="0">请选择论文编号</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-6">
                                        <label for = "paperFile">论文上传</label>
                                        <input type="file" id="paperFile" name="paperFile" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <!--suppress HtmlFormInputWithoutLabel -->
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="请上传开题报告">
                                            <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button"
                                                    onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">浏览</button>
                                            </span>
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
</body>

<!-- plugins:js -->
<script src="./vendors/js/vendor.bundle.base.js"></script>
<script src="./vendors/js/vendor.bundle.addons.js"></script>
<!-- inject:js -->
<script src="./js/off-canvas.js"></script>
<script src="./js/misc.js"></script>
<!-- Custom js for this page-->
<script src="./js/file-upload2.js"></script>
<script src="./js/layer.js"></script>
<!-- End custom js for this page-->


<!--suppress JSUnfilteredForInLoop, JSUnusedAssignment -->
<script type="text/javascript">
    $(document).ready(function (){
        new Promise(resolve => {
            layer.load(2);
            pageReady.basicQuery(resolve);
        }).then(res => {
            layer.closeAll();
            layer.msg(res);
        })
    })

    class pageReady {
        static basicQuery(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"paperBasicQuery",
                    "studentNumber":<?php echo $_SESSION['username']; ?>
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2001"){
                        layer.alert("请等待双选完成后操作或联系系统管理员！");
                        setTimeout(()=>{
                            window.location.href = "https://bs.radiology.link/login/choose.php";
                        },2000);
                    } else {
                        $("#studentName").val( JSON.parse(data).studentName );
                        $("#teacherName").val( JSON.parse(data).teacherName );
                        pageReady.numberQuery();
                        pageReady.commentQuery();
                        callback("加载完成！");
                    }
                }
            })
        }
        static numberQuery(){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"paperNumberQuery",
                    "studentNumber":<?php echo $_SESSION['username']; ?>
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg === "2001"){
                        layer.alert("请等待双选工作完成！",{},function (){
                            layer.closeAll();
                            window.location.href = "https://bs.radiology.link/login/index.php";
                        })
                    }
                    if (msg === "2000"){
                        let paperList = JSON.parse(data).paperList;
                        for (let i in paperList){
                            let option = "<option>" + paperList[i] + "</option>";
                            $("#uploadNumber").append(option);
                        }
                    }
                }
            })
        }
        static commentQuery(){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                async:false,
                type:"GET",
                data:{
                    "do":"paperCommentQuery",
                    "studentNumber":<?php echo $_SESSION['username']; ?>
                },
                success:function (data){
                    let commentList = JSON.parse(data).commentList;
                    for (let i in commentList){
                        let label = 0;
                        let download = 0;
                        if (commentList[i]['paperStatus'] === "等待上传"){
                            label = '<label class="badge badge-warning">等待上传</label>';
                            download = '<button class="btn btn-rounded btn-sm btn-gradient-danger">当前状态不支持下载</button>';
                        }
                        if (commentList[i]['paperStatus'] === "等待批阅"){
                            label = '<label class="badge badge-info">等待批阅</label>';
                            download = '<button class="btn btn-rounded btn-sm btn-gradient-danger">当前状态不支持下载</button>';
                        }
                        if (commentList[i]['paperStatus'] === "存在问题"){
                            label = '<label class="badge badge-danger">存在问题</label>';
                            let paperName = commentList[i]['paperNumber'] + "." +commentList[i]['paperType'];
                            let link = "'https://bs.radiology.link/api/paper_upload/"+paperName + "'" ;
                            download = '<button class="btn btn-rounded btn-sm btn-inverse-danger" onclick=window.open('+link+')>下载</button>';;
                        }
                        if (commentList[i]['paperStatus'] === "审核通过"){
                            label = '<label class="badge badge-success">审核通过</label>';
                            let paperName = commentList[i]['paperNumber'] + "." +commentList[i]['paperType'];
                            let link = "'https://bs.radiology.link/api/paper_upload/"+paperName + "'" ;
                            download = '<button class="btn btn-rounded btn-sm btn-inverse-success" onclick=window.open('+link+')>下载</button>';;
                        }
                        let paperQues = commentList[i]['paperQues'].replace(/;|；/g,'<br><br>');
                        let template = "<tr><td>"+commentList[i]['paperNumber']+"</td><td>"+paperQues+'</td><td>'+ label +'</td><td>'+download+'</td></tr>';
                        $("#commentList").append(template);
                    }
                }
            })
        }
    }

    function submit(){
        new Promise(resolve => {
            layer.load(2);
            pageFinish.fileUpload(resolve);
        }).then(res=>{
            layer.closeAll();
            if (res == "上传成功！")window.location.reload();
            layer.msg(res);
        })
    }

    class pageFinish{

        static fileUpload(callback){
            let file = $("#paperFile");

            let fileName = file.val();
            if (fileName === ""){
                callback("文件名不能为空！");
                return false;
            }

            let fileExtend = fileName.substring(fileName.lastIndexOf(".") + 1).toLowerCase();
            if (fileExtend !== "docx" && fileExtend !== "doc"){
                callback("请上传Word文件！");
                return false;
            }

            let fileSize = file[0].files[0].size;
            if (fileSize > 3145728){
                callback("上传文件不能大于3M！");
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
                        pageFinish.formOperate(fileExtend,callback);
                        return true;
                    } else {
                        callback("上传失败");
                        return false;
                    }
                },
                error : function (){
                    callback("服务器故障！");
                    return false;
                }
            })
        }
        static formOperate(fileExtend,callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"studentPaperUpload",
                    "paperNumber":$("#uploadNumber").val(),
                    "paperType":fileExtend
                },
                success:function (data){
                    let msg = JSON.parse(data).msg;
                    if (msg == "2000"){
                        callback("上传成功！");
                    } else {
                        callback("服务器故障！");
                    }
                }
            })
        }
    }

</script>

</html>
