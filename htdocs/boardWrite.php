<!doctype html>
<html lang="ko">
<head>
    <title>June's Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- 부트스트랩 CSS 추가하기 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--사이드바 CSS 추가하기-->
    <link rel="stylesheet" href="css/sidebar.css">
    <!--CK Editor 적용-->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>-->
</head>
<body>
<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <?php
        /*네비게이션*/
        nav();
        ?>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="page-header mt-5">
                <h2>글 쓰기</h2>
            </div>
            <p class="lead">게시글을 작성합니다.</p>
            <hr>
            <div>
            </div>
            <form method="post" class="pt-3 md-3"
                  style="max-width: 920px">
                <div class="form-group">
                    <input type="hidden" name="method" value="post">
                    <label>제목</label>
                    <input formmethod="post" id="title" type="text" name="title" class="form-control"
                           placeholder="제목을 입력하세요.">
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea name="content" id="editor1" class="form-control" placeholder="내용을 입력하세요."
                              style="height: 320px;"></textarea>
                    <script>
                        /*CK Editor 적용*/
                        CKEDITOR.replace( 'content' ,{
                            filebrowserUploadUrl: '/lib/upload.php'
                        });
                    </script>
              </div>
                <!--                <form action="upload.php" method="post" enctype="multipart/form-data" target="test">
                    <input type="file" name="file[]" multiple="multiple" onchange="this.form.submit()">
                    <input type="hidden" name="time" value="<?php /*echo $_GET['starttime']; */?>">
                </form>
                <iframe name="test"></iframe>-->



                <button type="submit" style="float: right" onclick="apply(); return false;" class="btn btn-primary">글 쓰기</button>
                <!--                <button type="submit" style="float: right" name="submit" class="btn btn-primary">파일 업로드</button>-->

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
        var content = document.getElementById("editor1");

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


    function test() {

        alert(document.getElementById('editor1').value);
        location.href = "board.php";

    }


    function apply() {
        /*게시판 글 작성 적용하는 메소드 ( 글제목, 내용, 작성날짜)*/
        var x1 = document.getElementById("title").value.replace("+", "＋").replace(/#/g, "＃").replace(/&/g, "＆").replace(/=/g, "＝")
            .replace(/\\/g, "＼");
        var x2 =  CKEDITOR.instances.editor1.getData();


        var x3 = new Date();
        var x4 = <?php echo $_GET['starttime'];?>;

        var obj, dbParam, xmlhttp, myObj, x;
        obj = {
            "table": "board", "boardtitle": x1, "boardcontent": x2,
            "date": x3
        };
        dbParam = JSON.stringify(obj);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                for (x in myObj) {
                    if (myObj[x] == '1') {
                        //임시 저장된 세션 스토리지 삭제
                        sessionStorage.clear();
                        location.href = 'board.php';
                        return false;
                    } else {
                        alert("업로드 실패!");
                    }
                }
            }
        };

        /*글 내용, 제목 비어있나 체크하기*/
        if ((x2.trim() == "<br>") || (x2.trim() == "") || (x1.trim() == "")) {

            alert("입력된 텍스트가 없습니다.");

            return false;
        } else {
            document.getElementById("editor1").innerHTML = "";

            xmlhttp.open("POST", "boardapply.php", true);
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
<!--CK Editor 자바스크립트 추가하기-->
<script src="ckeditor/ckeditor.js"></script>
</body>
</html>
