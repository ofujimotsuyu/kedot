<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>kedot</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    </head>
    <body class = 'toppage'>
        @if(Auth::check())
            @include('layouts.app')
        @endif
        @yield('cover')

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
                    <!-- 現状groups.groupsにredirectしているけど一応残しておく -->
                    @if(Auth::check())
                        <h1>welcome to kedot</h1>
                        <a href="{{ route('logout.get') }}">Logout</a>
                        
                    <!--未ログイン、未サインアップのユーザーには以下を表示-->
                    @else
                        <div class='login'>
                            <h3>
                                目標。
                                それは時に高く、困難な壁となる。一人で悩み、挫折することも多いだろう。
                                しかし、仲間がいればどうだろうか。集まることで人は強くなる。
                                Keep Doing Together
                            </h3>
                    
                            <div class = 'top-button'>
                                <!--routeのregister,loginは　web.php内の'Auth:routes'に含まれる-->
                                <a href="{{ route('register') }}", class="btn btn-default" >SignUp</a><br> 
                                <a href="{{ route('login')  }}", class="btn btn-default">LogIn</a>
                            </div>
                        </div>
                    @endif
               
                </div>
            </div>
        </div>
    </body>
</html>
