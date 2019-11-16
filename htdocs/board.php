<?php
file_put_contents('data/'.$_POST['title'], $_POST['content']);
echo $_POST['title'];
echo $_POST['content'];
?>
