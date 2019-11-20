<?php
$ip = "http://192.168.204.138";

//post로 받은 method에 따라 자료 추가, 수정, 삭제해주기
if (strcmp($_SERVER['REQUEST_METHOD'], "POST") == 0) {

    if (strcmp($_POST['method'], "POST") == 0) {
        file_put_contents('data/' . $_POST['title'], $_POST['content']);
        header('Location: '.$ip.'/board.php');

        echo $_POST['title'];
        echo $_POST['content'];

    }
    //put
    elseif (strcmp($_POST['method'], "PUT") == 0) {
        rename('data/' . $_POST['oldTitle'], 'data/' . $_POST['title']);
        file_put_contents('data/' . $_POST['title'], $_POST['content']);
//        header('Location: '.$ip.'/board.php');
        echo("<script>location.href= $ip.boboard.phpscript>");



    }
    //delete
    elseif (strcmp($_POST['method'], "DELETE") == 0){
        unlink('data/'.$_POST['id']);
//        header( 'Location: '.$ip.'/boarboard.php
        echo("<script>location.href= $ip.board.board.phppt>");

    }



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

