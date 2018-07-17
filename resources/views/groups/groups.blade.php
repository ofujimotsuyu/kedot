@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row">
        <div class="">
            <?php $groups =\DB::table('groups')->orderby('created_at','DESC')->paginate(18); ?>
            <div class = "groups">
                @foreach($groups as $group)
                <div class = "each_group">
                    <a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/><p>{{ $group->goal }}</p></a>
                </div>
                @endforeach
            </div>
            <div align="center">
                <br>{!! $groups->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection