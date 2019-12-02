<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$day = $data ->day;




$hourHitArray = array();
/*DB 불러오기*/


    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");

    mysqli_query($conn, 'SET NAMES utf8');

    $sqlHour = "SELECT HOUR(time) AS 'hour' ,  count(HOUR(time)) AS 'count'
                    FROM vistor
                    WHERE date = '$day' and time between '00:00:00' and '24:00:00'
                    GROUP BY HOUR(time);";
    $resHour = $conn->query($sqlHour);





for($count = 0 ; $count <24 ; $count++){
        array_push($hourHitArray, 0);
}
while ($row = mysqli_fetch_array($resHour)) {
    $hourHitArray[$row[0]] = $row[1];
}







$hourHitString = implode( ',', $hourHitArray );
echo $hourHitString;

/*for($count = 0 ; $count < count($weekList) ; $count++){
    if($count == count($weekList)-1 ){
        echo $weekList[$count];
    }
    else{
        echo "$weekList[$count],";
    }
}*/

//echo str_replace('/','',$row[0]);

/*echo "3,7,2,1,5,6,6";*/
//echo  $weekList[0];

?>



