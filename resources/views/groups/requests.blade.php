@extends('layouts.app')

@section('content')
<div class="container requests">
    <div class="row" align="center">
        <h2>{{ $group->goal }} 参加申請リスト</h2>
        <h4>
            @if($admitwaitings->total()>0)
                {{$admitwaitings->firstItem()}}～{{ $admitwaitings->lastItem() }}件
                （{{ $admitwaitings->total() }}件中）
            @else
                0件
            @endif
        </h4>
        <div align="center">
            <table class="requestlist">
            @foreach($admitwaitings as $admitwaiting)

            <?php $name = DB::table('users')->where('id',$admitwaiting->user_id)->value('name');
                  $photo = DB::table('users')->where('id',$admitwaiting->user_id)->value('avatar_filename'); ?>
            
            <tr class='each_request'>
                <th class="minami"><a href="{{ route('users.show', ['id' => $admitwaiting->user_id] ) }}"><img src="{{ url($photo)}}" alt="avatar" /><p class='btn button-primary'>{{$name}}</p></a></th>
                <td><a href="{{ route('join.admit', ['id' => $group->id ,'request_id' => $admitwaiting->id ] ) }}"><p class='btn btn-success'>許可</p></a>
                <a href="{{ route('join.cancel',['id' => $group->id ,'request_id' => $admitwaiting->id ])}}"><p class='btn btn-default'>削除</p></a></td>
            </tr>  
            
            @endforeach
            </table>
            <br> {!! $admitwaitings->render() !!}
            <div class="requestback">
                <a href="{{ route('groups.show', [ 'id' => $group->id ]) }}"><p class='btn btn-primary'>グループ詳細ページに戻る</p></a>
            </div>
        </div>
    </div>
</div>


@endsection