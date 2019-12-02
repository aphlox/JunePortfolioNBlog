<?php
require('lib/nav.php');
?>
<?php
$boardnum=$_GET['x'];

require_once("../conf/dbInfo.php");
$conn = dbConn();
mysqli_query ($conn, 'SET NAMES utf8');
$sql = "select *from board where `id`='$boardnum'";
$res = $conn->query($sql);
$row=mysqli_fetch_array($res);
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
      <!-- include libraries(jQuery, bootstrap) -->
      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
      <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
      <!-- include summernote css/js-->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
      <!-- include summernote-ko-KR -->
      <script src="js/summernote-ko-KR.js"></script>
      <script>
          var writef = function () {
              var markup = $('#summernote').summernote('code');
              return markup;
          }
      </script>
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
              <h2>글 수정</h2>
          </div>
          <p class="lead">게시글을 수정합니다.</p>

            <div>

            </div>

            <div class="writeboard">
                <form onsubmit="return writef();" action="boardEditApply.php" method="post">
                    <input name="num" type="hidden" value=<?php echo $_GET['x']?> >
                    <label>제목</label>
                    <input type="text" name="title" class="form-control mb-4" placeholder="제목을 입력하세요."
                           value="<?php $title=str_replace(">","&gt;",str_replace("<","&lt;",$row['title'])); echo $title; ?>">
                    <textarea id="summernote" name="contents"><?php echo str_replace("＆","&",$row['content']); ?></textarea>
                    <div align="center">
                        <button type="submit" style="float: right" class="btn btn-primary mt-4">글 수정</button>

                    </div>
                </form>
            </div>



          <footer class="text-center" style="max-width: 920px;">
<!--            <p>Copyright ⓒ 2019 <b>이현준</b> All Rights Reserved.</p>-->
          </footer>
        </main>
      </div>
    </div>
    <script>

        $('#summernote').summernote({

            height: 400,
            maxHeight: null,
            minHeight: 200,
            focus: true,
            lang: 'ko-KR',

        });


/*        window.onload = function autoSave() {
            // 저장할 텍스트 필드의 문장을 가져옵니다.
            var title = document.getElementById("title");
            var content = document.getElementById("editor");

            // 만약 autosave키의 값이 있다면
            // (이는 페이지가 의도치 않게 재시작 되었을 경우에만 해당됨)
            if (sessionStorage.getItem("titleautosave")) {
                // 저장된 문장을 텍스트 필드로 복구합니다.
                title.value = sessionStorage.getItem("titleautosave");
            }
            if (sessionStorage.getItem("contentautosave")) {
                // 저장된 문장을 텍스트 필드로 복구합니다.
                content.value = sessionStorage.getItem("contentautosave");
            }


            // 텍스트 필드 변경을 확인하고자 이벤트 리스너를 등록 합니다.
            title.addEventListener("change", function () {
                // session storage object에 변경된 값을 저장합니다.
                sessionStorage.setItem("titleautosave", title.value);
            });
            content.addEventListener("change", function () {
                // session storage object에 변경된 값을 저장합니다.
                sessionStorage.setItem("contentautosave", content.value);
            });

        };*/


    </script>
    <!-- 제이쿼리 자바스크립트 추가하기 -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper 자바스크립트 추가하기 -->
    <script src="js/popper.min.js"></script>
    <!-- 부트스트랩 자바스크립트 추가하기 -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
