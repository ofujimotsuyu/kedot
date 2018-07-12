@extends('layouts.app')

@section('content')

    <!--検索フォーム-->
    <!--actionでルートを指定-->
    <div class="form-group search">
        <form class='form-inline'method="get" action="./search" >
            <!--name=でcontrollerに送る名前を決定-->
            <input class='form-control gigigi col-xs-8 col-md-8 col-lg-8' type="text" name="search" >
            {!! Form::select('category', [''=>'選択してください','ダイエット'=>'ダイエット','トレーニング'=>'トレーニング','学習'=>'学習','生活'=>'生活','健康・美容'=>'健康・美容','趣味'=>'趣味','その他'=>'その他'], ['class' => 'form-control searchcategory', 'rows' => '1']) !!}
            <button  class='form-control input_button' type="submit">
                <span class="glyphicon glyphicon-search bobobo"></span>
            </button>       
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>

    <!--検索結果を表示-->
    <div class='search_result'>
    <h2>「{{$goal}}
    <!--フリーワードとカテゴリー両方で検索してれば、を表示-->
    @if($goal&&$category), @endif{{ $category }}
    」の検索結果</h2>
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