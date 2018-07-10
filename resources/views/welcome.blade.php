<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>kedot</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/media.css') }}">

    </head>

    @if(Auth::check())
    <body>
        @include('commons.navbar')

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
                    <?php $groups = App\Group::all(); ?>
                    <div class = "groups">
                        @foreach($groups as $group)
                        <div class = "each_group">
                            <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/></a>
                            <p>{{ $group->goal }}</p>
                        </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </body>
    @else
    <body class = 'toppage'>
        @yield('cover')

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
                    <!-- 現状groups.groupsにredirectしているけど一応残しておく -->
                    <!--未ログイン、未サインアップのユーザーには以下を表示-->
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
                </div>
            </div>
        </div>
    </body>
    @endif
</html>

