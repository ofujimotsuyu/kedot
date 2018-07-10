@extends('layouts.app')

@section('content')
<div class = "show">
    <img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/><br>
    <h2>{{ "目標 : " . $group->goal }}<br></h2>
    <h3>
        {{ "頑張ること : " . $group->to_do }}<br>
        {{ $group->term . "日間で" . $group->amount . $group->unit }}
    </h3>
    
    @include('buttons.join_button', ['group' => $group])
    <a href="{{ route('group.edit', $group->id) }}">編集</a>
</div>
@endsection