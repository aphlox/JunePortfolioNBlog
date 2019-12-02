<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$day = $data->day;


$hourHitArray = array();

/*DB 불러오기*/
require_once("../conf/dbInfo.php");
$conn = dbConn();

mysqli_query($conn, 'SET NAMES utf8');

$sqlHour = "SELECT HOUR(time) AS 'hour' ,  count(HOUR(time)) AS 'count'
                    FROM vistor
                    WHERE date = '$day' and time between '00:00:00' and '24:00:00'
                    GROUP BY HOUR(time);";
$resHour = $conn->query($sqlHour);

/*처음에 모든 시간대의 방문자수를 0으로 하고*/
for ($count = 0; $count < 24; $count++) {
    array_push($hourHitArray, 0);
}
/*해당 시간대의 방문자수를 바꾼다(배열 순서 때문에*/
while ($row = mysqli_fetch_array($resHour)) {
    $hourHitArray[$row[0]] = $row[1];
}


$hourHitString = implode(',', $hourHitArray);
echo $hourHitString;



?>



