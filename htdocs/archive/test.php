<?php
session_start();
$id = session_id();
phpinfo();

echo "session ID '.$id.'";


/*if(extension_loaded("mbstring")){

    echo "cURL extension is loaded";

}else{

    echo 'cURL extension failed';

}*/

?>



