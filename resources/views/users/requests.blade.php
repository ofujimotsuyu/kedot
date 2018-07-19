@extends('layouts.app')

@section('content')

<div class="container requests">
  <div class="row" align="center">
        <h2>{{ $user->name }}のグループ申請状況</h2>
        <h4>
            {{$requests->firstItem()}}～{{ $requests->lastItem() }}件
            @if($requests->total()>0)（{{ $requests->total() }}件中）@endif
        </h4>
        <table class="table table-bordered myrequests">
            @foreach($requests as $request)
            <?php $goal = DB::table('groups')->where('id',$request->group_id)->value('goal');
                  $photo = DB::table('groups')->where('id',$request->group_id)->value('group_filename'); ?>
            <tr class="each_request myrequest">
                <th>
                    <a href="{{ route('groups.show', [ $request->group_id ])}}">{{ $goal }}</a>
                </th>
                <td>
                    @if($request->status == '1')
                    <p class="alert alert-success" role="alert">申請中</p>    
                    @elseif($request->status == '2')
                    <p class="alert alert-info" role="alert">参加中</p>
                    @elseif($request->status == '0')
                    <p class="alert alert-warning" role="alert">canceled</p>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        <br>{!! $requests->render() !!}
        <div class="requestback">
            <a href="{{ route('users.show', [ 'id' => Auth::User()->id ]) }}"><p class='btn btn-primary'>マイページに戻る</p></a>
        </div>
  </div>
</div>

@endsection