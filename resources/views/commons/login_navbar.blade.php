<header>

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


/* checkbox */
.check {
    display: none;
}

/* menu button - label tag */
.menu-btn {
    position: fixed;
    display: block;
    top: 40px;
    right: 40px;
    display: block;
    width: 40px;
    height: 40px;
    font-size: 10px;
    text-align: center;
    cursor: pointer;
    z-index: 3;
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





.head{
    text-align: center;
    margin-right: 100px;
    margin-top: 25px;
    text-align: center;
}

.nav a{
    color:black;
    text-decoration:none;
}

header{
    height: 60px;
    width:100%;
}

.navleft{
    height: 60px;
    float:left;
}

.logo{
    padding-left:10px;
    margin: 0;
    position: absolute;
}

.navright{
    height: 60px;
    width: 200px;
    margin-left:93%;
}

@media(max-width: 991px){
    .navright{
    margin-left:70%;
    }
}

.vvv{
    float:left;
    padding-top:13px;
    padding-left:10px;
    width:55px;
    margin:0;
}

</style>

    <input type="checkbox" class="check" id="checked">
    <div class="ahaha">
        <ul class = "head">
            <div class="navleft">
                <li class = "nav"><h1 class="logo"><a href="/"><img src="{{ secure_asset("images/kedot.png") }}" style="width: 150px"></a></h1></li>            
            </div>
            <div class="navright">
                <li class = "nav vvv"><a href='{{ route('register') }}'>SignUp</a></li>
                <li class = "nav vvv"><a href='{{ route('login') }}'>Login</a></li>
                <li class = "nav vvv"><a href='/'>戻る</a></li>
            </div>
        </ul>
    </div>

</header>