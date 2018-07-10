@extends('layouts.app')

@section('content')
    <?php
    $groups = App\Group::all();
    ?>
    <div class = "groups">
        @foreach($groups as $group)
        <div class = "each_group">
            <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/></a>
            <p>{{ $group->goal }}</p>
        </div>
        @endforeach    
    </div>
@endsection