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
                        <h4><img src="img/search.svg"> </span>방문자 지수</h4>
                    </div>

                    <div class="col-sm-4">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                시간 단위 선택
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./index.html">연간 방문자수</a>
                                <a class="dropdown-item" href="./event.html">월간 방문자수</a>
                                <a class="dropdown-item" href="./event.html">주간 방문자수</a>
                                <a class="dropdown-item" href="./blog.html">일간 방문자수</a>
                                <a class="dropdown-item" href="./user.html">시간대별 방문자수</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display : table; margin-top : 15px; margin-left: auto; margin-right: auto">
                <ul class="pagination">
                    <li id = "prevWeekBtn" class="page-item">
                        <a onclick="prevWeek()" class="page-link">&laquo;</a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link mobile"><?php echo "'$row[0]'~$row[1]"; ?>></a>
                    </li>
                    <li id = "nextWeekBtn" class="page-item">
                        <a onclick="nextWeek()" class="page-link" onclick="">&raquo;</a>
                    </li>
                </ul>
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
<!--주간 페이징 ajax-->
<script>
    <?php

    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
    mysqli_query($conn, 'SET NAMES utf8');

    $sql = "SELECT DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-1) DAY), '%Y/%m/%d') as start,
       DATE_FORMAT(DATE_SUB(`date`, INTERVAL (DAYOFWEEK(`date`)-7) DAY), '%Y/%m/%d') as end,
       DATE_FORMAT(`date`, '%Y%U') AS 'week',
       sum(`hit`)
  FROM vistor
 GROUP BY week;";
    $res = $conn->query($sql);

    ?>

    var nextWeekBtn = document.getElementById('nextWeekBtn');


    var currentWeekIndex = 0;
    var lastWeekIndex = <?php echo $res->num_rows - 1;?>;



    function thisWeek(date) {

        var currentDay = parse(date);
        var theYear = currentDay.getFullYear();
        var theMonth = currentDay.getMonth();
        var theDate  = currentDay.getDate();
        var theDayOfWeek = currentDay.getDay();

        var thisWeek = [];

        for(var i=0; i<7; i++) {
            var resultDay = new Date(theYear, theMonth, theDate + (i - theDayOfWeek));
            var yyyy = resultDay.getFullYear();
            var mm = Number(resultDay.getMonth()) + 1;
            var dd = resultDay.getDate();

            mm = String(mm).length === 1 ? '0' + mm : mm;
            dd = String(dd).length === 1 ? '0' + dd : dd;

            thisWeek[i] = yyyy + '-' + mm + '-' + dd ;
        }


        function parse(str) {
            var y = str.substr(0, 4);
            var m = str.substr(4, 2);
            var d = str.substr(6, 2);
            return new Date(y,m-1,d);
        }
        return thisWeek;
    }







    var ctxL = document.getElementById("lineChart").getContext('2d');



    function prevWeek() {

        // alert(currentWeekIndex+"last"+ lastWeekIndex);

        // nextWeekBtn.disabled = true;
        if (currentWeekIndex == 0) {
            alert("처음 페이지입니다");
        } else {
            currentWeekIndex = currentWeekIndex -1;
            /*처음에 현재 게시글에 대해서 좋아요 유무에 따라 로띠 애니메이션 틀어주기*/
            fetch('adminWeekCheck.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "currentWeekIndex": currentWeekIndex })
            }).then(function (response) {
                response.text().then(function (text) {
                    alert(text);
                    alert(thisWeek(text.toString()));
                    var myLineChart = new Chart(ctxL, {
                        type: 'bar',
                        data: {
                            labels:
                                thisWeek(text.toString())
                            ,
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

                                        fetch('likeCount.php', {
                                            method: 'POST', headers: {
                                                'Content-Type': 'application/json'
                                            }, body: JSON.stringify({"index": index})
                                        }).then(function (response) {
                                            response.text().then(function (text) {
                                                var likecount = text;
                                                var tag = '&lt;span class="comment"&gt;&lt;div&gt; like '+text + '&lt;/div&gt;&lt;/span&gt;';
                                                document.getElementById('liketooltip').innerHTML = htmlUnescape(tag);
                                            })
                                        });



                                    ]
                                }
                            ]
                        },
                        options: {
                            responsive: true
                        }
                    });

                })
            });


        }

    }

    function nextWeek() {
        // alert(currentWeekIndex+"last"+ lastWeekIndex);
        alert(thisWeek("20191101"));
        // nextWeekBtn.disabled = true;
        if (currentWeekIndex == lastWeekIndex) {
            alert("마지막페이지입니다");
        } else {
            currentWeekIndex = currentWeekIndex +1;
        }

    }


    <?php

    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
    mysqli_query($conn, 'SET NAMES utf8');

    $sqlEachDay = "SELECT DATE(date) AS `eachDay`,
                                sum(`hit`)
                                FROM vistor
                                GROUP BY `eachDay`;";
    $resEachDay = $conn->query($sqlEachDay);

    ?>


    var myLineChart = new Chart(ctxL, {
        type: 'bar',
        data: {
            labels: [
                <?php
                while ($row = mysqli_fetch_array($resEachDay)) {
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
                        $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
                        mysqli_query($conn, 'SET NAMES utf8');
                        $sqlEachDay = "SELECT DATE(date) AS `eachDay`,
                                sum(`hit`)
                                FROM vistor
                                GROUP BY `eachDay`;";
                        $resEachDay = $conn->query($sqlEachDay);
                        while ($row = mysqli_fetch_array($resEachDay)) {
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
