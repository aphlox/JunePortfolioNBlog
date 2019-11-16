<?php
function nav()
{

    echo ' <nav class="col-md-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
            <div class="list-group border-0 card text-center text-md-left">
                <!--블로그 이름-->
                <h3 class="padding-64 text-center my-5 py-5 text-white">
                    <a href="index.html">
                        <span style="color: #FFFFFF"><b>June\'s<br>Blog</b></span>
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

                <!--            <a href="qna.html" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
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
        </nav>';
}
?>