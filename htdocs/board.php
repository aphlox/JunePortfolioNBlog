<?php
require('lib/boardFuction.php');
require('lib/nav.php');
?>

<?php
ob_start() ;

header("Content-Type: text/html; charset=UTF-8");
$conn = new mysqli("192.168.204.136", "june", "Midarlk3134!", "juneblog");
mysqli_query($conn, 'SET NAMES utf8');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
/*if (isset($_GET['pagination'])) {
    $pagination = $_GET['pagination'];
} else {
    $pagination = 1;
}*/
$sql = "select * from board";
$res = $conn->query($sql);

$totalboardnum = mysqli_num_rows($res); //총 게시물 수
$totalpagenum = ceil($totalboardnum / 10); //총 페이지 수 = 총 게시물 수 / 한 페이지당 나타낼 게시물 수
$totalblocknum = ceil($totalpagenum / 5); //총 블록 수 = 총 페이지 수 / 한 블록에 나타낼 페이지 수
$currentpagenum = (($page - 1) * 10); //현재 페이지 번호 = (페이지 번호-1)*10
$sql2 = "select *from board order by boardnum desc limit $currentpagenum,10";
$res2 = $conn->query($sql2) or die(mysqli_error($conn));
$num2 = (($page - 1) * 10) + 1;

/*검색용*/
$where = "title like as";
$sql3 = "select *from board where boardtitle like '%ㅇ%' order by boardnum asc limit $currentpagenum,10";
$res3 = $conn->query($sql3) or die(mysqli_error($conn));
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

                <?php
                //현재 페이지의 게시글 보여주기
                while ($row = mysqli_fetch_array($res2)) {
                    $num = $row['boardnum'];
                    $title = str_replace(">", "&gt", str_replace("<", "&lt", $row['boardtitle']));
                    $title2 = str_replace(">", "&gt", str_replace("<", "&lt", $row['boardtitle']));
                    ?>
                    <tr style="cursor:pointer;" onClick="location.href='/boardView.php?x=<?php echo $num; ?>&page=<?php echo $page ?>'">
                        <th><?php echo $num; ?></th>
                        <th><?php echo $title; ?></th>
                        <th><?php echo substr($row['date'], 0, 10); ?></th>
                        <th><?php echo $row['hit'];?></th>
                    </tr>
                    <?php $num2++;
                } ?>


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
                <?php
                //현재 페이지 값을 통해 현재의 section값(ex 1~10, 31~40)을 얻음
                //-1을 한것은 예를 들어 40페이지면 다음섹션으로 인식돼서
                $nowSection = floor((int)(get_this_page() - 1) / 10);

                $lastSection = floor(ceil($totalboardnum) / 100);
                $lastPage = floor((ceil($totalboardnum) - 1) / 10) + 1;

                if ($nowSection == 0) {
                    echo '
                    <li class="page-item disabled">
                <a class="page-link" href="board.php?page=' . ((($nowSection - 1) * 10) + 1) . '">&laquo;</a>
                </li>
                ';
                } else {
                    echo '
                <li class="page-item ">
                    <a class="page-link" href="board.php?page=' . ((($nowSection - 1) * 10) + 1) . '">&laquo;</a>
                </li>
                ';
                }


                for ($count = $nowSection * 10 + 1; $count <= $nowSection * 10 + 10; $count++) {
                    //섹션에 있는 페이지 숫자가 마지막페이지보다 많으면 출력 멈추기
                    if ($count > $lastPage) {
                        break;
                    } else {

                        if (strcmp(get_this_page(), $count) == 0) {
                            echo '
                <li class="page-item active "><a href="board.php?page=' . $count . '"
                                                 class="page-link mobile">' . $count . '</a></li>
                ';

                        } else {
                            echo '
                <li class="page-item "><a href="board.php?page=' . $count . '" class="page-link mobile">' . $count . '</a></li>
                ';
                        }
                    }
                }

                //지금있는 section(1 section =1~10페이지)이 마지막 section하고 같으면
                //다음 section 으로 넘어가는 버튼 비활성화
                if ($nowSection == $lastSection) {
                    echo '
                <li class="page-item disabled">
                    <a class="page-link" href="board.php?page=' . ((($nowSection + 1) * 10) + 1) . '">&raquo;</a>
                </li>
                ';
                } else {
                    echo '
                <li class="page-item ">
                    <a class="page-link" href="board.php?page=' . ((($nowSection + 1) * 10) + 1) . '">&raquo;</a>
                </li>
                ';
                }

                ?>
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
