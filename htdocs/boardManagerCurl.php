<?php
$ip = "http://192.168.204.137";

//delete
//post로 받은 method에 따라 자료 추가, 수정, 삭제해주기
if (strcmp($_SERVER['REQUEST_METHOD'], "POST") == 0) {
    $title =$_POST['title'];
    $content = $_POST['content'];

    file_put_contents('data/' . $title, $content);
    header('Location: '.$ip.'/board.html');

    echo $_POST['title'];
    echo $_POST['content'];

}
elseif (strcmp($_SERVER['REQUEST_METHOD'], "delete") == 0){
    unlink('data/'.$_GET['id']);
    header( 'Location: '.$ip.'/board.html' );
}

if(isset($_POST['title'])){
    $title =$_POST['title'];
    $content = $_POST['content'];
    echo $title;

}


print_r($_SERVER['REQUEST_METHOD']);
echo "<br>";
print_r($_REQUEST);
echo "<br>";


?>

