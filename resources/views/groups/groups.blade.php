@extends('layouts.app')

@section('content')
    <?php $groups = App\Group::paginate(18); ?>
    <div class = "groups">
        @foreach($groups as $group)
        <div class = "each_group">
            <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/></a>
            <p>{{ $group->goal }}</p>
        </div>
        @endforeach
    </div>
        <div align="center">
            <br>{!! $groups->render() !!}
        </div>
@endsection