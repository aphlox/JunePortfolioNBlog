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
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn,'SET NAMES utf8');
if(isset($_GET['boardnum'])){
    $boardnum = $_GET['boardnum']; 
$sql = "SELECT *from board where boardnum = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);

$sql2 = "DELETE FROM board where boardnum='$boardnum'";
$res2 = $conn->query($sql2);
echo "<script>location.href='board.php';</script>";

}
?>
</body>
</html>