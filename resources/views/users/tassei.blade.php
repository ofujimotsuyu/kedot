@extends("layouts.app")
<!--グループ名マウスオーバーで色変わる-->
<head>
    <style>
        h2 a{
        display: inline-block;
        padding: 0.1em 0.3em;
        transition: all .3s;
        color : black;
        text-decoration: none;
        }
        h2 a:hover {
        color: #fff;
        background-color: #00BCD4;
        text-decoration: none;
        }
        .nav a{
            font-size: 20px; 
        }
    </style>
</head>

@section("content")
<div class="" style="margin-top:100px">
    <div class="">
        <div class="">
            <!--きりんとかのプロフィール画像を画面の中央に表示-->
            <div class="doji">
            <p style="text-align:center"><img src="{{url($user->avatar_filename)}}" alt="avatar" /></p>
            <div class="user_name"> 
                <h1>{{ $user->name }}</h1>
            </div>
            
            <div class = "baka">
                <ul class="aho nav nav-pills nav-justified">
                    <li class = "col-xs-4 ccc {{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show' , ['id' => $user->id]) }}"><span class="glyphicon glyphicon-user" style="font-size:20px"></span> 参加グループ</a></li>
                    <li class = "col-xs-4 aaa {{ Request::is('users/*/favoritings') ? 'active' : '' }}"><a href="{{route('user.favoritings' ,['id' => $user->id]) }}"><span class="glyphicon glyphicon-star" style="font-size:20px"></span> お気に入り</a></li>
                    <li class = "col-xs-4 bbb mypage tab"><a href="{{ route('user.tassei', ['id'=> $user->id]) }}"><span class="glyphicon glyphicon-ok" style="font-size:20px"></span> 達成リスト</a></li>
                </ul>
            </div>
  
            <div class="">
                <div class="tasseisuu">
                    <?php $tasseisuu =0 ; ?>
                    @foreach($groups as $group)
                        <?php
                            $maxlen = 0;
                            $max = 0;
                            $goalnumber = \DB::table('groups')->where('id', $group->id)->value('amount');
                            $tassei=0;
                            $records = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get();
                            foreach($records as $record)
                            {   $tassei = $tassei + $record->record; }
                        ?>
                            @if( $tassei >= $goalnumber )
                                <?php $tasseisuu++ ?>
                            @endif
                    @endforeach
                    <h2>今まで達成した数</h2>
                    <h1>{{ $tasseisuu }}</h1>
                </div>
                <div class="tasseigroups">
                    <div class='groups'>
                    @foreach($groups as $group)
                        <?php
                            $maxlen = 0;
                            $max = 0;
                            $goalnumber = \DB::table('groups')->where('id', $group->id)->value('amount');
                            $tassei=0;
                            $records = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get();
                            foreach($records as $record)
                            {   $tassei = $tassei + $record->record; }
                        ?>
                            @if( $tassei >= $goalnumber )
                                <div class = "each_group">
                                    <div class="tasseiphoto">
                                        <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/><p>{{ $group->goal }}</p></a>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                    </div>
                </div>
            </div>

                
            
          
            </div>
        </div>
    </div>
</div>
@endsection