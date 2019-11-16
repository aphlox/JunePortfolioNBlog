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
        <nav class="col-md-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
            <div class="list-group border-0 card text-center text-md-left">
                <!--블로그 이름-->
                <h3 class="padding-64 text-center my-5 py-5 text-white">
                    <a href="index.html">
                        <span style="color: #FFFFFF"><b>June's<br>Blog</b></span>
                    </a>
                </h3>


                <!--collapsed 특정상황에서 보여지고 안 보여지게 -->
                <!--            <a href="./index.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                              <img style="width: 20px;" src="img/home.svg"><span class="d-none d-md-inline ml-1">메인</span>
                            </a>-->

                <a href="./portfolio.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/portfolio.png"><span
                            class="d-none d-md-inline ml-1">Portfolio</span>
                </a>

                <!--            <a href="#usermenu" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                             data-parent="#sidebar" aria-expanded="false">
                              <img style="width: 20px;" src="img/user.svg"><span class="d-none d-md-inline ml-1">회원 관리</span>
                            </a>
                            <div class="collapse" id="usermenu">
                              <a href="userJoin.html" class="list-group-item" data-parent="#sidebar">회원가입</a>
                              <a href="userLogin.html" class="list-group-item" data-parent="#sidebar">로그인</a>
                              <a href="userEdit.html" class="list-group-item" data-parent="#sidebar">회원정보수정</a>
                              <a href="userLogout.html" class="list-group-item" data-parent="#sidebar">로그아웃</a>
                            </div>-->
                <a href="board.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/android.png"><span class="d-none d-md-inline ml-1">Android</span>
                </a>
                <a href="board.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/java.png"><span class="d-none d-md-inline ml-1">Java</span>
                </a>
                <a href="board.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/php.png"><span class="d-none d-md-inline ml-1">Php</span>
                </a>
                <a href="board.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/python.png"><span class="d-none d-md-inline ml-1">Python</span>
                </a>
                <a href="board.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/unity.png"><span class="d-none d-md-inline ml-1">Unity</span>
                </a>

                <!--                <a href="qna.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                                    <img style="width: 25px;" src="img/message.svg"><span class="d-none d-md-inline ml-1">Q & A</span>
                                </a>-->
                <a href="#search" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <!--span 에 안 넣으면 창 크기 줄였을때 글씨가 안 사라지고 이상하게 남아있음-->
                    <img style="width: 25px;" src="img/search.svg"><span class="d-none d-md-inline ml-1">검색</span>
                </a>
                <div class="collapse" id="search">
                    <div class="input-group p-2" style="background-color: #1c1c1c;">
                        <input type="text" class="form-control" placeholder="내용을 입력하세요.">
                    </div>
                </div>
            </div>
        </nav>
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
                <a href="boardEdit.html" class="btn btn-primary">글 수정</a>
                <a href="#" class="btn btn-primary">글 삭제</a>
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
