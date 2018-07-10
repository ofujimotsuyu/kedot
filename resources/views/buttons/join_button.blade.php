@if (Auth::user()->is_joining($group->id))
    {!! Form::open(['route' => ['group.quit', $group->id], 'method' => 'delete']) !!}
        {!! Form::submit('退会', ['class' => "btn btn-warning btn-md"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['group.join', $group->id]]) !!}
        {!! Form::submit('参加', ['class' => "btn btn-default btn-md"]) !!}
    {!! Form::close() !!}
@endif