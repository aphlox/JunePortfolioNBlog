<?php 
header("Content-Type: text/html; charset=UTF-8");
session_start();
$conn = new mysqli("192.168.204.138", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn,'SET NAMES utf8');
//$id = $_POST['id'];
//$pws = $_POST['password'];
$id = 'aphlox';
$password = "veronica9";
//나중에 패스워드 암호화? mb5
//$sql = "select *from admin where id ='aphlox' and password ='veronica9'";
$sql = "select *from admin ";
$res = $conn->query($sql);

if (false === $res) {
    echo mysqli_error();
}
$row = mysqli_fetch_array($res);
if($res -> num_rows > 0) {
$_SESSION['id'] = $id;
$_SESSION['nickname'] = $row["nickname"];
if(isset($_SESSION['id']) && isset($_SESSION['nickname'])) {
echo "<script>location.href='board.php';</script>";
} else {
echo "<script>alert('로그인 실패!');</script>";
//    echo "<script>location.href='login.html';</script>";
}
} else {
    echo "<script>alert($id.'로그인 실패!!');</script>";
//    echo "<script>location.href='login.html';</script>";
}
?>