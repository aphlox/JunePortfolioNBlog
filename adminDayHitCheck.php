<?php
header("Content-Type: application/json; charset=UTF-8");
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody);
$weekList = $data ->weekList;


$weekHitArray = array();


foreach ($weekList as $day){
    require_once("../conf/dbInfo.php");
    $conn = dbConn();

    mysqli_query($conn, 'SET NAMES utf8');

    $sqlEachDay = "SELECT DATE(date) AS `eachDay`,
                                        sum(`hit`)
                                        FROM vistor
                                        WHERE date = '$day'
                                        GROUP BY `eachDay`;";
    $resEachDay = $conn->query($sqlEachDay);
    /*요일마다 방문자수를 요청하는데 없으면 방문자수 0
    있으면 해당 요일의 방문자를 배열에 넣기*/
    if($resEachDay->num_rows ==0 ){
        array_push($weekHitArray, 0);

    }
    else{
        while ($row = mysqli_fetch_array($resEachDay)) {
            array_push($weekHitArray, $row[1]);
        }
    }

}

$weekHitString = implode( ',', $weekHitArray );
echo $weekHitString;


?>



