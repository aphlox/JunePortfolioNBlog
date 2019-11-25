<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
//$condition = $data ->likecondition;
$boardnum = $data ->boardnum;


//DB 게시글 좋아요 수
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');


$sql = "SELECT *from board where boardnum = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
$likecount = $row['like'];
echo $likecount;


?>

