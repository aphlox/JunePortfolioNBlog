<?php
ob_start();
require('lib/nav.php');
?>
<?php
header("Content-Type: text/html; charset=UTF-8");
require_once("../conf/dbInfo.php");
$conn = dbConn();
mysqli_query($conn, 'SET NAMES utf8');
$boardNum = $_GET['x'];


$cookieName = $boardNum; //쿠키 이름은 게시판 번호로 넣어준다.
$cookieValue = "1"; //쿠기 값으로 넣어준다.
setcookie($cookieName, $cookieValue, time() + (600), "/"); // 10분 동안 쿠키를 유지하도록 해준다.
if (!isset($_COOKIE[$cookieName])) { //쿠키가 만료되어 삭제되지 않는 이상 조회수는 첫 조회시만 1 증가시켜준다.
    $sqlHit = "UPDATE board set hit=hit+1 WHERE `id`=$boardNum";
    $resHit = $conn->query($sqlHit);
}

$sql = "select *from board where `id`='$boardNum'";
$res = $conn->query($sql);
$row = mysqli_fetch_array($res);
if ($res->num_rows != 1) {
    echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
    exit();
}
?>
<?php
$likeCondition = false;
$likeConditionString = "false";
if (isset($_COOKIE['likelist'])) {
    $likeList = explode(',', $_COOKIE['likelist']);

    for ($count = 0; $count < count($likeList); $count++) {
        if ($likeList[$count] == $boardNum) {
            $likeCondition = true;
            break;
        } else {
            $likeCondition = false;
        }
    }

    if ($likeCondition) {
        $likeConditionString = "true";
    } else {
        $likeConditionString = "false";
    }


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
    <!--사이드바 CSS 추가하기-->
    <link rel="stylesheet" href="css/sidebar.css">
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <!-- include summernote css/js-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
    <!-- include summernote-ko-KR -->
    <script src="js/summernote-ko-KR.js"></script>

</head>
<body>
<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <?php
        /*네비게이션*/
        nav();

        ?>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="page-header mt-3">
                <h2>글 보기</h2>
            </div>
            <p class="lead">게시글을 확인합니다.</p>
            <hr>
            <div>
            </div>
            <form method="post" class="pt-3 md-3" style="max-width: 920px">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="form-group">
                    <label>제목</label>
                    <p class="boardTitle"> <?php $title = str_replace(">", "&gt;", str_replace("<", "&lt;", $row['title']));
                        echo $title; ?></p>
                </div>
                <div class="form-group">
                    <label>내용</label>

                    <p>
                        <input id="readOnlyOn" onclick="toggleReadOnly();" type="button" value="Make CKEditor read-only" style="display:none">
                        <input id="readOnlyOff" onclick="toggleReadOnly( false );" type="button" value="Make CKEditor editable again" style="display:none">
                    </p>
                    <textarea id="summernote" name="contents">
                        <?php echo str_replace("＆", "&", $row['content']); ?>

                    </textarea>





                </div>

                <div id ="liketooltip"   style="height: 30px; width: 300px; margin-left: 20px" >
<!--                    <div  class="mt-5" style="height: 1px; width: 100px" data-toggle="tooltip" data-placement="top" title= "hi" ></div>
-->                </div>
                <span id = "like" onclick="clickLike(<?php echo $likeConditionString ?>,<?php echo $boardNum ?> )">

                </span>
                <!--어드민 로그인 시에만 글 수정, 삭제 가능(버튼이 보임)-->
                <?php if( (isset($_SESSION['id'])) &&  (isset($_SESSION['nickname'])) ){ ?>
                    <a href="boardEdit.php?x=<?php echo $_GET['x']; ?>" class="btn btn-primary" style="float: right">글
                        수정</a>
                    <a href="boardDelete.php?boardnum=<?php echo $_GET['x']; ?>" class="btn btn-primary"
                       style="float: right">글 삭제</a>
                <?php } ?>

                <!--게시글이 있던 페이지로 나가지게-->
                <a href="board.php?page=<?php echo $_GET['page']; ?>" class="btn btn-primary" style="float: right">글
                    목록</a>

            </form>
            <footer class="text-center" style="max-width: 920px;">
                <!--커피 로띠(후원용)-->
                <div onclick="coffeeSupport()"  style="width: 100%; text-align: center; background: #FFFFFF; display: table; height: 100px; overflow: hidden;" >
                    <div style=" display: inline-block; vertical-align: middle;">
                    <lottie-player
                            src="https://assets3.lottiefiles.com/datafiles/1vlSQNdkFMaQ88l/data.json"  background="white"   speed="1"  style="width: 150px; height: 150px;" loop  autoplay >
                    </lottie-player>
                        <div> <p style="font-family: 'Yu Gothic'">Buy Me a coffee? </p></div>
                    </div>
                </div>            </footer>
        </main>

    </div>
</div>
<!--로띠 좋아요-->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    $('#summernote').summernote({
        toolbar :false,
        height: 400,
        maxHeight: null,
        minHeight: 200,
        focus: true,
        lang: 'ko-KR',

    });
    $('#summernote').summernote('disable');


    window.onload = function Like() {

        /*처음에 현재 게시글에 대해서 좋아요 유무에 따라 로띠 애니메이션 틀어주기*/
        fetch('likeView.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "likecondition": <?php echo $likeConditionString; ?> ,
                "index": <?php echo $boardNum?>  })
        }).then(function (response) {
            response.text().then(function (text) {
                /*좋아요 했을때와 아닐때 로띠 애니메이션 다르게*/
                document.getElementById('like').innerHTML = text;
                /*좋아요 갯수*/
                var tag = '&lt;span class="comment"&gt;&lt;div&gt; like <?php echo $row['like'] ?> &lt;/div&gt;&lt;/span&gt;';
                document.getElementById('liketooltip').innerHTML = htmlUnescape(tag);


            })
        });
    };

    function clickLike(condition, index) {

        /*좋아요(엄지 척 로띠 애니메이션) 누를시*/
        fetch('likeCheck.php', {
            method: 'POST', headers: {
                'Content-Type': 'application/json'
            }, body: JSON.stringify({"likeCondition": condition, "index": index})
        }).then(function (response) {
            response.text().then(function (text) {
                /*좋아요 했을때와 아닐때 로띠 애니메이션 다르게*/
                document.getElementById('like').innerHTML = text;
                /*좋어요 갯수 실시간 동기화*/
                fetch('likeCount.php', {
                    method: 'POST', headers: {
                        'Content-Type': 'application/json'
                    }, body: JSON.stringify({"index": index})
                }).then(function (response) {
                    response.text().then(function (text) {
                        var likeCount = text;
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

</script>

</body>
</html>
