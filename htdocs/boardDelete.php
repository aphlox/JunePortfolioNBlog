<?php
unlink('data/'.$_GET['id']);
header( 'Location: http://192.168.204.131/board.html' );
?>