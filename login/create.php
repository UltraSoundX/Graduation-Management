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
    <title>新建题目</title>
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
                    <a class="nav-link" href="./create.php">
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
                    <a class="nav-link" href="./choose.php" >
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
                        新建题目
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">新建题目</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">请新建题目</h4>
                                <p class="card-description">
                                    请及时完成相关信息填写
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
                                                <input type="text" class="form-control" id="studentName" placeholder="姓名" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for = "studentMajor">专   业</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="studentMajor" >
                                                    <option selected disabled style="display: none" value="none">请选择专业</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTitle">论文题目</label>
                                    <input type="text" class="form-control" id="paperTitle" placeholder="论文题目">
                                </div>
                                <div class="form-group row">
                                    <div class=" col-md-6">
                                        <label for = "paperFile">开题报告上传</label>
                                        <input type="file" id="paperFile" name="paperFile" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="请上传开题报告">
                                            <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">浏览</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for = "prepareStatus">开题报告完成状态</label>
                                            <select id="prepareStatus" class="form-control">
                                                <option selected disabled style="display: none" value="none">请选择开题报告完成进度</option>
                                                <option value="1">已完成</option>
                                                <option value="0">未完成</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTips">备注</label>
                                    <textarea class="form-control" id="paperTips" rows="4"></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg mr-2" onclick="createOperate.submit()">提交</button>
                                    <button class="btn btn-lg btn-light">取消</button>
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


<script type="text/javascript">

    $(document).ready(function () {
        new Promise(resolve => {
            layer.load(2);
            pageReady.checkCreate(resolve);
        }).then(res => {
            if (res === true) {
                layer.closeAll();
                window.location.href = "https://bs.radiology.link/login/index.php";
            } else {
                layer.closeAll();
                layer.msg(res);
            }
        })
    })

    class pageReady {
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
        static checkCreate(callback){
            <?php
            if ( isset($_SESSION['subject']) and $_SESSION['subject'] != "暂未申请" ){
                echo ' layer.alert("您已经新建论文！ ",{
                            title:"提示",
                            skin:"layui-layer-lan",
                            closeBtn:0,
                            anim:4
                        },function (){
                            callback(true);
                        }) 
                        ';
            } else {
                echo ' 
                        pageReady.checkMajor();
                        callback("加载完成！"); 
                        ';
            }
            ?>
        }
    }


    class createOperate {
        static fileOperate(callback){
            let file = $("#paperFile");

            let fileName = file.val();
            if (fileName === ""){
                callback('请上传文件!');
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

            let newFilename = <?php echo $_SESSION['username'] ?> + "开题报告." + fileExtend;
            let newFile = new File([file[0].files[0]],newFilename,{
                type:file[0].files[0].type
            });


            let formData = new FormData();
            formData.append("file",newFile);
            formData.append("filename",newFilename);
            formData.append("fileDes","prepare");
            $.ajax({
                type:"post",
                url : "https://bs.radiology.link/api/uploadfile.php",
                data: formData,
                async:false,
                processData:false,//不处理FormData
                contentType:false,//不改文件头
                cache:false,//上传文件不缓存
                success : function(data){
                    console.log(data); //打印data
                    let msg = JSON.parse(data).msg;
                    if (msg === "3000"){
                        createOperate.formOperate(fileExtend,callback);
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
         } //上传文件

        static formOperate(prepareType,callback){
            let studentNumber = <?php echo $_SESSION['username'] ?>;

            let studentName = $("#studentName").val();
            if (studentName === ""){callback('姓名不能为空喔😯！');}

            let studentMajor = $("#studentMajor").val();
            if (studentMajor === "none"){callback("专业必须选择喔😯！");}

            let paperTitle = $("#paperTitle").val();
            if (paperTitle === ""){callback("记得填写论文题目喔😯！");}

            let paperTips = $("#paperTips").val();

            let prepareStatus = $("#prepareStatus").val();
            if (prepareStatus === ""){callback("记得选择论文喔😯！");}


            $.ajax({
                type:"GET",
                url:"https://bs.radiology.link/api/graduation.php",
                async:false,
                data:{
                    "do":"createPaper",
                    "studentNumber":studentNumber,//学号
                    "studentName":studentName,//学生姓名
                    "studentMajor":studentMajor,//所学专业
                    "paperTitle":paperTitle,//论文标题
                    "paperTips":paperTips,//论文备注
                    "prepareType":prepareType,//开题报告后缀
                    "prepareStatus":prepareStatus//开题报告完成状态
                },
                success:function (data){
                    let msg;
                    console.log(data);
                    try{
                        console.log(data);
                        msg = JSON.parse(data).msg;
                    }
                    catch (e) {
                        console.log(data);
                        callback('服务器错误！');
                    }
                    if (msg === "2001"){
                        callback("服务器出现故障，请联系管理员");
                    } else {
                        layer.alert('创建题目成功！',{
                            skin:"layui-layer-blue",
                            title:"恭喜！",
                            closeBtn:0,
                            anim:4
                        },function () {
                            callback("创建完成！");
                        });
                    }
                },
                error:function (){
                    callback('服务器错误！');
                }
            })
        }

        static submit(){
            new Promise(resolve => {
                layer.load(2);
                createOperate.fileOperate(resolve);
            }).then(res => {
                if (res === "创建完成！") {
                    layer.closeAll();
                    window.location.href = "https://bs.radiology.link/login/index.php";
                } else {
                    layer.closeAll();
                    layer.msg(res);
                }
            });
        };
    }








</script>

</html>
