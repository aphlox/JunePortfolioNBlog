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
            <div class="list-group mt-3">
                <a href="#" class="list-group-item active">방문자 지수</a>
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
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: ["1월", "2월", "3월", "4월", "5월", "6월", "7월"],
            datasets: [
                {
                    label: "유입 방문자",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [530, 5548, 9673, 10230, 19432, 36559, 58575]
                },
                {
                    label: "무효 방문자",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [37, 539, 1050, 2035, 4553, 5042, 7285]
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
