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

        
        
    </style>
</head>
@section("content")
<!--きりんとかのプロフィール画像を画面の中央に表示-->
    <p style="text-align:center"><img src="{{url($user->avatar_filename)}}" alt="avatar" /></p>
    <div class="user_name"> 
    <h1>{{ $user->name }}</h1>
    </div>
    
    <div>
        <ul class="nav nav-tabs nav-justified">
            <li class = "{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show' , ['id' => $user->id]) }}"><span class="glyphicon glyphicon-user" style="font-size:20px">参加グループ</span></a></li>
            <li class = "mypage tab"><a href="#"><span class="glyphicon glyphicon-star" style="font-size:20px">お気に入り</span></a></li>
            <li class = "mypage tab"><a href="#"><span class="glyphicon glyphicon-ok" style="font-size:20px">達成リスト</span></a></li>
        </ul>
    </div>
    
    <!--参加しているグループをforeachで呼び出す-->
    @foreach($groups as $group)
    
        <h2><a href="{{ route('groups.show', [ 'id' => $group->id ]) }}" style="text-decoration: none;">{{ $group->goal }}</a></h2>
        {{ "頑張ること : " . $group->to_do }}
        {{ $group->term . "日間で" . $group->amount . $group->unit }}
        <br>
        <!--activitiesテーブルにアクセス、'user_id'の値に'\Auth::user()'のidを持つ行をすべて取り出す、さらに'group_id'の値に'$group'のidを持つ行を特定する-->
        <?php $records = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get() ?>        
           
            <!--各グループにおいて、一つ一つのrecordカラムのvalueを取り出して表示する-->
            @foreach($records as $record)
                {{ $record->record }}        
            @endforeach
        <br>
        
    @endforeach
    
@endsection