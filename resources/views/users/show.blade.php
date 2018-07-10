@extends("layouts.app")

@section("content")
    <div class="user_name"> 
    <h1>{{ $user->name }}</h1>
    </div>
    
    <div>
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">参加グループ</a></li>
            <li><a href="#">お気に入り</a></li>
            <li><a href="#">達成リスト</a></li>
        </ul>
    </div>
    
    <!--参加しているグループをforeachで呼び出す-->
    @foreach($groups as $group)
        <h2><a href="{{ route('groups.show', [ 'id' => $group->id ]) }}">{{ $group->goal }}</a></h2>
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