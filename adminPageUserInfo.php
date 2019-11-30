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
                    <a class="nav-item nav-link " href="./adminPageTime.php">시간별 방문자 수</a>
                    <a class="nav-item nav-link" href="./adminPageCountry.php">나라별 방문자 수</a>
                    <a class="nav-item nav-link active" href="./adminPageUserInfo.php">방문자 정보</a>
                </div>
                <div class="navbar-nav mr-sm-2">
                    <a class="nav-item nav-link" href="./userLogout.html">로그아웃</a>
                </div>
            </div>
        </nav>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">

            <div class="list-group mt-3" style=" float: left; width: 49%; padding:10px;">
                <a href="#" class="list-group-item active">운영체제</a>
                <div class="list-group-item">
                    <canvas id="pieChartOS"></canvas>
                </div>
            </div>
            <div class="list-group mt-3" style=" float: left; width: 49%; padding:10px;">
                <a href="#" class="list-group-item active">브라우저</a>
                <div class="list-group-item">
                    <canvas id="pieChartBrowser"></canvas>
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
    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
    mysqli_query($conn, 'SET NAMES utf8');

    $sql = "select *from vistor";
    $res = $conn->query($sql);

    $arrayOS = array();
    while ($row = mysqli_fetch_array($res)) {
        array_push($arrayOS, $row['os'] );
    }
    $arrayOS = array_unique($arrayOS);

    ?>







    var ctxP = document.getElementById("pieChartOS").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {


            labels: [
                <?php
                foreach ($arrayOS as $os) {
                    $sql = "select *from vistor where os = '$os' ";
                    $res = $conn->query($sql);
                    echo "'$os',";
                }?>
            ],
            datasets: [
                {
                    data: [
                        <?php
                        foreach ($arrayOS as $os) {
                            $sql = "select *from vistor where os = '$os' ";
                            $res = $conn->query($sql);
                            echo $res->num_rows.",";
                        }?>

                    ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
                }
            ]

        },
        options: {
            responsive: true
        }
    });


/*    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]*/


    var ctxP = document.getElementById("pieChartBrowser").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["10대", "20대", "30대", "40대", "50대", "기타"],
            datasets: [
                {
                    data: [332, 228, 124, 32, 8, 75],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
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
