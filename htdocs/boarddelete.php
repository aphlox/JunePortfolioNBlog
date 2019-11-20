<!DOCTYPE html>
<html>
<style>
a {
text-decoration:none; 
color:black;'
}
</style>
<body>
<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
$conn = new mysqli("localhost","root","a123456&","web");
mysqli_query($conn,'SET NAMES utf8');
if(isset($_GET['boardnum'])){
    $boardnum = $_GET['boardnum']; 
$sql = "SELECT *from board where boardnum = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
if($row['nickname'] == $_SESSION['nickname']) {
$sql4 = "SELECT *from upload where starttime ='".$row['starttime']."'";
$res4 = $conn->query($sql4);
while($row4=mysqli_fetch_array($res4)) {
while(file_exists($row4['changename'])) { 
unlink($row4['changename']);
}
}
$sql3 = "DELETE FROM upload where starttime='".$row['starttime']."'";
$res3 = $conn->query($sql3);
$sql2 = "DELETE FROM board where boardnum='$boardnum'";
$res2 = $conn->query($sql2);
echo "<script>location.href='board.php';</script>";
}
}
?>
</body>
</html>