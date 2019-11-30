<html>
<head>
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
</head>
<body>
<div id="regions_div" style="width: 900px; height: 500px;"></div>
</body>
</html>
