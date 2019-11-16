<?php
file_put_contents('data/' . $_POST['title'], $_POST['content']);
header( 'Location: http://192.168.204.131/board.html' );
echo $_POST['title'];
echo $_POST['content'];
?>