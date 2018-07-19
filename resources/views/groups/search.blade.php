@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <!--検索フォーム-->
            <!--actionでルートを指定-->
            <div class="form-group search nomform">
                <h2 class="search_result">グループを検索しよう！</h2><br>
        
                <form class='form-inline'method="get" action="./search" >
                    <!--name=でcontrollerに送る名前を決定-->
                    <input class='form-control gigigi col-xs-8 col-md-8 col-lg-8 first-form' type="text" name="search" placeholder = "キーワードからグループを検索" >
                    {!! Form::select('category', [''=>'カテゴリー検索','ダイエット'=>'ダイエット','トレーニング'=>'トレーニング','学習'=>'学習','生活'=>'生活','健康・美容'=>'健康・美容','趣味'=>'趣味','その他'=>'その他'], '選択してください', ['class' => 'form-control first-form category-search', 'rows' => '1']) !!}
                    <button  class='form-control input_button' type="submit">
                        <span class="glyphicon glyphicon-search bobobo"></span>
                    </button>       
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>
            </div>
        
            <!--検索結果を表示-->
            <div class='search_result'>
                <h2>
                    @if($goal||$category)「@endif
                    {{$goal}}
                    <!--フリーワードとカテゴリー両方で検索してれば、を表示-->
                    @if($goal&&$category), @endif
                    {{ $category }}
                    @if($goal||$category)」の検索結果@endif
                    <!--何件が該当か表示-->
                    @if($goal||$category)
                        @if($groups->total()>0)
                            {{ $groups->firstItem() }}～{{ $groups->lastItem() }}件
                            （{{$groups->total()}}件中）
                        @else
                            0件
                        @endif
                    @endif
                </h2>
                <tr class="result">
                    <div class = "groups">
                        @foreach($groups as $group)
                        <div class = "each_group">
                            <td><a href="{{ route('groups.show', ['id' => $group->id]) }}"><img src="{{url($group->group_filename)}}" alt="avatar"/><p>{{ $group->goal }}</p></a>
                        </div>
                        @endforeach
                    </div>
                </tr>
                <div align="center">
                <br>{!! $groups->appends(['goal'=>$goal])->appends(['category'=>$category])->appends(['groups'=>$groups])->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection