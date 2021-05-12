<?php
$file = $_FILES["file"];//获取文件
$filename = $_POST['filename'];
if ($file == null){
    $responseData = array("msg" => "3100");
    echo encodeJson($responseData);
    return 0;
}
if(!$file["error"]){
    if (move_uploaded_file($file["tmp_name"],"./prepare_upload/".$filename)){
        $responseData = array("msg" => "3000");
        echo encodeJson($responseData);
        return 1;
    }
} else {
    $responseData = array("msg" => "3100");
    echo encodeJson($responseData);
    return 0;
}

function encodeJson($responseData) {
    return json_encode($responseData);
}