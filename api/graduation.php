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
        $RestHandler = new RestHandler();
        $RestHandler -> changePaper($_GET);
        break;
}
?>