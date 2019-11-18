<?php
$ip = "http://192.168.204.137";
if (strcmp($_POST['method'], "post") == 0) {
    file_put_contents('data/' . $_POST['title'], $_POST['content']);
    header('Location: '.$ip.'/board.html');

    echo $_POST['title'];
    echo $_POST['content'];

}
//put
elseif (strcmp($_POST['method'], "put") == 0) {
    rename('data/' . $_POST['old_title'], 'data/' . $_POST['title']);
    file_put_contents('data/' . $_POST['title'], $_POST['content']);
    header('Location: '.$ip.'/board.html');
}

//delete
elseif (strcmp($_GET['method'], "delete") == 0){
    unlink('data/'.$_GET['id']);
    header( 'Location: '.$ip.'/board.html' );
}


?>

<!--<script>
    const http = new XMLHttpRequest();
    http.open("PATCH", "http://192.168.204.136/board.html")
</script>-->
