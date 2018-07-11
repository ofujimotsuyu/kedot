@extends('layouts.app')

@section('content')
<div class = "show">
    <img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/><br>
    <h2>{{ "目標 : " . $group->goal }}<br></h2>
    <h3>
        {{ "頑張ること : " . $group->to_do }}<br>
        {{ $group->term . "日間で" . $group->amount . $group->unit }}
    </h3>
  
    <!--特定のuser_idとgroup_idを持つrecordの有無で、フォームを表示するかしないか分ける-->
    <?php $records = \DB::table('user_group')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get() ?>        
         
    @if(count($records) > 0)
        {!! Form::open(['route' => ['groups.store_activity', $group->id], 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('score', '数値', ['class' => 'control-label']) !!}
                {!! Form::textarea('score', null, ['class' => 'form-control', 'rows' => '1']) !!}
                
                {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
    @endif
  
    <!--user_groupテーブルにアクセス、該当のグループページのidをgroup_idカラムの値に持つレコードをすべて取り出す-->
    <?php $users = \DB::table('user_group')->where('group_id', $group->id)->get() ?>  

         <!--user_id, group_idを指定してすべてのレコードを取り出す作業を、上で定義した$userの一つずつに対して繰り返す-->
    @foreach($users as $user)
        <?php 
        $id = $user->user_id;
        $name = App\User::find($id); ?>
        
        {{ $user->user_id }}
        <h3>{{ $name->name }}</h3>
        
        <?php $records3 = \DB::table('activities')->where('user_id', $user->user_id)->where('group_id', $group->id)->get() ?>
        
        @foreach($records3 as $record)
            {{ $record->record }}
        @endforeach
        <br>
        
    @endforeach

    @include('buttons.join_button', ['group' => $group])

    <a href="{{ route('group.edit', $group->id) }}">編集</a>
</div>

@endsection


