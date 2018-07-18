@if($status==0 && Auth::user()->is_joining($group->id))
    <p class= "btn btn-ms btn-primary"> 申請中 </p>
@elseif (Auth::user()->is_joining($group->id))
<div class = "taikai">
    {!! Form::open(['route' => ['group.quit', $group->id], 'method' => 'delete']) !!}
        {!! Form::submit('退会', ['class' => "btn btn-ms"]) !!}
    {!! Form::close() !!}
</div>
@else
    {!! Form::open(['route' => ['group.join', $group->id]]) !!}
        {!! Form::submit('参加申請', ['class' => "btn btn-warning btn-ms"]) !!}
    {!! Form::close() !!}
@endif