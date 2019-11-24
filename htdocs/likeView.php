<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$condition = $data ->likecondition;
$boardnum = $data ->boardnum;
$likelist = explode(',', $_COOKIE['likelist']);


if($condition){

    echo ' 


<lottie-player
                                    src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;" >
                            </lottie-player>
                            <?php $likecondition =false;?>
                            '
    ;

}
else {


    echo ' 


<lottie-player
                                    src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;" autoplay >
                            </lottie-player>
                            <?php $likecondition =true;?>
                            '
    ;

}
echo "hello";
echo $boardnum;
if($condition){
    echo "true";
}else{
    echo "false";
}

?>

