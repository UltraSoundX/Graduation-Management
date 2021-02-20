<?php
// api.radiology.link/api/?do= /
require_once("handler.php");
header('Access-Control-Allow-Origin:*');
$do = "";
if(isset($_GET["do"]))
    $do = $_GET["do"];
/*
 * RESTful service 控制器
 * URL 映射 Version 0.3
*/

switch($do){
 
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
        $username = $_GET['username'];
        $RestHandler = new RestHandler();
        $RestHandler -> index_query($username);
        break;

    case "overview":
        $username = $_GET['username'];
        $RestHandler = new RestHandler();
        $RestHandler -> overview($username);
        break;
}
?>