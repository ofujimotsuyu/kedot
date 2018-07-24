@if (Auth::user()->is_joining($group->id))
    <div class = "taikai">
        {!! Form::open(['route' => ['group.quit', $group->id], 'method' => 'delete']) !!}
            {!! Form::submit('退会', ['class' => "btn btn-ms"]) !!}
        {!! Form::close() !!}
    </div>
@elseif (Auth::user()->is_shinseing1($group->id))
    <div>
        <a href="{{ route('join.cancel',['id' => $group->id])}}"><p class='btn btn-primary btn-ms'>申請中</p></a>
    </div>
@elseif (Auth::user()->is_shinseing2($group->id))
    <div>
        <a href="{{ route('join.request',['id' => $group->id])}}"><p class='btn btn-primary btn-ms'>参加申請</p></a>
    </div>
@else
    {!! Form::open(['route' => ['group.join', $group->id]]) !!}
        {!! Form::submit('参加申請', ['class' => "btn btn-warning btn-ms"]) !!}
    {!! Form::close() !!}
@endif