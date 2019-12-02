<!DOCTYPE html>
<html>

<body>
<?php
header("Content-Type: text/html; charset=UTF-8");
require_once("../conf/dbInfo.php");
$conn = new mysqli($host, $userName, $passwd , $dbName);
mysqli_query($conn,'SET NAMES utf8');
if(isset($_GET['boardnum'])){
    $boardnum = $_GET['boardnum']; 
$sql = "SELECT *from board where `index` = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);

$sqlDel = "DELETE FROM board where `index`='$boardnum'";
$resDel = $conn->query($sqlDel);
echo "<script>location.href='board.php';</script>";

}
?>
</body>
</html>