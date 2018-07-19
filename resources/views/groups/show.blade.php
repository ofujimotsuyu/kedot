@extends('layouts.app')

@section('content')
<div class="ramunoue">
    <div class="ramu">
        <div class="ramuimg col-sm-4 col-sm-offset-1">    
            <img src="{{url($group->group_filename)}}" alt="avatar"/><br>
        </div>
        
        <div class="ramumoji col-sm-7">
            <div class="favoB">
                <h2>{{ $group->goal }}</h2>
                <h3>@include('buttons.favorite_button', ['group' => $group])</h3>
            </div>
            <div>
                <h3>
                    {{"カテゴリー　: " . $group->category}}<br>
                    {{ "頑張ること : " . $group->to_do }}<br>
                    {{ $group->term . "日間で" . $group->amount . $group->unit }}
                </h3>
                
                
                <?php
        
                function day_diff($group) {
                 
                    // 日付をUNIXタイムスタンプに変換
                    $timestamp1 = strtotime("$group->created_at");
                    
                    $timestamp2 =  strtotime("now");
            
                    // 何秒離れているかを計算
                    $seconddiff = abs($timestamp2 - $timestamp1);
                 
                    // 日数に変換
                    $daydiff = $seconddiff / (60 * 60 * 24);
                 
                    // 戻り値
                    return $daydiff;
                }
                 
                // 日付を関数に渡す
                $day = day_diff($group);
                
                 
                $nokori = $group->term - $day;
                ?>
                <!--参加ユーザーにのみ見せる-->
                @if(floor($nokori)<=-1)
                <div class="yunoki">
                    <div class="sakujoC henshuB">
                            <a href="{{ route('delete_confirm', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">削除</p></a>
                    </div>
                </div>
                @elseif(Auth::User()->is_joining($group->id))
                    <div class="henshuB col-xs-4">
                        <a href="{{ route('group.edit', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">編集</p></a>
                    </div>
                    <div class="sakujoB col-xs-4">
                        <a href="{{ route('delete_confirm', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">削除</p></a>
                    </div>
                @endif
            </div>
            @if(floor($nokori)<=-1)
            @elseif($group->user_id==Auth::User()->id)
                <div class="col-xs-4" style="float:center">
                    @include('buttons.join_button', ['group' => $group])
                </div>
            @else
                <div class="col-xs-4" style="float:center">
                    @include('buttons.join_button', ['group' => $group])
                </div>
            @endif
            
            <?php
                
                $records = \DB::table('user_group')->where('group_id', $group->id)->where('status', '1')->get();       
                $id = \Auth::user()->id;
                $name = App\User::find($id);
                $records3 = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get();
                
                $tassei=0;
                foreach($records3 as $record) {
                $tassei = $tassei + $record->record;
                }
                $nokori=$group->amount - $tassei;
                
                $unit=\DB::table('groups')->where('id', $group->id)->value('unit');
                
            ?>
            
            @if(floor($nokori)<=-1)
            @elseif(Auth::User()->is_joining($group->id))
            <div class='pau'>    
                <div class = "tasseiform">
                    <!--formつくってるよ-->
                    {!! Form::open(['route' => ['groups.store_activity', $group->id], 'files' => true]) !!}
                    <form class="form-inline">
                        <div class="form-group">
                            {!! Form::text('score', null, ['class' => 'col-xs-6 form-control form-xs', 'rows' => '1','placeholder'=>'本日の達成値を入力']) !!}
                
                            {!! Form::submit('Post', ['class' => 'col-xs-6 btn btn-success btn-block btn-md']) !!}
                        </div>
                    </form>
                    {!! Form::close() !!}
                </div>
                <div class='fg'>
                    残り{{ $nokori.$unit }}
                </div>
            </div>
            
            @endif
        </div>
</div>
<div class = "show">
  
    <!--特定のuser_idとgroup_idを持つrecordの有無で、フォームを表示するかしないか分ける-->
  
  <!--中間テーブルからグループに参加してるメンバーを取り出している-->
        
        <?php $users = \DB::table('user_group')->where('group_id', $group->id)->where('status', '2')->get() ?>  

      
        
        @if (floor($nokori)<=-1)
        <div class="timeuptop">
            <h1 class="timeup">終了！お疲れさまでした！</h1>
        @else
        <div class="nokoritoptop">
            <h1 class="nokoritop">残り</h1>
            <h1 class="nokori">{{  floor( $nokori ) . '日' }}</h1>
        </div>
        @endif
    <div class="tyonmage">
        <table width="80%" align="center" rules="none" cellspacing="0">
        <h1>達成度</h1>
        
        <div class= "chonmagege">
            <!--グラフを作る-->
            <?php
            $maxlen = 0;
            $max = 0;
                $data[0] = array("目標値", $group->amount);
                foreach ($users as $key => $user) {
                    $id = $user->user_id;
                    $name = App\User::find($id); 
                    
                    $records3 = \DB::table('activities')->where('user_id', $user->user_id)->where('group_id', $group->id)->get();
                    
                    $tassei=0;
                    foreach($records3 as $record) {
                        $tassei = $tassei + $record->record;
                    }
                    
                    $data[$key+1] = array($name->name, $tassei);
                }
                ?>
                <div class = "gurafu">
                <?php
                if(!empty($name)){
                    for($i = 0 ; $i < count($data) ; $i++) {
                        if(strlen($data[$i][0]) > $maxlen) {        
                            $maxlen = strlen($data[$i][0]);
                        }
                        if($data[$i][1] > $max) {           
                            $max = $data[$i][1];
                        }
                    }
                
                    for($i = 0 ; $i < count($data) ; $i++) {    
                        print("<tr>");
                        printf("<td class = \"bab\"  align=\"left\">%s</td>", $data[$i][0]);
                        printf("<td><hr color=\"white\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
                        printf("<td width=\"%d\">%d</td>", strlen($max) * 10, $data[$i][1]);
                        print("</tr>\n");
                    }
    
                }
                ?>
                </div>
                    
            
            
        </div>
        </table>
    </div>
    
     <?php $members=0 ?>
        <div style="text-align:center"><h1 class="sankasya">メンバー</h1><br></div>
        <div class="box">
            @foreach($users as $user)
                <?php 
                $members= $members+1;
                
                $id = $user->user_id;
                $name = App\User::find($id); ?>
                
                <div class = "sankashiteru col-xs-4">
                    <a href="{{ route('users.show',['id'=>$name->id])}}">
                    <img src="{{ url($name->avatar_filename)}}" alt="avatar" />
                    </a>
                    <p>{{ $name->name }}</p>
                </div>
                
                <?php $records3 = \DB::table('activities')->where('user_id', $user->user_id)->where('group_id', $group->id)->get() ?>
                
                <?php $tassei=0 ?>
                @foreach($records3 as $record)
                <?php
                    $tassei=$tassei + $record->record;
                ?>
                @endforeach
                
                <br>
            @endforeach
        </div>
    <!--参加ユーザーにのみ見せる-->
    @if(Auth::User()->is_joining($group->id))
        <div class="shinnseiB">
            <a href="{{ route('join.index', $group->id) }}">申請一覧</a>
        </div>
    @endif
    

</div>


@endsection


