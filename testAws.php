<?php
require('lib/nav.php');
?>

<?php
ob_start() ;

header("Content-Type: text/html; charset=UTF-8");
$conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if($conn->conn_errno){
    echo '[연결실패..] : '.$conn->conn_error.'';
}else{
    echo '[연결성공!]'.'<br>';
}

$sqlBoard = "select *from board";
$resBoard = $conn->query($sqlBoard) or die(mysqli_error($conn));


?>

<!doctype html>
<html>
<head>
    <title>June's Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- 부트스트랩 CSS 추가하기 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--사이드바 css 적용-->
    <link rel="stylesheet" href="css/sidebar.css">

</head>
<body>
<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <?php
        //네비게이션
        nav();
        ?>

        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="page-header mt-3">
                <h2>게시판</h2>
            </div>
            <p class="lead"></p>
            <hr>
            <table class="table table-striped" style="max-width: 1080px;">
                <thead>
                <tr>
                    <th scope="col" class="mobile" style="width:55px; text-align:center;">번호</th>
                    <th scope="col" class="mobile" style="text-align:center;">제목</th>
                    <th scope="col" class="mobile" style="width:200px; text-align:center;">작성일</th>
                    <th scope="col" class="mobile" style="width:100px; text-align:center;">조회수</th>
                </tr>
                </thead>
                <tbody>




                </tbody>
            </table>
            <div style="max-width: 1080px;">
                <!--섹션 아이디 로그인 있을때
                    => 어드민으로 들어와있을 때에만 글쓰기 가능-->
                <?php if( (isset($_SESSION['id'])) &&  (isset($_SESSION['nickname'])) ){ ?>
                    <a href="boardWrite.php?starttime=<?php echo time(); ?>" class="btn btn-primary float-right">글쓰기</a>
                <?php } ?>
            </div>
            <ul class="pagination">

            </ul>
            <footer class="text-center" style="max-width: 1080px;">
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