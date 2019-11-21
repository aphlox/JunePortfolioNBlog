<?php
require('lib/nav.php');

$url = "http://192.168.204.138/board.php";

if (isset($_POST['submit'])) {
            $id = $_POST["id"];

            $form_data = array(
                'method' => 'DELETE',
                'id' => $id
            );


            $str = http_build_query($form_data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://192.168.204.138/boardManagerCurl.php");
            curl_setopt($ch, CURLOPT_POST,1);
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
$conn = new mysqli("192.168.204.138", "june", "Midarlk3134!", "juneblog");
mysqli_query ($conn, 'SET NAMES utf8');
$boardnum=$_GET['x'];
$cookie_name = $boardnum; //쿠키 이름은 게시판 번호로 넣어준다.
$cookie_value = "1"; //쿠기 값으로 넣어준다.
setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 1일 동안 쿠키를 유지하도록 해준다.
if(!isset($_COOKIE[$cookie_name])) { //쿠키가 삭제되지 않는 이상 조회수는 첫 조회시만 1 증가시켜준다.
    $sql2 = "UPDATE board set hit=hit+1 WHERE boardnum=$boardnum";
    $res2 = $conn->query($sql2);
}
$sql = "select *from board where boardnum='$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
if($res->num_rows!=1) {
    echo "<script>alert('존재하지 않는 게시물 경로입니다.'); location.href='board.php';</script>";
    exit();
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
                    echo("<script>location.href=  'http://192.168.204.138/board.php' </script>");
                }
                ?>
            </div>
            <form method="post" class="pt-3 md-3" style="max-width: 920px">
                <input type="hidden" name="id" value= "<?php echo $_GET['id']; ?>">
                <div class="form-group">
                    <label>제목</label>
                    <p class="boardTitle"> <?php $title=str_replace(">","&gt;",str_replace("<","&lt;",$row['boardtitle'])); echo $title; ?></p>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <p class="boardContent"><?php  echo str_replace("＆","&",$row['boardcontent']); ?>
                    </p>
                </div>

                <a href="boardEdit.php?x=<?php echo $_GET['x']; ?>" class="btn btn-primary">글 수정</a>
                <!--                <a href="boardManager.php?id=<?php /*echo $_GET['id']; */ ?>&method=delete" class="btn btn-primary">글 삭제</a>-->
                <a href="boarddelete.php?boardnum=<?php echo $_GET['x']; ?>" class="btn btn-primary">글 삭제</a>


<!--                <a href="board.html?page='.<?php /*echo $_GET['page'];*/?>.'" class="btn btn-primary">글 목록</a> -->
<!--                <a href= "board.html?page= $_GET['page']; ?>" class="btn btn-primary">글 목록</a>
-->                <a href="board.php?page=<?php echo $_GET['page']; ?>" class="btn btn-primary">글 목록</a>

            </form>
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
</body>
</html>
