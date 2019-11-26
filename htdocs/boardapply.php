<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query ($conn, 'SET NAMES utf8');
/*boardwrite에서 받은 obj 풀기*/
$boardtitle = addslashes($obj->boardtitle);
$boardcontent = addslashes($obj->boardcontent);
$date = addslashes($obj->date);
//$starttime = addslashes($obj->starttime);
$stmt = $conn->prepare("INSERT INTO $obj->table(boardtitle,boardcontent,date)
 VALUES (?,?,?)");
$stmt->bind_param('sss', $boardtitle,$boardcontent,$date);
$stmt->execute();

/*잘 저장되었나 확인*/
$sql = "select *from board where boardtitle ='$boardtitle' and boardcontent ='$boardcontent' and date ='$date'";
$res = $conn->query($sql);
/*값이 잘 들어갔으면 1 아니면 0*/
if($res->num_rows > 0) {
    echo json_encode('1');
    exit();
} else {
    echo json_encode('0');
}
?>