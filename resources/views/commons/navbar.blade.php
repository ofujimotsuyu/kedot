<div class='header'>
    <style>
    /* common */
body {
    margin: 0;
    padding: 0;
    background: #fff;
}

ul {
  margin: 0;
  padding: 0;
	list-style: none;
}

.row{
    margin-top: 80px;
}
/* drawer menu */
/* 右から出てくるやつ*/
.drawer-menu {
    box-sizing: border-box;
    position: fixed;
    top: 0;
    right: 0;
    width: 200px;
    height: 100%;
    padding: 120px 0;
    background: #222;
    -webkit-transition-property: all;
    transition-property: all;
    -webkit-transition-duration: .5s;
    transition-duration: .5s;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -webkit-transform-origin: right center;
    -ms-transform-origin: right center;
    transform-origin: right center;
    -webkit-transform: perspective(500px) rotateY(-90deg);
    transform: perspective(500px) rotateY(-90deg);
    opacity: 0;
}

.drawer-menu li {
    text-align: center;
}

/*右から出てくるやつの中身*/
.drawer-menu li a {
    display: block;
    height: 50px;
    line-height: 50px;
    font-size: 14px;
    color: #fff;
    -webkit-transition: all .8s;
    transition: all .8s;
    text-decoration: none;
}

/*マウス乗せたとき*/
.drawer-menu li a:hover {
    color: #1a1e24;
    background: #fff;
}

/* checkbox */
.check {
    display: none;
}

/* menu button - label tag */
.menu-btn {
    position: fixed;
    display: block;
    top: 30px;
    right: 20px;
    display: block;
    width: 40px;
    height: 40px;
    font-size: 10px;
    text-align: center;
    cursor: pointer;
    z-index: 3;
}

.jitsu1 {
    position: fixed;
    display:block;
    top: 30px;
    right: 60px;
    width: 40px;
    height: 40px;
    z-index: 2000;
    
}

.jitsu2 {
    position: fixed;
    display:block;
    top: 30px;
    right: 100px;
    width: 40px;
    height: 40px;
    z-index: 2000;
}

.bar {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 40px;
    height: 1px;
    background: #fff;
    -webkit-transition: all .5s;
    transition: all .5s;
    -webkit-transform-origin: left top;
    -ms-transform-origin: left top;
    transform-origin: left top;
}

.bar.middle {
    top: 15px;
    opacity: 1;
}

.bar.bottom {
    top: 30px;
    -webkit-transform-origin: left bottom;
    -ms-transform-origin: left bottom;
    transform-origin: left bottom;
}

.menu-btn__text {
    position: absolute;
    bottom: -15px;
    left: 0;
    right: 0;
    margin: auto;
    color: #fff;
    -webkit-transition: all .5s;
    transition: all .5s;
    display: block;
    visibility: visible;
    opacity: 1;
}

.menu-btn:hover .bar {
    background: #999;
}

.menu-btn:hover .menu-btn__text {
    color: #999;
}

.close-menu {
    position: fixed;
    top: 0;
    right: 200px;
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,0);
    cursor: url(http://theorthodoxworks.com/demo/images/cross.svg),auto;
    -webkit-transition-property: all;
    transition-property: all;
    -webkit-transition-duration: .3s;
    transition-duration: .3s;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    visibility: hidden;
    opacity: 0;
}

/* checked */
.check:checked ~ .drawer-menu {
    -webkit-transition-delay: .3s;
    transition-delay: .3s;
    -webkit-transform: none;
    -ms-transform: none;
    transform: none;
    opacity: 1;
    z-index: 2;
}

.check:checked ~ .contents {
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -webkit-transform: translateX(-200px);
    -ms-transform: translateX(-200px);
    transform: translateX(-200px);
}

.check:checked ~ .menu-btn .menu-btn__text {
    visibility: hidden;
    opacity: 0;
}

.check:checked ~ .menu-btn .bar.top {
    width: 56px;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.check:checked ~ .menu-btn .bar.middle {
    opacity: 0;
}

.check:checked ~ .menu-btn .bar.bottom {
    width: 56px;
    top: 40px;
    -webkit-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
}

.check:checked ~ .close-menu {
    -webkit-transition-duration: 1s;
    transition-duration: 1s;
    -webkit-transition-delay: .3s;
    transition-delay: .3s;
    background: rgba(0,0,0,.5);
    visibility: visible;
    opacity: 1;
    z-index: 3;
}
.logo{
    top: 10px;
    /*padding-top:5px;*/
    padding-left:20px;
    margin: 0;
    position: fixed;
    z-index: 2000;
    
}

.header:after{
  content: ""; 
  display: block; 
  height: 0; 
  font-size:0;
}


.header{
    height: 65px;
    border-bottom-color: black;
    border-bottom: solid thin;
    z-index: 2000;
    background-color: white;
    position: fixed;
    width: 100%;
    top: 0px;
}

.jitsu{
    padding-top: 15px;
}

.head{
    text-align: center;
    margin-right: 100px;
    margin-top: 25px;
}


.fu {
    position: fixed;
    z-index: 2000;
}

@media(min-width: 1237px){
     .menu-btn{
        right: 20px !important;
    }
}


@media (max-width: 991px){
    .head{
        margin-right: 70px;
    }
    
    .menu-btn{
        right: 20px;
    }
}

.ahaha{
    /*display: inline-block;*/
    text-align: center;
}

.nav a{
    color: black;
    text-decoration: none;
}

.fu {
    position: fixed;
    z-index: 2000;
}
    
    </style>

    <input type="checkbox" class="check" id="checked">
    <div class="ahaha">
        <ul class = "head">
            <li class = "nav"><h1 class="logo"><a href="{{ route('groups.index' , ['id' => Auth::user()->id]) }}"><img src="{{ secure_asset("images/kedot.png") }}" style="width: 150px"></a></h1></li>
            <li class = "nav jitsu1"><a href="{{ route('groups.create' , ['id' => Auth::user()->id]) }}"><span class="glyphicon glyphicon-pencil" style="font-size:20px"></span></a></li>
            <li class = "nav jitsu2"><a href="{{ route('groups.search') }}"><span class="glyphicon glyphicon-search" style="font-size:20px"></span></a></li>
        </ul>
    </div>
    <label class="menu-btn" for="checked">
        <span class="glyphicon glyphicon-align-justify" style="font-size:20px"></span>
    </label>
    <label class="close-menu" for="checked"></label>
    <nav class="drawer-menu">
        <ul>
            <li><a href="{{ route('users.show' ,['id'=>Auth::user()->id]) }}">My page</a></li>
            <li><a href="{{ route('groups.create' ,['id'=>Auth::user()->id]) }}">グループ作成</a></li>
            <li><a href="{{ route('groups.search' ,['id'=>Auth::user()->id]) }}">検索</a></li>
            <li><a href="{{ route('user.favoritings' ,['id'=>Auth::user()->id]) }}">気になる目標</a></li>
            <li><a href="{{ route('user.tassei' ,['id'=>Auth::user()->id]) }}">達成リスト</a></li>
            <li><a href="{{ route('users.homeraretas', ['id'=>Auth::user()->id]) }}">お褒めの言葉</a></li>
            <li><a href="{{ route('users.index') }}">USERS</a></li>
            <li><a href="{{ route('user.requests', ['id' => Auth::User()->id]) }}">申請中一覧</a></li>
            <li><a href="{{ route('logout.get') }}">ログアウト</a></li>
        </ul>
    </nav>
</div>