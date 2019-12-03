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
    <!--달력 CSS 추가하기-->
    <link href="css/style.css" rel="stylesheet">

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
                        <h4><img src="img/search.svg"> </span>시간대별 방문자 지수</h4>
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
            <div style="display : table; margin-top : 15px; margin-left: auto; margin-right: auto">
                <ul class="pagination">
                    <li class="page-item ">
                        <a class="page-link mobile" id="currentDayText"></a>
                    </li>
                </ul>
            </div>

            <div id="kCalendar" style=" float: left;"></div>
            <script>
                window.onload = function () {
                    kCalendar('kCalendar');
                };
            </script>
            <div class="list-group-item" id="lineChartParent" style=" float: left; width: 75% ">
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
<!--캘린더 자바스크립트 추가하기-->
<script src="js/calendar.js"></script>


<script>

    var date = new Date();
    var currentYear = date.getFullYear();
    //년도를 구함

    var currentMonth = date.getMonth() + 1;
    //연을 구함. 월은 0부터 시작하므로 +1, 12월은 11을 출력

    var currentDate = date.getDate();
    //오늘 일자.
    var currentMonthString = ("0" + currentMonth).slice(-2);
    var currentDateString = ("0" + currentDate).slice(-2);
    var day = currentYear + currentMonthString + currentDateString;


    var currentDayText = document.getElementById("currentDayText");


    var hourHitList = [];

    var lineChartParent = document.getElementById("lineChartParent");

    fetch('adminHourHitCheck.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "day": day
        })
    }).then(function (response) {
        response.text().then(function (text) {
            currentDayText.innerText = day;


            hourHitList = text.split(",");
            lineChartParent.innerHTML = "<canvas id=\"lineChart\" style=\"max-width: 800px\"></canvas>";
            var getChart = document.getElementById("lineChart").getContext('2d');

            var myLineChart = new Chart(getChart, {
                type: 'line',
                data: {
                    labels: ["0시", "1시", "2시", "3시", "4시", "5시", "6시", "7시", "8시", "9시", "10시", "11시", "12시",
                        "13시", "14시", "15시", "16시", "17시", "18시", "19시", "20시", "21시", "22시", "23시"],
                    datasets: [
                        {
                            label: "유입 방문자",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: hourHitList

                        }
                    ]
                },
                options: {
                    responsive: true
                }
            });
        })
    });

</script>
</body>
</html>
