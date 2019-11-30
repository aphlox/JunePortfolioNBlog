<html>
<head>
</head>
<body>
<?php

$conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');

$sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
       DATE_FORMAT(`date`, '%Y%U') AS `date`,
       sum(`hit`)
  FROM vistor
 GROUP BY date;";
$res = $conn->query($sql);

while ($row = mysqli_fetch_array($res)) {
    printf ("%s (%s) [%s] [%s] </br>", $row[0], $row[1], $row[2], $row[3]);

}
mysqli_data_seek($res,3);
$row = mysqli_fetch_row($res);
printf("</br>");

printf($row[0]."</br>");
printf($row[1]."</br>");


$sqlEachDay = "SELECT DATE(date) AS `eachDay`,
                                sum(`hit`)
                                FROM vistor
                                GROUP BY `eachDay`;";
$resEachDay = $conn->query($sqlEachDay);
while ($row = mysqli_fetch_array($resEachDay)){
    printf ("%s (%s) </br>", $row[0], $row[1]);
}



?>
</body>
</html>
