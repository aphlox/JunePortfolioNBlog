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
                    <a class="nav-item nav-link active" href="./adminPageCountry.php">나라별 방문자 수</a>
                    <a class="nav-item nav-link " href="./adminPageUserInfo.php">방문자 정보</a>
                </div>
                <div class="navbar-nav mr-sm-2">
                    <a class="nav-item nav-link" href="./userLogout.html">로그아웃</a>
                </div>
            </div>
        </nav>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="list-group mt-3">
                <a href="#" class="list-group-item active">나라별 방문 지수</a>
                <div id="regions_div" style="width: 900px; height: 500px;"></div>

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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        /*            var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","checkCountryHit.php",true);
                    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlHttp.send();
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            myObj = JSON.parse(this.responseText);
                            for (x in myObj) {
                                if(myObj[x] == '1') {
                                    sessionStorage.clear();

                                } else {
                                    alert("업로드 실패!");

                                }
                            }
                        }
                    };*/


        <?php
        $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
        mysqli_query($conn, 'SET NAMES utf8');

        /*잘 저장되었나 확인*/
        $sql = "select *from vistor";
        $res = $conn->query($sql);
        //현재 페이지의 게시글 보여주기
        $arrayCountry = array();
        while ($row = mysqli_fetch_array($res)) {
            array_push($arrayCountry, $row['country'] );
        }
        $arrayCountry = array_unique($arrayCountry);

        ?>


        var data = google.visualization.arrayToDataTable([

            ['Country', 'hit'],

            <?php
            foreach ($arrayCountry as $country) {

            $sql = "select *from vistor where country = '$country' ";
            $res = $conn->query($sql);
            $hit = 2;
            while ($row = mysqli_fetch_array($res)) {
                $hit = $hit + (int)$row['hit'];
            }ki8
            //            $title = str_replace(">", "&gt", str_replace("<", "&lt", $row['title']));
            ?>
            [<?php echo "'$country'"; ?> ,<?php echo $hit; ?> ],

            <?php
            } ?>


        ]);


        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }
</script>


</body>
</html>
