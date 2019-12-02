<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("../conf/dbInfo.php");
$conn = new mysqli($host, $userName, $passwd , $dbName);
mysqli_query ($conn, 'SET NAMES utf8');

/*잘 저장되었나 확인*/
$sql = "select *from vistor";
$res = $conn->query($sql);




/*값이 잘 들어갔으면 1 아니면 0*/
if($res->num_rows > 0) {
    echo json_encode('1');
    exit();
} else {
    echo json_encode('0');
}



?>