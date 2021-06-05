<?php
    $lifeTime = 24 * 3600; //Session保存一天
    session_set_cookie_params($lifeTime);
    session_start();

class RestHandler  {
	
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
            $teacherLogin = $conn -> prepare("SELECT teacherName,teacherMajor From teacherInfo WHERE teacherNumber =? AND password =  ?");
            $teacherLogin -> bind_param("ss",$username,$password);
            $teacherLogin -> execute();
            $teacherLogin -> bind_result($teacherName,$teacherMajor);
            $teacherLogin -> store_result();
            if ($teacherLogin -> num_rows){
                $teacherLogin -> fetch();
                $rawData = array ('msg'=>'1100'); //登陆成功
                $response = $this -> encodeJson($rawData);
                echo $response;
                $_SESSION['username'] = $username;
                $_SESSION['teacherName'] = $teacherName;
                $_SESSION['teacherMajor'] = $teacherMajor;
            } else {
                $rawData = array ('msg'=>'1001');//请求失败
                $response = $this -> encodeJson($rawData);
                echo $response;
            }
        }
    }
    
    public function register($username,$password) {
    	$conn = new mysqli($this->server, $this->dbUser, $this->dbPass, $this->dbName);
		$stmt = $conn->prepare('INSERT INTO userinfo (`username`, `password` ) VALUES (?,?)');
		$stmt -> bind_param("ss",$username,$password);
        if ($stmt -> execute()){
            $rawData = array ('msg'=>'1000');
            $response = $this -> encodeJson($rawData);
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
            $stmt2 = $conn -> prepare("UPDATE `userinfo` SET `subject`= ?,`status`= ?,studentName = ? WHERE `username`=?");
            if ($GET['prepareStatus']){
                $status = "已完成开题";
            } else {
                $status = "请完善开题报告";
            }
            $stmt2 -> bind_param("ssss",$GET['paperTitle'],$status,$GET['studentName'],$GET['studentNumber']);
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

    public function changePaper($GET):int {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $stmt = $conn -> prepare("UPDATE `prepareList` SET `paperTitle` = ?,paperTips = ?,prepareType = ?,prepareStatus = ? WHERE `studentNumber` = ?");
        $stmt -> bind_param("sssss",$GET['paperTitle'],$GET['paperTips'],$GET['prepareType'],$GET['prepareStatus'],$GET['studentNumber']);
        if ($stmt -> execute()){
            if ($GET['prepareStatus']){
                $stmt2 = $conn -> prepare("UPDATE userinfo SET subject = ?,status='请完成双向选择' WHERE username = ?");
            } else {
                $stmt2 = $conn -> prepare("UPDATE userinfo SET subject = ?,status='请完善开题报告' WHERE username = ?");
            }
            $stmt2 -> bind_param("ss",$GET['paperTitle'],$GET['studentNumber']);
            if ($stmt2 -> execute()){
                $response = array("msg"=>"2000");
                $response = $this -> encodeJson($response);
                echo $response;
                return 0;
            } else {
                $response = array("msg"=>"2001");
                $response = $this -> encodeJson($response);
                echo $response;
            }
        } else {
            $response = array("msg"=>"2001");
            $response = $this -> encodeJson($response);
            echo $response;
        }
        return 0;
    }

    public function checkTeacher($major):int {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $stmt = $conn -> prepare("SELECT teacherName From teacherList WHERE major = ?");
        $stmt -> bind_param("s",$major);
        $stmt -> execute();
        $stmt -> bind_result($teacherName);
        $stmt -> store_result();
        $teacherList = array();
        while ($stmt -> fetch()){
            array_push($teacherList,$teacherName);
        }
        $teacherList = array("list" => $teacherList);
        $response = $this -> encodeJson($teacherList);
        echo $response;
        return 0;
    }

    public function studentChooseUpload($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $stmt = $conn -> prepare ("INSERT INTO DoubleChoose (`studentNumber`, `studentName`, `paperTitle`, `major`, `teacherName`) VALUES (?,?,?,?,?)");
        $stmt -> bind_param("sssss",$GET['studentNumber'],$GET['studentName'],$GET['paperTitle'],$GET['major'],$GET['teacherName']);
        if ($stmt ->execute()){
            $stmt2 = $conn -> prepare("UPDATE userinfo SET chose = '-1' , status = '双向选择待同意' WHERE username = ?");
            $stmt2 -> bind_param('s',$GET['studentNumber']);
            if ($stmt2 -> execute()){
                $response = array("msg"=>"2000");
                $response = $this -> encodeJson($response);
                echo $response;
            } else {
                $response = array("msg"=>"2001");
                $response = $this -> encodeJson($response);
                echo $response;
            }
        } else {
            $response = array("msg"=>"2001");
            $response = $this -> encodeJson($response);
            echo $response;
        }
    }

    public function chooseStatus($studentNumber){
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $stmt = $conn -> prepare("SELECT * From DoubleChoose WHERE studentNumber = ? AND teacherchoose IS NULL");
        $stmt -> bind_param("s",$studentNumber);
        $stmt -> execute();
        $stmt -> store_result();
        if ($stmt -> num_rows){
            $response = array("msg"=>"2000");//教师未审核
            $response = $this->encodeJson($response);
            echo $response;
        } else {
            $stmt2 = $conn -> prepare("SELECT * From DoubleChoose WHERE studentNumber = ? AND teacherchoose = 1");
            $stmt2 -> bind_param("s",$studentNumber);
            $stmt2 -> execute();
            $stmt2 -> store_result();
            if ($stmt2 -> num_rows){
                $response = array("msg"=>"2100");//审核通过
                $response = $this->encodeJson($response);
                echo $response;
            } else {
                $response = array("msg"=>"2001");//教师未通过
                $response = $this->encodeJson($response);
                echo $response;
            }
        }
    }

    public function paperBasicQuery($studentNumber)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $basicQuery = $conn -> prepare("SELECT studentName,teacherName From commentHistory WHERE studentNumber = ?");
        $basicQuery -> bind_param("s",$studentNumber);
        $basicQuery -> execute();
        try{
            @$basicQuery -> bind_result($studentName,$teacherName);
        } catch (Exception $e){
            $response = array("msg"=>"2001");
            $response = $this->encodeJson($response);
            echo $response;
        }
        $basicQuery -> store_result();
        $basicQuery -> fetch();
        if ( $basicQuery -> num_rows ){
            $response = array("msg"=>"2000","studentName"=>$studentName,"teacherName"=>$teacherName);
            $response = $this->encodeJson($response);
            echo $response;
        } else {
            $response = array("msg"=>"2001");
            $response = $this->encodeJson($response);
            echo $response;
        }
    }

    public function paperNumberQuery($studentNumber){
        $allNumber = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $numberQuery = $conn -> prepare("SELECT paperNumber From commentHistory WHERE studentNumber = ? ORDER BY `commentHistory`.`paperNumber` DESC");
        $numberQuery -> bind_param("s",$studentNumber);
        $numberQuery -> execute();
        $numberQuery -> bind_result($paperNumber);
        $numberQuery -> store_result();
        $numberQuery -> fetch();
        array_push($allNumber,$paperNumber);
        if ($numberQuery -> num_rows === 0){
            $response = array("msg"=>"2001");
            $response = $this->encodeJson($response);
            echo $response;
        } else {
            $response = array("msg"=>"2000","paperList" => $allNumber);
            $response = $this->encodeJson($response);
            echo $response;
        }
    }

    public function paperCommentQuery($studentNumber){
        $commentList = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $commentQuery = $conn -> prepare("SELECT paperNumber,paperQues,paperStatus,paperType From commentHistory WHERE  studentNumber = ? ORDER BY `commentHistory`.`paperNumber` DESC");
        $commentQuery -> bind_param("s",$studentNumber);
        $commentQuery -> execute();
        $commentQuery -> bind_result($paperNumber,$paperQues,$paperStatus,$paperType);
        $commentQuery -> store_result();
        while($commentQuery -> fetch()){
            $soloComment = array("paperNumber"=>$paperNumber,"paperQues"=>$paperQues,"paperStatus"=>$paperStatus,"paperType"=>$paperType);
            array_push($commentList,$soloComment);
        }
        $response = array("commentList" => $commentList);
        echo $this->encodeJson($response);
    }

    public function studentPaperUpload($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $studentPU = $conn -> prepare("UPDATE commentHistory SET paperQues = '等待批阅',paperStatus = '等待批阅',paperType = ? WHERE paperNumber = ?");
        $studentPU -> bind_param("ss",$GET['paperType'],$GET['paperNumber']);
        if ($studentPU -> execute()){
            $studentPU2 = $conn -> prepare("UPDATE userinfo SET upload = 1, status = '论文上传已完成'  WHERE username = ?");
            $studentNumber = substr($GET['paperNumber'],0,10);
            $studentPU2 -> bind_param("s",$studentNumber);
            if ($studentPU2 -> execute()){
                $response = array("msg"=>"2000");
                echo $this->encodeJson($response);
            }
        } else {
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
        }
    }

    public function scoreQuery($studentNumber):int
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $scoreQuery = $conn -> prepare("SELECT paperNumber,PSBX,PYR,ZDJS,DBCJ,ZCJ From scoreQuery WHERE studentNumber = ?");
        $scoreQuery -> bind_param("s",$studentNumber);
        $scoreSets = array();
        $scoreQuery -> execute();
        $scoreQuery -> bind_result($paperNumber,$PSBX,$PYR,$ZDJX,$DBCJ,$ZCJ);
        $scoreQuery -> store_result();
        $scoreQuery -> fetch();
        if (!$scoreQuery -> num_rows){
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
            return 0;
        }
        array_push($scoreSets,$ZCJ);
        array_push($scoreSets,$DBCJ);
        array_push($scoreSets,$ZDJX);
        array_push($scoreSets,$PYR);
        array_push($scoreSets,$PSBX);
        $response = array("msg"=>"2000","paperNumber"=>$paperNumber,"scoreSets"=>$scoreSets);
        echo $this->encodeJson($response);
        return 0;
    }

    public function appealInfo($studentNumber)
    {
        $paperList = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $appealInfo = $conn -> prepare("SELECT paperNumber,studentName,teacherName From commentHistory WHERE studentNumber = ? ORDER BY commentHistory.paperNumber DESC");
        $appealInfo -> bind_param("s",$studentNumber);
        $appealInfo -> execute();
        $appealInfo -> bind_result($paperNumber,$studentName,$teacherName);
        $appealInfo -> store_result();
        while ($appealInfo -> fetch()){
            array_push($paperList,$paperNumber);
        }
        $response = array("studentName"=>$studentName,"studentNumber"=>$studentNumber,"paperList"=>$paperList,"teacherName"=>$teacherName);
        echo $this->encodeJson($response);
    }

    public function studentAppeal($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $studentAppeal = $conn -> prepare("Insert INTO appealInfo (studentNumber,paperNumber,teacherName,appealText) VALUES (?,?,?,?)");
        $studentAppeal -> bind_param("ssss",$GET['studentNumber'],$GET['paperNumber'],$GET['teacherName'],$GET['appealText']);
        if ($studentAppeal -> execute()){
            $response = array("msg"=>"2000");
            echo $this->encodeJson($response);
        } else {
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
        }
    }

    public function studentGraduate($studentNumber):int
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $studentGS = $conn -> prepare("SELECT * From scoreQuery WHERE studentNumber = ?");
        $studentGS -> bind_param("s",$studentNumber);
        $studentGS -> execute();
        $studentGS -> store_result();
        $studentGS -> fetch();
        if (!$studentGS -> num_rows){
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
            return 0;
        }
        $studentBI = $conn -> prepare("SELECT studentName,studentMajor From prepareList WHERE studentNumber = ?");
        $studentBI -> bind_param("s",$studentNumber);
        $studentBI -> execute();
        $studentBI -> bind_result($studentName,$studentMajor);
        $studentBI -> store_result();
        $studentBI -> fetch();

        $graduateLQ = $conn -> prepare("SELECT graduateList From graduateList");
        $graduateList = array();
        $graduateLQ -> execute();
        $graduateLQ -> bind_result($graduateSolo);
        $graduateLQ -> store_result();
        while ($graduateLQ -> fetch()){
            array_push($graduateList,$graduateSolo);
        }

        $response = array("msg"=>"2000","studentName"=>$studentName,"studentMajor"=>$studentMajor,"graduateList"=>$graduateList);
        echo $this->encodeJson($response);
        return 0;
    }

    public function studentGraduateSubmit($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $studentGS = $conn -> prepare("INSERT INTO studentGraduate (studentNumber,studentName,studentMajor,studentJob,graduateSpec) VALUES (?,?,?,?,?)");
        $studentGS -> bind_param("sssss",$GET['studentNumber'],$GET['studentName'],$GET['studentMajor'],$GET['studentJob'],$GET['graduateSpec']);
        if ($studentGS -> execute()){
            $studentGS = $conn -> prepare("UPDATE userinfo SET graduate = 1,status = '恭喜毕业' WHERE username = ?");
            $studentGS -> bind_param("s",$GET['studentNumber']);
            $studentGS -> execute();
            $response = array("msg"=>"2000");
            echo $this->encodeJson($response);
        } else {
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
        }
    }

    public function teacherChooseQuery($GET):int
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $studentList = array();
        $prepareInfo = $conn -> prepare ("SELECT prepareType,prepareStatus From prepareList WHERE studentNumber = ?");

        $teacherCQ = $conn -> prepare ("SELECT studentNumber,studentName,paperTitle From DoubleChoose WHERE teacherName = ? AND major = ? AND teacherchoose IS NULL ");
        $teacherCQ -> bind_param("ss",$GET['teacherName'],$GET['teacherMajor']);
        $teacherCQ -> execute();
        $teacherCQ -> bind_result($studentNumber,$studentName,$paperTitle);
        $teacherCQ -> store_result();
        if ($teacherCQ -> num_rows == 0){
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
            return 0;
        }
        while ($teacherCQ -> fetch()){
            $prepareInfo -> bind_param("s",$studentNumber);
            $prepareInfo -> execute();
            $prepareInfo -> bind_result($paperType,$prepareStatus);
            $prepareInfo -> store_result();
            $prepareInfo -> fetch();
            $studentSolo = array("studentNumber"=>$studentNumber,"studentName"=>$studentName,"paperTitle"=>$paperTitle,"paperType"=>$paperType,"prepareStatus"=>$prepareStatus);
            array_push($studentList,$studentSolo);
        }
        $response = array("msg"=>"2000","studentList"=>$studentList);
        echo $this->encodeJson($response);
        return 0;
    }

    public function teacherChoose($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $teacherChoose = $GET['option'];
        $studentNumber = $GET['studentNumber'];
        if ($teacherChoose == 0){
            $teacherCE = $conn -> prepare("DELETE From DoubleChoose WHERE studentNumber = ?");
            $teacherCE -> bind_param("s",$studentNumber);

            $studentStatus = $conn -> prepare("UPDATE userinfo SET status = '双向选择被拒绝',chose = 0 WHERE username = ?");
            $studentStatus -> bind_param("s",$studentNumber);
            $studentStatus -> execute();

            if ($teacherCE -> execute()){
                $response = array("msg"=>"2000");
                echo $this->encodeJson($response);
            } else {
                $response = array("msg"=>"2001");
                echo $this->encodeJson($response);
            }
        } else {
            $studentStatus = $conn -> prepare("UPDATE userinfo SET status = '双向选择已同意',chose = 1 WHERE username = ?");
            $studentStatus -> bind_param("s",$studentNumber);
            $studentStatus -> execute();
            $teacherCE = $conn -> prepare("UPDATE DoubleChoose SET teacherchoose = ? WHERE studentNumber = ?");
            $teacherCE -> bind_param("ss",$teacherChoose,$studentNumber);
            if ($teacherCE -> execute()){
                $paperNumber = $studentNumber."0001";
                $studentCE = $conn -> prepare("INSERT INTO commentHistory (paperNumber,studentNumber,studentName,teacherName) VALUES (?,?,?,?)");
                $studentCE -> bind_param("ssss",$paperNumber,$studentNumber,$GET['studentName'],$GET['teacherName']);
                if ($studentCE -> execute()){
                    $response = array("msg"=>"2000");
                    echo $this->encodeJson($response);
                }
            } else {
                $response = array("msg"=>"2001");
                echo $this->encodeJson($response);
            }
        }
    }

    public function teacherPaperInit($GET)
    {
        $studentList = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $teacherPI = $conn -> prepare("SELECT studentNumber,studentName,paperTitle From DoubleChoose WHERE teacherName = ? AND major = ? AND teacherchoose = 1");
        $teacherPI -> bind_param("ss",$GET['teacherName'],$GET['teacherMajor']);
        $teacherPI -> execute();
        $teacherPI -> bind_result($studentNumber,$studentName,$paperTitle);
        $teacherPI -> store_result();
        $commentQuery = $conn -> prepare("SELECT `paperNumber`, `paperType`, `paperQues` FROM `commentHistory` WHERE `studentNumber` = ? AND paperStatus = '等待批阅' ORDER BY commentHistory.paperNumber DESC ");
        while ($teacherPI -> fetch()){
            $commentQuery -> bind_param("s",$studentNumber);
            $commentQuery -> execute();
            $commentQuery -> bind_result($paperNumber,$paperType,$paperQues);
            $commentQuery -> store_result();
            $commentQuery -> fetch();
            if ($commentQuery -> num_rows){
                $studentInfo = array("studentName"=>$studentName,"paperTitle"=>$paperTitle,"paperNumber"=>$paperNumber,"paperType"=>$paperType,"paperQues"=>$paperQues);
                array_push($studentList,$studentInfo);
            }
        }
        $response = array("studentList"=>$studentList);
        echo $this->encodeJson($response);
    }

    public function teacherPaperUpload($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $teacherPU = $conn -> prepare("UPDATE commentHistory SET paperType = ?,paperQues = ?,paperStatus = '存在问题' WHERE paperNumber = ?");
        $teacherPU -> bind_param("sss",$GET['paperType'],$GET['paperQues'],$GET['paperNumber']);
        if($teacherPU -> execute()){
            $newPaperInfo = $conn -> prepare("SELECT studentNumber,studentName,teacherName From commentHistory WHERE paperNumber = ?");
            $newPaperInfo -> bind_param("s",$GET['paperNumber']);
            $paperNumber = (string)((int)$GET['paperNumber'] + 1);
            $newPaperInfo -> execute();
            $newPaperInfo -> bind_result($studentNumber,$studentName,$teacherName);
            $newPaperInfo -> store_result();$newPaperInfo->fetch();
            $newPaperCreate = $conn -> prepare("INSERT INTO commentHistory  (paperNumber,studentNumber,studentName,teacherName) VALUES (?,?,?,?)");
            $newPaperCreate -> bind_param("ssss",$paperNumber,$studentNumber,$studentName,$teacherName);
            if($newPaperCreate -> execute()){
                $studentStatus = $conn -> prepare("UPDATE userinfo SET status = '请及时修改论文',comment = 1 WHERE username = ?");
                $studentStatus -> bind_param("s",$studentNumber);
                if($studentStatus -> execute()){
                    $response = array("msg"=>"2000");
                    echo $this->encodeJson($response);
                } else {
                    $response = array("msg"=>"2000");
                    echo $this->encodeJson($response);
                }
            } else {
                $response = array("msg"=>"2000");
                echo $this->encodeJson($response);
            }
        }  else {
            $response = array("msg"=>"2000");
            echo $this->encodeJson($response);
        }
    }

    public function paperFinish($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $paperFinish = $conn -> prepare("UPDATE commentHistory SET paperQues = '终审完成',paperStatus = '审核通过' WHERE paperNumber = ?");
        $paperFinish -> bind_param("s",$GET['paperNumber']);
        $paperFinish2 = $conn -> prepare("UPDATE userinfo SET status = '终审完成',comment = '1' WHERE username =?");
        $paperFinish2 -> bind_param("s",$GET['studentNumber']);
        if ($paperFinish -> execute() && $paperFinish2 ->execute()){
            $response = array("msg"=>"2000");
            echo $this->encodeJson($response);
        } else {
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
        }
    }

    public function scoreManageInit($GET){
        $scoreList = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $scoreMI = $conn -> prepare("SELECT studentNumber,studentName,paperTitle From DoubleChoose WHERE teacherName = ? AND major = ? AND teacherchoose = 1");
        $scoreMI -> bind_param("ss",$GET['teacherName'],$GET['teacherMajor']);
        $scoreMI -> execute();
        $scoreMI -> bind_result($studentNumber,$studentName,$paperTitle);
        $scoreMI -> store_result();
        $scoreQuery = $conn -> prepare("SELECT `paperNumber` FROM `commentHistory` WHERE `studentNumber` = ? AND paperStatus = '审核通过' ORDER BY commentHistory.paperNumber DESC ");
        while ($scoreMI -> fetch()){
            $scoreQuery -> bind_param("s",$studentNumber);
            $scoreQuery -> execute();
            $scoreQuery -> bind_result($paperNumber);
            $scoreQuery -> store_result();
            $scoreQuery -> fetch();
            if ($scoreQuery -> num_rows){
                $studentInfo = array("studentName"=>$studentName,"paperTitle"=>$paperTitle,"paperNumber"=>$paperNumber);
                array_push($scoreList,$studentInfo);
            }
        }
        $response = array("scoreList"=>$scoreList);
        echo $this->encodeJson($response);
    }

    public function uploadScore($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $uploadScore = $conn -> prepare("INSERT INTO scoreQuery (studentNumber,paperNumber,PSBX,PYR,ZDJS,DBCJ,ZCJ) VALUES (?,?,?,?,?,?,?)");
        $uploadScore -> bind_param("sssssss",$GET['studentNumber'],$GET['paperNumber'],$GET['PSBX'],$GET['PYR'],$GET['ZDJS'],$GET['DBCJ'],$GET['ZCJ']);
        if ($uploadScore -> execute()) {
            $studentStatus = $conn -> prepare("UPDATE userinfo SET status = '成绩审阅已完成',comment = 1 WHERE username = ?");
            $studentStatus -> bind_param("s",$GET['studentNumber']);
            $studentStatus -> execute();
            $response = array("msg"=>"2000");
            echo $this->encodeJson($response);
        } else {
            $response = array("msg"=>"2001");
            echo $this->encodeJson($response);
        }
    }

    public function appealManageInit($GET)
    {
        $appealList = array();
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        $appealMI = $conn -> prepare("SELECT studentNumber,studentName,paperTitle From DoubleChoose WHERE teacherName = ? AND major = ? AND teacherChoose = 1");
        $appealMI -> bind_param("ss",$GET['teacherName'],$GET['teacherMajor']);
        $appealMI -> execute();
        $appealMI -> bind_result($studentNumber,$studentName,$paperTitle);
        $appealMI -> store_result();
        $appealName = $conn -> prepare("SELECT paperNumber,appealText From appealInfo WHERE studentNumber = ?");
        while ($appealMI -> fetch()){
            $appealName -> bind_param("s",$studentNumber);
            $appealName -> execute();
            $appealName -> bind_result($paperNumber,$appealText);
            $appealName -> store_result();
            $appealName -> fetch();
            if ($appealName -> num_rows){
                $appealSolo = array("paperNumber"=>$paperNumber,"appealText"=>$appealText,"studentName"=>$studentName,"paperTitle"=>$paperTitle);
                array_push($appealList,$appealSolo);
            }
        }
        $response = array("appealList"=>$appealList);
        echo $this->encodeJson($response);
    }

    public function appealModify($GET)
    {
        $conn = new mysqli($this -> server,$this -> dbUser,$this -> dbPass,$this ->dbName);
        if ($GET['agree'] == '1'){
            $agree = $conn -> prepare("DELETE From scoreQuery Where paperNumber = ?");
            $agree3 = $conn -> prepare("DELETE From appealInfo Where paperNumber = ?");
            $agree -> bind_param("s",$GET['paperNumber']);
            $agree3 -> bind_param("s",$GET['paperNumber']);
            $agree2 = $conn -> prepare("UPDATE userinfo SET status = '成绩申诉已批准',comment = '0' WHERE username = ?");
            $agree2 -> bind_param("s",$GET['studentNumber']);
            if ($agree2 -> execute() && $agree -> execute() && $agree3->execute()){
                $response = array("msg"=>"2000");
                echo $this->encodeJson($response);
            }
        } else {
            $disagree = $conn -> prepare("UPDATE userinfo SET status = '成绩申诉已驳回' WHERE username = ?");
            $disagree -> bind_param("s",$GET['studentNumber']);
            $disagree2 = $conn -> prepare("DELETE From appealInfo Where paperNumber = ?");
            $disagree2 -> bind_param("s",$GET['paperNumber']);
            if ($disagree -> execute() && $disagree2 -> execute()){
                $response = array("msg"=>"2000");
                echo $this->encodeJson($response);
            }
        }
    }

}

