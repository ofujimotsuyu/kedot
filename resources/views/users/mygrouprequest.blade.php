@extends("layouts.app")

@section("content")
    <div class='ramunoue requesttachi' align="center">
    <h2>グループ参加申請リスト</h2>
    <table class="table mygrouprequest">
    @foreach($groups as $group)
        <?php
        $requests = \DB::table('requestnotifications')->where('group_id', $group->id)->where('read', '0')->get();
        ?>
        @if(count($requests)>0)
        <tr class="">
            <th class="">{{ $group->goal }}</th>
            <td class=""><a href="{{ route('join.index', $group->id) }}">{{ count($requests).'件' }}</a></td>
        </tr>
        @endif
    @endforeach
        <tr class="">
            <th class=""></th>
            <td class=""></td>
        </tr>
    </table>
    </div>
@endsection