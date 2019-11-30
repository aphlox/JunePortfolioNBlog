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

            <table style="margin-top: 100px" class="table">
                <tbody>
                <tr>
                    <th class="mobile" scope="col" style="width: 60px; text-align: center;">번호</th>
                    <th scope="col" style="text-align: center;">제목</th>
                    <th class="mobile" scope="col" style="width: 80px; text-align: center;">작성자</th>
                    <th class="mobile" scope="col" style="width: 120px; text-align: center;">작성일</th>
                </tr>
                <tr>
                    <th class="mobile" scope="row" style="text-align: center;">3</th>
                    <td>종합소득세 20% 할인 이벤트입니다!</td>
                    <td class="mobile" style="text-align: center;">운영자</td>
                    <td class="mobile" style="text-align: center;">2018-01-08</td>
                </tr>
                <tr>
                    <th class="mobile" scope="row" style="text-align: center;">2</th>
                    <td>신규 회원 포인트 적립 이벤트가 시작됩니다.</td>
                    <td class="mobile" style="text-align: center;">운영자</td>
                    <td class="mobile" style="text-align: center;">2018-01-07</td>
                </tr>
                <tr>
                    <th class="mobile" scope="row" style="text-align: center;">1</th>
                    <td>사이트 개설 수수료 10% 이벤트입니다.</td>
                    <td class="mobile" style="text-align: center;">운영자</td>
                    <td class="mobile" style="text-align: center;">2018-01-05</td>
                </tr>
                <tr>
                    <td colspan="4"><button class="btn btn-success" data-toggle="modal" data-target="#modal">이벤트 추가</button></td>
                </tr>
                </tbody>
            </table>
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




        <?php
        $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
        mysqli_query($conn, 'SET NAMES utf8');

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
            }
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
