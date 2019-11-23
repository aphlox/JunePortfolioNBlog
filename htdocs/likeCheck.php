<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$condition = $data ->likecondition;
$boardnum = $data ->boardnum;
$likelist = explode(',', $_COOKIE['likelist']);


if($condition){
    //like를 취소하면 상태를 false로 바꾸어주고
    //likelist 에서 현재 게시물을 빼버리고 다시 쿠기로 설정한다.
    $likecondition =false;
    $likelist = array_diff($likelist, array($boardnum));
    $likelist = array_values($likelist);
    setcookie('likelist', implode(',',$likelist) , time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.


    echo ' 


<lottie-player
                                    src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;" >
                            </lottie-player></span>
                            <?php $likecondition =false;?>
                            '
    ;

}
else {
    //like를 눌렀다면
    $likecondition = true;
    array_push($likelist, $boardnum);
    setcookie('likelist', implode(',', $likelist), time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.

    echo ' 
   <lottie-player
                                    src="https://assets9.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;" autoplay>
</lottie-player></span>
                            <?php $likecondition =true;?>

';

}
echo "hello";
echo $boardnum;
if($condition){
    echo "true";
}else{
    echo "false";
}

?>

