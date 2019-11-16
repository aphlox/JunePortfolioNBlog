<?php
rename('data/'.$_POST['old_title'] , 'data/'.$_POST['title']  );
file_put_contents('data/'.$_POST['title'], $_POST['content']);
header( 'Location: http://192.168.204.131/board.html' );
?>