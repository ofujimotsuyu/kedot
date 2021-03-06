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
                <div class="">
                    <p class="groupitiran">グループ一覧</p>
                    <div class="papabox">
                    	<a class="Abutton" href="#popup1">How to use kedot</a>
                    </div>
                    
                            
                   <div class="groupscss">
                        <ul class="groups nav nav-pills nav-justified">
                             <li class ="col-xs-6 mygroups1"><a href="{{ route('groups.mygroups', ['id' => \Auth::user()->id] ) }}">my group</a></li>
                            <li class ="col-xs-6 allgroup1"><a href="{{ route('groups.index' , ['id' => \Auth::user()->id] ) }}">all group</a></li>
                           
                        </ul>
                    </div>
           <?php $groups = \Auth::User()->sankagroups()->paginate(18)?>
                    
                    
                    
                    <div class = "groups">
              @foreach($groups as $group)
                  <div class = "each_group">
                  <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/><p>{{ $group->goal }}</p></a>
                  </div>
              @endforeach
              </div>
                    
                    
                    
                    
                    <div align="center">
                        <br>{!! $groups->render() !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div id="popup1" class="overlay" style="z-index: 8000">
        	<div class="popup">
        		<div class="content">
            		<a class="close" href="#">CLOSE</a>
        			@include('commons.explanation')
        		</div>
        	</div>
        </div>
    </body>
    <footer>
          <address>©Ofujimotsuyu2018</address>
    </footer>
    @else
    <body class = 'toppage'>
        <div class = "block-one">
            <p class="kedotlogo"><img src="{{ secure_asset("images/kedot.png") }}"></p>
            <p class="ofuji">Produced by <img src="{{ secure_asset("images/logo_ofuji.png") }}"></p>
        </div>
        
        <script>
          $(".block-one").fadeIn(500);
          $(document).ready(function(){
            setTimeout(function() {
              $(".block-two").css("display","block");
              $(".block-one").fadeOut(300);
            }, 2000);
          });
        </script>
        
        <div class = "block-two">
            @yield('cover')
    
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
                        <!-- 現状groups.groupsにredirectしているけど一応残しておく -->
                        <!--未ログイン、未サインアップのユーザーには以下を表示-->
                            <div class='login'>
                                <h3>
                                    目標。<br>
                                    それは時に高く、困難な壁となる。<br>
                                    一人で悩み、挫折することも多いだろう。<br>
                                    しかし、仲間がいればどうだろうか。<br>
                                    集まることで人は強くなる。<br>
                                    <p>Keep Doing Together</p>
                                    <p>三日坊主を防ぐアプリ</p>
                                    <img style="width:100px" src="{{ secure_asset("images/kedot.png") }}">
                                </h3>
                        
                                <div class = 'top-button col-xs-6'>
                                    <!--routeのregister,loginは　web.php内の'Auth:routes'に含まれる-->
                                    <a href="{{ route('register') }}", class="wankos" >Sign Up</a>
                                    <a href="{{ route('login')  }}", class="wankos">Log In</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @endif
</html>

