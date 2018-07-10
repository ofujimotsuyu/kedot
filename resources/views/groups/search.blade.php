@extends('layouts.app')


@section('content')
    <!--検索フォーム-->
    <!--actionでルートを指定-->
    <form method="get" action="./search" >
        <!--name=でcontrollerに送る名前を決定-->
        <input type="text" name="search">
        <input type="submit" value="search">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>
    
    <!--検索結果を表示-->
    <div class='search_result'>
    @foreach($groups as $group)
        {{$group->goal}}<br>
        <a href= "{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar" /></a><br>
    @endforeach
    </div>
    
    <!--paginateで同じデータを持ったまま、ページを移動-->
    {!! $groups->appends(['goal'=>$goal])->render() !!}

@endsection