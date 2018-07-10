@extends('layouts.app')

@section('content')

    <!--検索フォーム-->
    <!--actionでルートを指定-->
    <div class="form-group">
        <form method="get" action="./search" >
            <!--name=でcontrollerに送る名前を決定-->
            <input type="text" name="search" >
            <input type="submit" value="検索">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>

    <!--検索結果を表示-->
    <div class='search_result'>
    @foreach($groups as $group)
        <div class = 'result'>
            <a href= "{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar" /></a><br>
            {{$group->goal}}
        </div>
    @endforeach
    </div>
    
    <!--paginateで同じデータを持ったまま、ページを移動-->
    {!! $groups->appends(['goal'=>$goal])->render() !!}

@endsection