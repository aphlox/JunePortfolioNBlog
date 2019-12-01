<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$weekList = $data ->weekList;




$weekHitArray = array();
/*DB 불러오기*/


foreach ($weekList as $day){
    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");

    mysqli_query($conn, 'SET NAMES utf8');

    $sqlEachDay = "SELECT DATE(date) AS `eachDay`,
                                        sum(`hit`)
                                        FROM vistor
                                        WHERE date = '$day'
                                        GROUP BY `eachDay`;";
    $resEachDay = $conn->query($sqlEachDay);
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



