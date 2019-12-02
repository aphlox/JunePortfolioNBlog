<html>
<head>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="../../summernote/summernote.css" rel="stylesheet">
    <script src="../../summernote/summernote.js"></script>
    <script src="../../js/write.js"></script>
</head>
<script>
    var writef = function(){
        var markup = $('#summernote').summernote('code');
        return markup;
    }
</script>
<body>
<div class="writeboard">
    <form onsubmit="return writef();" action="writeTest.php" method="post">
        <input type="text" name="title" class="board_title" placeholder="제목을 입력하세요.">
        <textarea id="summernote" name="contents"></textarea>
        <div align="center">
            <input type="submit" value="작성">
            <input type="button" id="btn" value="취소">
        </div>
    </form>
</div>
</body>
</html>
<script>


    $('#summernote').summernote({
        height : 400,
        maxHeight : null,
        minHeight : 200,
        focus : true,
        lang : 'ko-KR'
    });
</script>