<?php
require('lib/nav.php');
?>

<!doctype html>
<html lang="ko">
<head>
    <title>June's Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- 부트스트랩 CSS 추가하기 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--사이드바 CSS 추가하기-->
    <link rel="stylesheet" href="css/sidebar.css">
    <!--CK Editor 적용-->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <?php
        /*네비게이션바*/
        nav();
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="./adminPageTime.php">관리자 페이지</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbar">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="./adminPageTime.php">시간별 방문자 수</a>
                    <a class="nav-item nav-link" href="./adminPageCountry.php">나라별 방문자 수</a>
                    <a class="nav-item nav-link" href="./adminPageUserInfo.php">방문자 정보</a>
                </div>
                <div class="navbar-nav mr-sm-2">
                    <a class="nav-item nav-link" href="./userLogout.html">로그아웃</a>
                </div>
            </div>
        </nav>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">

            <div class="container p-3 bg-primary text-white">
                <div class="row">
                    <div class="col-sm-8 info">
                        <h4><img src="img/search.svg"> </span>주간 방문자 지수</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                시간 단위 선택
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./adminPageYear.php">연간 방문자수</a>
                                <a class="dropdown-item" href="./adminPageMonth.php">월간 방문자수</a>
                                <a class="dropdown-item" href="./adminPageWeek.php">주간 방문자수</a>
                                <a class="dropdown-item" href="./adminPageDayOfWeek.php">일간 방문자수</a>
                                <a class="dropdown-item" href="./adminPageTime.php">시간대별 방문자수</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group-item">
                <canvas id="lineChart"></canvas>
            </div>


    </div>
    <footer class="text-center" style="max-width: 920px;">
        <!--            <p>Copyright ⓒ 2019 <b>이현준</b> All Rights Reserved.</p>-->
    </footer>
    </main>
</div>
</div>

<!-- 제이쿼리 자바스크립트 추가하기 -->
<script src="js/jquery.min.js"></script>
<!-- Popper 자바스크립트 추가하기 -->
<script src="js/popper.min.js"></script>
<!-- 부트스트랩 자바스크립트 추가하기 -->
<script src="js/bootstrap.min.js"></script>
<!-- MDB 라이브러리 추가하기 -->
<script src="./js/mdb.min.js"></script>
<script>
    <?php

    require_once("../conf/dbInfo.php");
$conn = new mysqli($host, $userName, $passwd , $dbName);
    mysqli_query($conn, 'SET NAMES utf8');

    $sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
       DATE_FORMAT(`date`, '%Y%U') AS 'week',
       sum(`hit`)
  FROM vistor
 GROUP BY week;";
    $res = $conn->query($sql);

    ?>



    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'bar',
        data: {
            labels: [
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    echo "'$row[0]',";
                }?>

            ],
            datasets: [
                {
                    label: "유입 방문자",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'

                    ],

                    data: [
                        <?php
                        $sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
                       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
                       DATE_FORMAT(`date`, '%Y%U') AS 'week',
                       sum(`hit`)
                        FROM vistor
                         GROUP BY week;";
                        $res = $conn->query($sql);
                        while ($row = mysqli_fetch_array($res)) {
                            echo "'$row[3]',";
                        }?>

                    ]
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>
