<?php
function nav()
{
    session_start();

    echo ' <nav class="col-md-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
            <div class="list-group border-0 card text-center text-md-left">
                <!--블로그 이름-->
                <h3 class="padding-64 text-center my-5 py-5 text-white">
                    <a  href="index.html">
                        <span style="color: #FFFFFF"><b>June\'s<br>Blog</b></span>
                    </a>
                </h3>';
    if ((isset($_SESSION['id'])) && (isset($_SESSION['nickname']))) {
        echo '   <h4 class="text-center text-white">
                        <span onclick="logout()" style="color: #FFFFFF ">Admin Mode</span>
                    
                </h4>\';';
    } else {
        echo '       <h4 class="text-center text-white">
                    <a href="login.html">
                        <span style="color: #00ff0000 ">Admin login</span>
                    </a>
                </h4>';
    }

    echo '

         
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
                <a href="board.php" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                    <img style="width: 25px;" src="img/android.png"><span class="d-none d-md-inline ml-1">개발자노트</span>
                </a>


                <!--            <a href="qna.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                              <img style="width: 25px;" src="img/message.svg"><span class="d-none d-md-inline ml-1">Q & A</span>
                            </a>-->
                <a href="#search" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <!--span 에 안 넣으면 창 크기 줄였을때 글씨가 안 사라지고 이상하게 남아있음-->
                    <img style="width: 25px;" src="img/search.svg"><span class="d-none d-md-inline ml-1">검색</span>
                </a>

                <div class="collapse" id="search">
                <form name="search">
                    <div class="input-group p-2" style="background-color: #1c1c1c;">
             
                        <input name="searchtext" type="text" class="form-control" placeholder="내용을 입력하세요.">

                    </div>
                </form>

                </div>
                

          
            </div>
        </nav>';
}

?>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    function logout() {
        var result = confirm("관리자 모드에서 로그아웃 하시겠습니까?");
        if (result) {

            alert("로그아웃되었습니다");
            location.href = 'logout.php';


        } else {
        }
    }

    function coffeeSupport() {
        var allbloghit = localStorage.getItem('allbloghit');

        var result = confirm("June's Blog에 " + allbloghit + "번째 방문을 환영합니다 \n게시글들을 읽고 도움이 되셨다면 후원부탁드립니다!\n감사합니다 :) ");
        if (result) {
            alert("결제창으로 이동합니다");
            // location.href = 'logout.php';


        } else {
        }

    }

    window.onload = function blogHit() {
        //문자열이라 숫자로 인식하는것 주의하기
        var allbloghit;
        var today = new Date();
        today = String(today);
        today = today.substring(0, 15);
        var lasthitday;
        //블로그 총 방문횟수가 있으면 그 값 가져오기
        //없으면 처음 방문이니깐 1로 설정
        if (localStorage.getItem('allbloghit')) {
            allbloghit = localStorage.getItem('allbloghit');
        } else {
            allbloghit = 1;
        }
        if (localStorage.getItem('hitday')) {
            lasthitday = localStorage.getItem('hitday');
            if (today == lasthitday) {
                //마지막 접속날짜와 오늘 날짜가 같다면
                //아무것도 하지 않는다
            } else {
                //마지막 접속날짜와 오늘 날짜가 다르다면
                //블로그 방문횟수를 늘려주고
                //마지막 방문 날짜를 갱신해준다
                allbloghit = Number(allbloghit);
                allbloghit = allbloghit + 1;
                localStorage.setItem('hitday', today);
            }
        } else {//처음접속이면
            localStorage.setItem('hitday', today);
        }


        localStorage.setItem('allbloghit', allbloghit);


    }

    function press(f) {
        if (f.keyCode == 13) { //javascript에서는 13이 enter키를 의미함
            search.submit(); //formname에 사용자가 지정한 form의 name입력
        }
    }


</script>
