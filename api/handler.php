<?php
    $lifeTime = 24 * 3600; //Session保存一天
    session_set_cookie_params($lifeTime);
    session_start();
    require_once("BasedRest.php");

class RestHandler extends SimpleRest {
	
	private $server = "localhost";
	private $dbUser = "bs";
	private $dbPass = "bs";
	private $dbName = "bs";

    private function encodeJson($responseData) {
        return json_encode($responseData);
    }
 
    public function login($username,$password) {
    	$conn = new mysqli($this->server, $this->dbUser, $this->dbPass, $this->dbName);
        $stmt = $conn->prepare("SELECT * FROM userinfo WHERE username =? AND password=?");
        $stmt ->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows) {
            $rawData = array ('msg'=>'1000'); //登陆成功
            $response = $this -> encodeJson($rawData);
            echo $response;
            $_SESSION['username'] = $username;
        } else {
        	$rawData = array ('msg'=>'1001');//请求失败
            $response = $this -> encodeJson($rawData);
            echo $response;
        }
    }
    
    public function register($username,$password) {
    	$conn = new mysqli($this->server, $this->dbUser, $this->dbPass, $this->dbName);
		$stmt = $conn->prepare('INSERT INTO userinfo (`username`, `password` ) VALUES (?,?)');
		$stmt -> bind_param("ss",$username,$password);
        if ($stmt -> execute()){
            $rawData = array ('msg'=>'1000');
            $response = encodeJson($rawData);
            $_SESSION['username'] = $username;
            echo $response;
        } else {
            $rawData = array ('msg'=>'1001');
            $response = $this -> encodeJson($rawData);
            echo $response;
        }
    }

    public function index_query($username): int
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this->dbPass,$this->dbName);
        $stmt = $conn -> prepare ("SELECT subject,status FROM userinfo WHERE username=?");
        $stmt ->bind_param ("s",$username);
        $stmt -> execute ();
        $stmt -> bind_result ($subject,$status);
        $stmt->store_result();
        $stmt -> fetch ();
        if ($stmt -> num_rows == 0){
            $rawData = array('msg' => '2001');
            $response = $this -> encodeJson ($rawData);
            echo $response;
            return 0;
        } else {
            if ($subject == null){
                $subject = "暂未申请";
                $status = "请申请开题";
            }
            $rawData = array('msg'=>'2000','subject'=>$subject,'status'=>$status);
            $_SESSION['subject'] = $subject;
            $response = $this -> encodeJson ($rawData);
            echo $response;
        }
        return 0;
    }

    public function overview($username):int
    {
        $conn = new mysqli($this->server,$this->dbName,$this->dbPass,$this->dbName);
        $stmt = $conn -> prepare ("SELECT chose,upload,comment,graduate FROM userinfo WHERE username = ? && subject is NOT NULL");
        $stmt -> bind_param ("s",$username);
        $stmt -> execute ();
        $stmt -> bind_result ($chose,$upload,$comment,$graduate);
        $stmt -> store_result ();
        $stmt -> fetch ();
        if (!$stmt -> num_rows){
            $response = array("msg"=>'2001');
            $response = $this -> encodeJson ($response);
            echo $response;
            return 0;
        } else {
            $response = array("msg"=>"2000","chose"=>$chose,"upload"=>$upload,"comment"=>$comment,"graduate"=>$graduate);
            $response = $this -> encodeJson ($response);
            echo $response;
        }
        return 0;
    }

    public function checkMajor():int
    {
        $conn = new mysqli($this -> server,$this -> dbName,$this -> dbPass,$this->dbName);
        $stmt = $conn -> prepare ("SELECT `majorList` FROM `majorList` WHERE 1");
        $stmt -> execute();
        $stmt -> bind_result($major);
        $stmt -> store_result();
        $majorList = array();
        while ($stmt -> fetch()){
            array_push($majorList,$major);
        }
        $majorList = array("list" => $majorList);
        $response = $this -> encodeJson($majorList);
        echo $response;
        return 0;
    }

    public function createPaper($GET):int{
        $conn = new mysqli($this -> server,$this -> dbName,$this -> dbPass,$this->dbName);
        $stmt = $conn -> prepare("INSERT INTO `prepareList`(`studentNumber`, `studentName`, `studentMajor`, `paperTitle`, `paperTips`, `prepareType`, `prepareStatus`) VALUES (?,?,?,?,?,?,?)");
        $stmt -> bind_param("sssssss",$GET['studentNumber'],$GET['studentName'],$GET['studentMajor'],$GET['paperTitle'],$GET['paperTips'],$GET['prepareType'],$GET['prepareStatus']);
        if ($stmt ->execute()){
            $stmt2 = $conn -> prepare("UPDATE `userinfo` SET `subject`= ?,`status`= ? WHERE `username`=?");
            if ($GET['prepareStatus']){
                $status = "已完成开题";
            } else {
                $status = "请完善开题报告";
            }
            $stmt2 -> bind_param("sss",$GET['paperTitle'],$status,$GET['studentNumber']);
            if ($stmt2 -> execute()){
                $response = array("msg" => "2000");
                $response = $this -> encodeJson($response);
                echo $response;
                return 0;
            } else {
                $response = array("msg" => "2001");
                $response = $this -> encodeJson($response);
                echo $response;
                return 0;
            }
        } else {
            $response = array("msg" => "2001");
            $response = $this -> encodeJson($response);
            echo $response;
            return 0;
        }
    }

    public function downloadPrepare($studentNumber):int{
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $stmt = $conn -> prepare("SELECT studentName,studentMajor,paperTitle,paperTips,prepareStatus From prepareList WHERE studentNumber = ?");
        $stmt -> bind_param("s",$studentNumber);
        $stmt -> execute();
        $stmt -> bind_result($studentName,$studentMajor,$paperTitle,$paperTips,$prepareStatus);
        $stmt -> store_result();
        $stmt -> fetch();
        if ($stmt -> num_rows !=0){
            $response = array("msg"=>"2000","studentName" => $studentName,"studentMajor" => $studentMajor,"paperTitle" => $paperTitle,"paperTips" => $paperTips,"prepareStatus"=>$prepareStatus);
            $response = $this -> encodeJson($response);
            echo $response;
            return 0;
        } else {
            $response = array("msg"=>"2001");
            $response = $this -> encodeJson($response);
            echo $response;
            return 0;
        }
    }



}

