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
<<<<<<< HEAD
    <title>题目更改</title>
=======
    <title>Home</title>
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
<<<<<<< HEAD
                <li class="nav-item">
                    <a class="nav-link" href="./studentmanage.php.php">
=======
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
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
                <li class="nav-item active">
                    <a class = "nav-link" href="./studentmanage.php">
                        <span class="menu-title">设计题目管理</span>
                        <i class="mdi mdi-clipboard-text menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link" href="./choose.php">
=======
                    <a class="nav-link" href="pages/icons/mdi.html">
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                        <span class="menu-title">双向选择</span>
                        <i class="mdi mdi-vector-intersection menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link" href="./paperupload.php">
                        <span class="menu-title">论文申报/指导记录</span>
=======
                    <a class="nav-link" href="pages/icons/mdi.html">
                        <span class="menu-title">论文申报</span>
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                        <i class="mdi mdi-folder-upload menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link" href="./scorequery.php">
                        <span class="menu-title">历史成绩查询/申诉</span>
=======
                    <a class="nav-link" href="pages/forms/basic_elements.html">
                        <span class="menu-title">指导记录</span>
                        <i class="mdi mdi-chart-pie menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartjs.html">
                        <span class="menu-title">历史成绩查询</span>
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link" href="./graduate.php">
=======
                    <a class="nav-link" href="pages/tables/basic-table.html">
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
                        设计题目管理
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">概览</a></li>
                            <li class="breadcrumb-item active" aria-current="page">题目管理</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">论文信息修改</h4>
                                <p class="card-description">
                                    请核对论文信息
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
<<<<<<< HEAD
                                                <input type="text" class="form-control" id="studentName" placeholder="姓名" readonly/>
=======
                                                <input type="text" class="form-control" id="studentName" placeholder="姓名" onchange="listenChange($(this))"/>
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for = "studentMajor">专   业</label>
                                            <div class="col-sm-8">
<<<<<<< HEAD
                                                <select class="form-control" id="studentMajor" disabled>
=======
                                                <select class="form-control" id="studentMajor" onchange="listenChange($(this))">
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                                                    <option selected disabled style="display: none" value="none">请选择专业</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTitle">论文题目</label>
<<<<<<< HEAD
                                    <input type="text" class="form-control" id="paperTitle" placeholder="论文题目">
=======
                                    <input type="text" class="form-control" id="paperTitle" placeholder="论文题目" onchange="listenChange($(this))">
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                                </div>
                                <div class="form-group row">
                                    <div class=" col-md-6">
                                        <label for = "paperFile">开题报告上传</label>
                                        <input type="file" id="paperFile" name="paperFile" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <!--suppress HtmlFormInputWithoutLabel -->
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="请上传开题报告">
                                            <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button" onclick="layer.alert('您正在试图覆盖历史版本，请确认！')"
                                            onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">浏览</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for = "prepareStatus">开题报告完成状态</label>
<<<<<<< HEAD
                                        <select id="prepareStatus" class="form-control">
=======
                                        <select id="prepareStatus" class="form-control" onchange="listenChange($(this))">
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                                            <option selected disabled style="display: none" value="none">请选择开题报告完成进度</option>
                                            <option value="1">已完成</option>
                                            <option value="0">未完成</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paperTips" >备注</label>
<<<<<<< HEAD
                                    <textarea class="form-control" id="paperTips" rows="4"></textarea>
=======
                                    <textarea class="form-control" id="paperTips" rows="4" onchange="listenChange($(this))"></textarea>
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg mr-2" onclick="createOperate.submit()" onmouseover="$(this).addClass('btn-gradient-danger')" onmouseleave="$(this).removeClass('btn-gradient-danger')">确认修改</button>
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


<!--suppress JSUnfilteredForInLoop, JSUnusedAssignment -->
<script type="text/javascript">

<<<<<<< HEAD
=======
    var studentName = studentMajor = paperTitle = prepareStatus = paperTips = "before";

