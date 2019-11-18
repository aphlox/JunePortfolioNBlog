<?php
require('lib/nav.php');
?>
<!doctype html>
<html>
<head>
    <title>커뮤니티 웹 사이트</title>
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
            <form class="pt-3 md-3" style="max-width: 920px">
                <div class="form-group">
                    <label>제목</label>
                    <p class="boardTitle"><?php echo $_GET['id']; ?></p>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <p class="boardContent"><?php
                            // 파일 열기
                            $fp = fopen("./data/".$_GET['id'] , "r") or die("파일을 열 수 없습니다！");

                            // 파일 내용 출력
                            while( !feof($fp) ) {
                            echo fgets($fp);
                            }

                            // 파일 닫기
                            fclose($fp);
                            ?>


                    </p>
                </div>
                <a href="boardEdit.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">글 수정</a>
                <a href="boardManager.php?id=<?php echo $_GET['id']; ?>&method=delete" class="btn btn-primary">글 삭제</a>
                <a href="board.html" class="btn btn-primary">글 목록</a>
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
