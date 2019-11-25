<?php
ob_start();
?>
<?php
require('lib/nav.php');

$url = "http://192.168.204.136/board.php";

if (isset($_POST['submit'])) {
    $id = $_POST["id"];

    $form_data = array(
        'method' => 'DELETE',
        'id' => $id
    );


    $str = http_build_query($form_data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://192.168.204.136/boardManagerCurl.php");
    curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $output = curl_exec($ch);
    curl_close($ch);
}

?>
<?php
header("Content-Type: text/html; charset=UTF-8");
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');
$boardnum = $_GET['x'];


$cookie_name = $boardnum; //쿠키 이름은 게시판 번호로 넣어준다.
$cookie_value = "1"; //쿠기 값으로 넣어준다.
setcookie($cookie_name, $cookie_value, time() + (600), "/"); // 10분 동안 쿠키를 유지하도록 해준다.
if (!isset($_COOKIE[$cookie_name])) { //쿠키가 만료되어 삭제되지 않는 이상 조회수는 첫 조회시만 1 증가시켜준다.
    $sql2 = "UPDATE board set hit=hit+1 WHERE boardnum=$boardnum";
    $res2 = $conn->query($sql2);
}
$sql = "select *from board where boardnum='$boardnum'";
$res = $conn->query($sql);
$row = mysqli_fetch_array($res);
if ($res->num_rows != 1) {
    echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
    exit();
}
?>
<?php
$likecondition = false;
$likeconditionstring = "false";
if (isset($_COOKIE['likelist'])) {
    $likelist = explode(',', $_COOKIE['likelist']);

    for ($count = 0; $count < count($likelist); $count++) {
        if ($likelist[$count] == $boardnum) {
            $likecondition = true;
            break;
        } else {
            $likecondition = false;
        }
    }

    if ($likecondition) {
        $likeconditionstring = "true";
    } else {
        $likeconditionstring = "false";
    }


} else {


}

?>
<!doctype html>
<html>
<head>
    <title>June's Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- 부트스트랩 CSS 추가하기 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <?php
        nav();

        ?>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="page-header mt-3">
                <h2>글 보기</h2>
            </div>
            <p class="lead">게시글을 확인합니다.</p>
            <hr>
            <div>
                <?php

                if (isset($output)) {
                    echo("<script>location.href=  'http://192.168.204.136/board.php' </script>");
                }
                ?>
            </div>
            <form method="post" class="pt-3 md-3" style="max-width: 920px">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="form-group">
                    <label>제목</label>
                    <p class="boardTitle"> <?php $title = str_replace(">", "&gt;", str_replace("<", "&lt;", $row['boardtitle']));
                        echo $title; ?></p>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <p class="boardContent"><?php echo str_replace("＆", "&", $row['boardcontent']); ?>
                    </p>
                </div>

                <div id ="liketooltip"   style="height: 30px; width: 300px; margin-left: 20px" >
<!--                    <div  class="mt-5" style="height: 1px; width: 100px" data-toggle="tooltip" data-placement="top" title= "hi" ></div>
-->                </div>
                <span id = "like" onclick="clickLike(<?php echo $likeconditionstring ?>,<?php echo $boardnum ?> )">

                </span>


                <a href="boardEdit.php?x=<?php echo $_GET['x']; ?>" class="btn btn-primary" style="float: right">글
                    수정</a>
                <a href="boarddelete.php?boardnum=<?php echo $_GET['x']; ?>" class="btn btn-primary"
                   style="float: right">글 삭제</a>


                <a href="board.php?page=<?php echo $_GET['page']; ?>" class="btn btn-primary" style="float: right">글
                    목록</a>

            </form>
            <footer class="text-center" style="max-width: 920px;">
                <div onclick="coffeeSupport()" style="text-align: center; background: #FFFFFF" >
                    <lottie-player
                            src="https://assets3.lottiefiles.com/datafiles/1vlSQNdkFMaQ88l/data.json"  background="white"   speed="1"  style="width: 150px; height: 150px;" loop  autoplay >
                    </lottie-player>
                </div>            </footer>
        </main>

    </div>
</div>
<!--로띠 좋아요-->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    window.onload = function Like() {

        fetch('likeView.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "likecondition": <?php echo $likeconditionstring; ?> ,
                "boardnum": <?php echo $boardnum?>  })
        }).then(function (response) {
            response.text().then(function (text) {
                document.getElementById('like').innerHTML = text;
                var tag = '&lt;span class="comment"&gt;&lt;div&gt; like <?php echo $row['like'] ?> &lt;/div&gt;&lt;/span&gt;';
                document.getElementById('liketooltip').innerHTML = htmlUnescape(tag);


            })
        });
    };

    function clickLike(condition, boardnum) {

        fetch('likeCheck.php', {
            method: 'POST', headers: {
                'Content-Type': 'application/json'
            }, body: JSON.stringify({"likecondition": condition, "boardnum": boardnum})
        }).then(function (response) {
            response.text().then(function (text) {
                document.getElementById('like').innerHTML = text;

                fetch('likeCount.php', {
                    method: 'POST', headers: {
                        'Content-Type': 'application/json'
                    }, body: JSON.stringify({"boardnum": boardnum})
                }).then(function (response) {
                    response.text().then(function (text) {
                        var likecount = text;
                        var tag = '&lt;span class="comment"&gt;&lt;div&gt; like '+text + '&lt;/div&gt;&lt;/span&gt;';
                        document.getElementById('liketooltip').innerHTML = htmlUnescape(tag);
                    })
                });
        })
        });



    }

    function htmlEscape(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    // I needed the opposite function today, so adding here too:
    function htmlUnescape(str){
        return str
            .replace(/&quot;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&lt;/g, '<')
            .replace(/&gt;/g, '>')
            .replace(/&amp;/g, '&');
    }

</script>
<!-- 제이쿼리 자바스크립트 추가하기 -->
<script src="js/jquery.min.js"></script>
<!-- Popper 자바스크립트 추가하기 -->
<script src="js/popper.min.js"></script>
<!-- 부트스트랩 자바스크립트 추가하기 -->
<script src="js/bootstrap.min.js"></script>
<script>
/*    $(function () {
        $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
    })*/
</script>

</body>
</html>
