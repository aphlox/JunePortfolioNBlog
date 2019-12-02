<?php
require('lib/nav.php');
?>

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
        /*네비게이션바*/
        nav();
        ?>
        <main id="main" class="col-md-9 float-left col pl-md-5 pt-3 main">
            <div class="page-header mt-5">
                <h2>글 쓰기</h2>
            </div>
            <p class="lead">게시글을 작성합니다.</p>
            <hr>


            <div class="writeboard">
                <form onsubmit="return writef();" action="write.php" method="post">
                    <label>제목</label>
                    <input type="text" name="title" class="form-control mb-4" placeholder="제목을 입력하세요.">
                    <textarea id="summernote" name="contents"></textarea>
                    <div align="center">
                        <button type="submit" style="float: right" class="btn btn-primary">글 쓰기</button>

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
/*        callbacks: {
            onImageUpload : function(files, editor, welEditable) {
                console.log('image uplodad:', files);
                sendFile(files[0], editor, welEditable);
            },
        }*/
    });

/*    function sendFile(file,editor,welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            url: "saveimage.php", // image 저장 소스
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
//       alert(data);
                var image = $('<img>').attr('src', '' + data); // 에디터에 img 태그로 저장을 하기 위함
                $('.summernote').summernote("insertNode", image[0]); // summernote 에디터에 img 태그를 보여줌
//       editor.insertImage(welEditable, data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus+" "+errorThrown);
            }
        });
    }
    $('form').on('submit', function (e) {
        e.preventDefault();
//     alert($('.summernote').summernote('code'));
//     alert($('.summernote').val());
    });*/




    /*    window.onload = function autoSave() {
            // 저장할 텍스트 필드의 문장을 가져옵니다.
            var title = document.getElementById("title");
            var content = document.getElementById("summernote");

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


<!-- Popper 자바스크립트 추가하기 -->
<script src="js/popper.min.js"></script>
<!-- 부트스트랩 자바스크립트 추가하기 -->
<script src="js/bootstrap.min.js"></script>
<!--CK Editor 자바스크립트 추가하기-->
<script src="ckeditor/ckeditor.js"></script>
</body>
</html>
