<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query ($conn, 'SET NAMES utf8');
$boardtitle = addslashes($obj->boardtitle);
$boardcontent = addslashes($obj->boardcontent);
$boardnum = $obj->boardnum;
$stmt = $conn->prepare("UPDATE $obj->table SET boardtitle='$boardtitle',boardcontent='$boardcontent' WHERE boardnum='$boardnum'");
$stmt->execute();
$sql = "select *from board where boardtitle ='$boardtitle' and boardcontent ='$boardcontent'
and boardnum ='$boardnum'";
$res = $conn->query($sql);
if($res->num_rows > 0) {
    echo json_encode('1');
    exit();
} else {
    echo json_encode('0');
}
?>