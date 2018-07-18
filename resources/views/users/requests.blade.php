@extends('layouts.app')

@section('content')

<div class="container requests">
  <div class="row" align="center">
        <h2>{{ $user->name }}のグループ申請状況</h2>
        <table class="table table-bordered myrequests">
            @foreach($requests as $request)
            <?php $goal = DB::table('groups')->where('id',$request->group_id)->value('goal');
                  $photo = DB::table('groups')->where('id',$request->group_id)->value('group_filename'); ?>
            <tr class="each_request myrequest">
                <th>
                    <a href="{{ route('groups.show', [ $request->group_id ])}}">{{ $goal }}</a>
                </th>
                <td>
                    @if($request->status == '0')
                    <p class="alert alert-success" role="alert">申請中</p>    
                    @elseif($request->status == '1')
                    <p class="alert alert-info" role="alert">参加中</p>
                    @elseif($request->status == '2')
                    <p class="alert alert-default" role="alert">キャンセルされました。。</p>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
  </div>
</div>

@endsection