<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
//$condition = $data ->likecondition;
$boardnum = $data ->boardnum;





if (isset($_COOKIE['likelist'])) {
    $likelist = explode(',', $_COOKIE['likelist']);

    for ($count = 0; $count < count($likelist); $count++) {
        if ($likelist[$count] == $boardnum) {
            $likecondition = true;
            break;
        } else {
            $likecondition = false;
        }
    }

    if ($likecondition) {
        $likeconditionstring = "true";
    } else {
        $likeconditionstring = "false";
    }


}
else{
    $likelist = explode(',', 0);
    $likecondition = false;

}

//DB 게시글 좋아요 수 올려주기
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');



if($likecondition){
    //like를 취소하면 상태를 false로 바꾸어주고
    //likelist 에서 현재 게시물을 빼버리고 다시 쿠기로 설정한다.
    $likecondition =false;
    $likelist = array_diff($likelist, array($boardnum));
    $likelist = array_values($likelist);
    setcookie('likelist', implode(',',$likelist) , time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.

    $sql2 = "UPDATE board set `like`=`like`-1 WHERE boardnum=$boardnum";
    $res2 = $conn->query($sql2);
/*    $row2 = mysqli_fetch_array($res2);
    if ($res2->num_rows != 1) {
        echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
        exit();
    }*/

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
    //like를 눌렀다면
    $likecondition = true;
    array_push($likelist, $boardnum);
    setcookie('likelist', implode(',', $likelist), time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.

    $sql2 = "UPDATE board set `like`=`like`+1 WHERE boardnum=$boardnum";
    $res2 = $conn->query($sql2);
/*    $row2 = mysqli_fetch_array($res2);
    if ($res2->num_rows != 1) {
        echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
        exit();
    }*/

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
if($likecondition){
    echo "true";
}else{
    echo "false";
}
$sql = "SELECT *from board where boardnum = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
$likecount = $row['like'];
echo $likecount;


?>

