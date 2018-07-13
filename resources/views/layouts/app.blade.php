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
        <link rel="stylesheet" href="{{ secure_asset('css/media.css') }}">
        
    </head>
    <body>
        @include('commons.error_messages')

        @if(Auth::check())
            @include('commons.navbar')
        @else
            @include('commons.login_navbar')
        @endif

        @yield('cover')

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
                @yield('content')
                </div>
            </div>
        </div>
    </body>
    
    <div class="footer">
        <div id="button">
        </div>
            <div id="container">
                <div id="cont">
                    <div class="footer_center">
                          <h3>御富士も梅雨</h3>
                          <h5>尾崎・柚木原・舟見・森井・土橋・實</h5>
                    </div>
                </div>
            </div>
    </div>
    
</html>