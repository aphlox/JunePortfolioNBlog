<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$condition = $data ->likecondition;
$boardnum = $data ->boardnum;

/*DB 불러오기*/
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');
$sql = "SELECT *from board where boardnum = '$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
$likecount = $row['like'];


if($condition){

    echo ' 


<lottie-player
                                    src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;" autoplay>
                            </lottie-player>
                            <?php $likecondition =false;?>
                            '
    ;

}
else {


    echo ' 


<lottie-player
                                    src="https://assets4.lottiefiles.com/datafiles/KZAksH53JBd6PNu/data.json"
                                    background="transparent" speed="1" style="width: 100px; height: 100px;"  >
                            </lottie-player>
                            <?php $likecondition =true;?>
                            '
    ;

}


?>