>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
<<<<<<< HEAD
            if (res === "已经完成双选，无法进行题目修改"){
                layer.msg("已经完成双选，无法进行题目修改");
                setTimeout(() => {window.location.href = "https://bs.radiology.link/login/index.php"},500);
            }
=======
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
            layer.msg(res);
        })
    })

<<<<<<< HEAD
    class pageReady {
        static checkChoose(callback){
            $.ajax({
                url:"https://bs.radiology.link/api/graduation.php",
                type:"GET",
                async:false,
                data:{
                    "do":"overview",
                    "username":<?php echo $_SESSION['username']; ?>,
                },
                success:function (data){
                    let chose = JSON.parse(data).chose;
                    if (chose != 0){
                        callback("已经完成双选，无法进行题目修改");
                    }
                }
            })
        }

        static downloadPrepare(callback){
            this.checkChoose(callback);
=======
    function listenChange(eol){
        switch (eol[0].id){
            case "studentName":
                studentName = eol.val();
                return 0;
            case "studentMajor":
                studentMajor = eol.val();
                return 0;
            case "paperTitle":
                paperTitle = eol.val();
                return 0;
            case "prepareStatus":
                prepareStatus = eol.val();
                return 0;
            case "paperTips":
                paperTips = eol.val();
                return 0;
        }
    }

    class pageReady {
        static downloadPrepare(callback){
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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


    class createOperate {
        static fileOperate(callback){

            let file = $("#paperFile");

            let fileName = file.val();
            if (fileName === ""){
<<<<<<< HEAD
                callback("文件名不能为空！");
=======
                createOperate.formOperate("before",callback);//TODO:未上传文件
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
<<<<<<< HEAD
            formData.append("fileDes","prepare");
=======
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
            $.ajax({
                type:"post",
                url : "https://bs.radiology.link/api/uploadfile.php",
                data: formData,
                async:false,
                processData:false,//不处理FormData
                contentType:false,//不改文件头
                cache:false,//上传文件不缓存
                success : function(data){
<<<<<<< HEAD
=======
                    //console.log(data); //打印data
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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

<<<<<<< HEAD
=======
            let studentName = $("#studentName").val();
            if (studentName === ""){callback('姓名不能为空喔😯！');}

            let studentMajor = $("#studentMajor").val();
            if (studentMajor === "none"){callback("专业必须选择喔😯！");}

>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
            let paperTitle = $("#paperTitle").val();
            if (paperTitle === ""){callback("记得填写论文题目喔😯！");}

            let paperTips = $("#paperTips").val();

<<<<<<< HEAD
            let prepareStatus = $("#prepareStatus").val();
            if (prepareStatus === ""){callback("记得选择完成状态喔😯！");}
=======
            let prepareStatus = $("#paperStatus").val();
            if (prepareStatus === ""){callback("记得选择论文喔😯！");}

>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb

            $.ajax({
                type:"GET",
                url:"https://bs.radiology.link/api/graduation.php",
                async:false,
                data:{
                    "do":"changePaper",
                    "studentNumber":studentNumber,//学号
<<<<<<< HEAD
=======
                    "studentName":studentName,//学生姓名
                    "studentMajor":studentMajor,//所学专业
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                    "paperTitle":paperTitle,//论文标题
                    "paperTips":paperTips,//论文备注
                    "prepareType":prepareType,//开题报告后缀
                    "prepareStatus":prepareStatus//开题报告完成状态
                },
                success:function (data){
                    let msg;
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
<<<<<<< HEAD
                        layer.alert('修改题目成功！',{
=======
                        layer.alert('创建题目成功！',{
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                            skin:"layui-layer-blue",
                            title:"恭喜！",
                            closeBtn:0,
                            anim:4
                        },function () {
<<<<<<< HEAD
                            callback("修改完成！");
=======
                            callback("创建完成！");
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
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
<<<<<<< HEAD
                if (res === "修改完成！") {
=======
                if (res === "创建完成！") {
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
                    layer.closeAll();
                    window.location.href = "https://bs.radiology.link/login/index.php";
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
