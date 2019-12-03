<?php
header("Content-Type: application/json; charset=UTF-8");
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody);
$weekIndex = $data ->currentWeekIndex;

/*DB 불러오기*/
require_once("../conf/dbInfo.php");
$conn = dbConn();
mysqli_query($conn, 'SET NAMES utf8');

$sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
       DATE_FORMAT(`date`, '%Y%U') AS 'week',
       sum(`hit`)
  FROM vistor
 GROUP BY week;";
$res = $conn->query($sql);

mysqli_data_seek($res,$weekIndex);
$row = mysqli_fetch_row($res);
echo str_replace('/','',$row[0]);

?>



