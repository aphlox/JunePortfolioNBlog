<?php
require('lib/nav.php');

if (isset($_POST['submit'])){
           $title = $_POST["title"];
           $content = $_POST['content'];

           $form_data = array(
                             'title' => $title,
                             'content' => $content

           );

           $str = http_build_query($form_data);

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL,"http://192.168.204.137/boardManagerCurl.php");
//           curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
           curl_setopt($ch,CURLOPT_POSTFIELDS, $str);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $output = curl_exec($ch);
           curl_close($ch);
}
?>


<!doctype html>
<html lang="ko">
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
            <div class="page-header mt-5">
                <h2>글 쓰기</h2>
            </div>
            <p class="lead">게시글을 작성합니다.</p>
            <hr>
            <div>
                <?php
                if(isset($output)){
                    echo $output;
                }
                ?>
            </div>
            <!-- action="http://192.168.204.137/boardManager.php"-->
            <form method="post" class="pt-3 md-3"
                  style="max-width: 920px">
                <div class="form-group">
                    <input type="hidden" name="method" value="post">
                    <label>제목</label>
                    <input formmethod="post" type="text" name="title" class="form-control" placeholder="제목을 입력하세요.">
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea name="content" class="form-control" placeholder="내용을 입력하세요."
                              style="height: 320px;"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">글 쓰기</button>
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
