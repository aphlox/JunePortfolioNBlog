<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
//$condition = $data ->likecondition;
$boardnum = $data ->index;

/*좋아요리스트 쿠키가 있으면 해당 쿠키 내용 가져와서 어떤 게시글들
좋아요 했는지 체크한다. 그리고 그 게시글이 현재 게시글이면
좋아요 표시를 해준다(좋아요 상태 true)
string 값을 따로 설정해준것은 삭제 예정
*/
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
$conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');



if($likecondition){
    //like를 취소하면 상태를 false로 바꾸어주고
    //likelist 에서 현재 게시물을 빼버리고 다시 쿠기로 설정한다.
    $likecondition =false;
    $likelist = array_diff($likelist, array($boardnum));
    $likelist = array_values($likelist);
    setcookie('likelist', implode(',',$likelist) , time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.

    $sqlLike = "UPDATE board set `like`=`like`-1 WHERE index=$boardnum";
    $resLike = $conn->query($sqlLike);
/*    $row2 = mysqli_fetch_array($res2);
    if ($res2->num_rows != 1) {
        echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
        exit();
    }*/

    echo ' <lottie-player src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                background="transparent" speed="1" style="width: 100px; height: 100px;" ></lottie-player>
                <?php $likecondition =false;?>';

}
else {
    //like를 눌렀다면
    $likecondition = true;
    array_push($likelist, $boardnum);
    setcookie('likelist', implode(',', $likelist), time() + (3536000), "/"); // 1년 동안 쿠키를 유지하도록 해준다.

    $sqlLike = "UPDATE board set `like`=`like`+1 WHERE index=$boardnum";
    $resLike = $conn->query($sqlLike);
/*    $row2 = mysqli_fetch_array($res2);
    if ($res2->num_rows != 1) {
        echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
        exit();
    }*/

    echo '<lottie-player src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
            background="transparent" speed="1" style="width: 100px; height: 100px;" autoplay ></lottie-player>
            <?php $likecondition =true;?>' ;

}




?>

