<?php
require('lib/nav.php');
if (isset($_POST['submit'])) {

    $oldTitle = $_POST["oldTitle"];
    $title = $_POST["title"];
    $content = $_POST['content'];
    $form_data = array(
        'method' => 'PUT',
        'oldTitle' => $oldTitle,
        'title' => $title,
        'content' => $content
    );



    $str = http_build_query($form_data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://192.168.204.138/boardManagerCurl.php");
    curl_setopt($ch, CURLOPT_POST,1);

//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
}

?>
<?php
$boardnum=$_GET['x'];

$conn = new mysqli("192.168.204.138", "june", "Midarlk3134!", "juneblog");
mysqli_query ($conn, 'SET NAMES utf8');
$sql = "select *from board where boardnum='$boardnum'";
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
                <?php

                if (isset($output)) {
                    echo("<script>location.href=  'http://192.168.204.138/board.php' </script>");

                }
                ?>
            </div>
          <hr>
            <!--put 메소드로 처리하라고 post로 보내주기-->
          <form method="post"  class="pt-3 md-3" style="max-width: 920px">
            <div class="form-group">
                <input type="hidden" name="method" value="put">
                <input type="hidden" name="oldTitle" value="<?php echo $_GET['id']; ?>">
              <label>제목</label>
              <input type="text" name = "title" id="title"  class="form-control"  placeholder="제목을 입력하세요."
                     value="<?php $title=str_replace(">","&gt;",str_replace("<","&lt;",$row['boardtitle'])); echo $title; ?>">
            </div>
            <div class="form-group">
              <label>내용</label>
              <textarea name = "content" id="editor"  class="form-control" placeholder="내용을 입력하세요." style="height: 320px;"><?php echo str_replace("＆","&",$row['boardcontent']); ?></textarea>
            </div>
            <button onclick="apply(); return false;"  class="btn btn-primary">글 수정</button>
          </form>
          <footer class="text-center" style="max-width: 920px;">
<!--            <p>Copyright ⓒ 2019 <b>이현준</b> All Rights Reserved.</p>-->
          </footer>
        </main>
      </div>
    </div>
    <script>
        window.onload = function autoSave() {
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

        };



        function apply() {
            var x1 = document.getElementById("title").value.replace("+","＋").replace(/#/g,"＃").replace(/&/g,"＆").replace(/=/g,"＝")
                .replace(/\\/g,"＼");
            var x2 = document.getElementById("editor").value;
            var obj, dbParam, xmlhttp, myObj, x;
            obj={"table":"board","boardtitle":x1,"boardcontent":x2,"boardnum":"<?php echo $boardnum; ?>"};
            dbParam = JSON.stringify(obj);
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    for (x in myObj) {
                        if(myObj[x] == '1') {
                            sessionStorage.clear();

                            location.href='board.php';
                            return false;
                        } else {
                            alert("업로드 실패!");

                        }
                    }
                }
            };
            if((x2.trim() == "<br>")||(x2.trim()=="")||(x1.trim() == "")) {
                alert("입력된 텍스트가 없습니다.");
                return false;
            } else {
                document.getElementById("editor").innerHTML = "";
                xmlhttp.open("POST","boardupdateapply.php",true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("x=" + dbParam);
            }
        }
    </script>
    <!-- 제이쿼리 자바스크립트 추가하기 -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper 자바스크립트 추가하기 -->
    <script src="js/popper.min.js"></script>
    <!-- 부트스트랩 자바스크립트 추가하기 -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
