<?php
/*글 수정한거 DB 적용용*/
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);
$conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
mysqli_query ($conn, 'SET NAMES utf8');
$boardtitle = addslashes($obj->title);
$boardcontent = addslashes($obj->content);
$boardnum = $obj->index;
$stmt = $conn->prepare("UPDATE board SET title ='$boardtitle', content ='$boardcontent' WHERE `index` ='$boardnum'");
$stmt->execute();

$sql = "select *from board where title ='$boardtitle' and content ='$boardcontent'
and `index` ='$boardnum'";
$res = $conn->query($sql);
if($res->num_rows > 0) {
    echo json_encode('1');
    exit();
} else {
    echo json_encode('0');
}
?>