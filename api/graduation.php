<?php
require_once("handler.php");
header('Access-Control-Allow-Origin:*');
$do = "";

if(isset($_GET["do"]))
    $do = $_GET["do"];

switch($do){

    default:
        echo "Welcome To RestHandler Ver 0.1";
        break;
 
    case "login":
        // 处理 Login /
        $username = $_GET["username"];
        $password = $_GET["password"];
        $RestHandler = new RestHandler();
        $RestHandler->login($username,$password);
        break;

    case "register":
        // 处理 Register /
        $username = $_GET["username"];
        $password = $_GET["password"];
        $RestHandler = new RestHandler();
        $RestHandler->register($username,$password);
        break;

    case "index_query":
        // 首页三项查询 /
        $RestHandler = new RestHandler();
        $RestHandler -> index_query($_GET['username']);
        break;

    case "overview":
        // 概览 /
        $RestHandler = new RestHandler();
        $RestHandler -> overview($_GET['username']);
        break;

    case "checkMajor":
        // 检查是专业列表 /
        $RestHandler = new RestHandler();
        $RestHandler -> checkMajor();
        break;

    case "createPaper":
        $RestHandler = new RestHandler();
        $RestHandler -> createPaper($_GET);
        break;

    case "downloadPrepare":
        $RestHandler = new RestHandler();
        $RestHandler -> downloadPrepare($_GET['username']);
        break;

    case "changePaper":
<<<<<<< HEAD
        $RestHandler = new RestHandler();
        $RestHandler -> changePaper($_GET);
        break;

    case "checkTeacher":
        $RestHandler = new RestHandler();
        $RestHandler -> checkTeacher($_GET['major']);
        break;

    case "studentChooseUpload":
        $RestHandler = new RestHandler();
        $RestHandler -> studentChooseUpload($_GET);
        break;

    case "chooseStatus":
        $RestHandler = new RestHandler();
        $RestHandler -> chooseStatus($_GET['studentNumber']);
        break;

    case "paperBasicQuery":
        $RestHandler = new RestHandler();
        $RestHandler -> paperBasicQuery($_GET['studentNumber']);
        break;

    case "paperNumberQuery":
        $RestHandler = new RestHandler();
        $RestHandler -> paperNumberQuery($_GET['studentNumber']);
        break;

    case "paperCommentQuery":
        $RestHandler = new RestHandler();
        $RestHandler -> paperCommentQuery($_GET['studentNumber']);
        break;

    case "studentPaperUpload":
        $RestHandler = new RestHandler();
        $RestHandler -> studentPaperUpload($_GET);
        break;

    case "scoreQuery":
        $RestHandler = new RestHandler();
        $RestHandler -> scoreQuery($_GET['studentNumber']);
        break;

    case "appealInfo":
        $RestHandler = new RestHandler();
        $RestHandler -> appealInfo($_GET['studentNumber']);
        break;

    case "studentAppeal":
        $RestHandler = new RestHandler();
        $RestHandler -> studentAppeal($_GET);
        break;

    case "studentGraduate":
        $RestHandler = new RestHandler();
        $RestHandler -> studentGraduate($_GET['studentNumber']);
        break;

    case "studentGraduateSubmit":
        $RestHandler = new RestHandler();
        $RestHandler -> studentGraduateSubmit($_GET);
        break;

    case "teacherChooseQuery":
        $RestHandler = new RestHandler();
        $RestHandler -> teacherChooseQuery($_GET);
        break;

    case "teacherChoose":
        $RestHandler = new RestHandler();
        $RestHandler -> teacherChoose($_GET);
        break;

    case "teacherPaperInit":
        $RestHandler = new RestHandler();
        $RestHandler -> teacherPaperInit($_GET);
        break;

    case "teacherPaperUpload":
        $RestHandler = new RestHandler();
        $RestHandler -> teacherPaperUpload($_GET);
        break;

    case "paperFinish":
        $RestHandler = new RestHandler();
        $RestHandler -> paperFinish($_GET);
        break;

    case "scoreManageInit":
        $RestHandler = new RestHandler();
        $RestHandler -> scoreManageInit($_GET);
        break;

    case "uploadScore":
        $RestHandler = new RestHandler();
        $RestHandler -> uploadScore($_GET);
        break;

    case "appealManageInit":
        $RestHandler = new RestHandler();
        $RestHandler -> appealManageInit($_GET);
        break;

    case "appealModify":
        $RestHandler = new RestHandler();
        $RestHandler -> appealModify($_GET);
=======
        $RestHandler = new RestHandler();
        $RestHandler -> changePaper($_GET);
>>>>>>> 2ebda16bd7183c1bdb61d724c2b71d2b4fe193cb
        break;
}