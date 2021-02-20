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
            $response = $this->encodeJson($rawData);
            echo $response;
            $_SESSION['username'] = $username;
        } else {
        	$rawData = array ('msg'=>'1001');//请求失败
            $response = $this->encodeJson($rawData);
            echo $response;
        }
    }
    
    public function register($username,$password) {
    	$conn = new mysqli($this->server, $this->dbUser, $this->dbPass, $this->dbName);
		$stmt = $conn->prepare('INSERT INTO userinfo (`username`, `password` ) VALUES (?,?)');
		$stmt -> bind_param("ss",$username,$password);
        if ($stmt -> execute()){
            $rawData = array ('msg'=>'1000');
            $response = $this->encodeJson($rawData);
            $_SESSION['username'] = $username;
            echo $response;
        } else {
            $rawData = array ('msg'=>'1001');
            $response = $this->encodeJson($rawData);
            echo $response;
        }
    }

    public function index_query($username){
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
            }
            $rawData = array('msg'=>'2000','subject'=>$subject,'status'=>$status);
            $response = $this -> encodeJson ($rawData);
            echo $response;
        }
    }

    public function overview($username){
        $conn = new mysqli($this->server,$this->dbName,$this->dbPass,$this->dbName);
        $stmt = $conn -> prepare ("SELECT chose,upload,comment,graduate FROM userinfo WHERE username = ?");
        $stmt -> bind_param ("s",$username);
        $stmt -> execute ();
        $stmt -> bind_result ($chose,$upload,$comment,$graduate);
        $stmt -> store_result ();
        $stmt -> fetch ();
        if (!$stmt -> num_rows){
            $response = array("msg"=>'2001');
            $response = $this->encodeJson ($response);
            echo $response;
            return 0;
        } else {
            $response = array("msg"=>"2000","chose"=>$chose,"upload"=>$upload,"comment"=>$comment,"graduate"=>$graduate);
            $response = $this->encodeJson ($response);
            echo $response;
        }
    }



}

?>