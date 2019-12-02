<?php
header("Content-Type: application/json; charset=UTF-8");
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$WeekIndex = $data ->currentWeekIndex;

/*DB 불러오기*/
require_once("../conf/dbInfo.php");
$conn = new mysqli($host, $userName, $passwd , $dbName);
mysqli_query($conn, 'SET NAMES utf8');

$sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
       DATE_FORMAT(`date`, '%Y%U') AS `date`,
       sum(`hit`)
  FROM vistor
 GROUP BY date;";
$res = $conn->query($sql);

mysqli_data_seek($res,$WeekIndex);
$row = mysqli_fetch_row($res);
echo str_replace('/','',$row[0]);

?>



