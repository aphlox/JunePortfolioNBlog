<?php
require_once("../conf/dbInfo.php");
$conn = dbConn();
mysqli_query($conn, 'SET NAMES utf8');

$boardTitle = $conn->real_escape_string($_POST['title']);
$boardContent = $_POST['contents'];
$boardNum =  $_POST['num'];
$file = $_POST['files'];
$boardNum = (string)$boardNum;

$sql = "UPDATE board SET title ='$boardTitle', content ='$boardContent' WHERE id = '$boardNum';";
$result = $conn->query($sql);
if($result===false){
    echo "<script>
          alert('수정에 실패하였습니다.');
          history.back();
        </script>";
}else{
    $boardIndex = mysqli_insert_id($conn);
    header('Location: board.php');
    exit;
}




?>