@if (Auth::user()->is_favoriting($group->id))
    {!! Form::open(['route' => ['group.unfavorite', $group->id], 'method' => 'delete']) !!}
        {!! Form::submit('★', ['class' => "btn btn-warning btn-xs"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['group.favorite', $group->id]]) !!}
        {!! Form::submit('☆', ['class' => "btn  btn-default btn-xs"]) !!}
    {!! Form::close() !!}
@endif