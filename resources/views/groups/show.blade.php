@extends('layouts.app')

@section('content')
    <div class="ramunoue">
        <div class="ramu">
            @include('commons.error_messages')
            <div class="ramuimg col-sm-4 col-sm-offset-1">    
                <img src="{{url($group->group_filename)}}" alt="avatar"/><br>
            </div>
            <div class="ramumoji col-sm-7">
                <div class="favoB">
                    <h2 class = "ozawa col-xs-11">{{ $group->goal }}</h2>
                    <h3>@include('buttons.favorite_button', ['group' => $group])</h3>
                </div>
        <table class="groupdetail table">
            <tr class="">
                <th class="">グループID</th>
                <td class="">{{ $group->id }}</td>
            </tr>
            <tr class="">
                <th class="">カテゴリー</th>
                <td class="">{{ $group->category }}</td>
            </tr>
            <tr class="">
                <th class="">頑張ること</th>
                <td class="">{{ $group->to_do }}</td>
            </tr>
            <tr class="">
                <th class="">合計{{ $group->term }}日間で</th>
                <td class="">{{$group->amount.$group->unit }}</td>
            </tr>
            <tr class="">
                <th class=""></th>
                <td class=""></td>
            </tr>
        </table>
                <!--参加ユーザーにのみ見せる-->
                @if(Auth::User()->is_joining($group->id))
                @elseif(Auth::check())
                    <div class="minamidayo">
                        @include('buttons.join_button', ['group' => $group])
                    </div>
                @endif

                @if(Auth::User()->is_joining($group->id))
                <!--今日の達成度を入力してる場合-->
                    <?php
                    $today = date('Y-m-d');
                    $maxid = \DB::table('activities')->where('group_id', $group->id)->where('user_id', Auth::User()->id)->max('id');
                    $activity = \DB::table('activities')->where('group_id', $group->id)->where('user_id', Auth::User()->id)->where('id', $maxid)->get();
                    $kaitayo = \DB::table('activities')->where('group_id', $group->id)->where('user_id', Auth::User()->id)->where('id', $maxid)->value('created_at');
                    $kaitadate= date('Y-m-d', strtotime($kaitayo));
                    $kaitarecord = \DB::table('activities')->where('group_id', $group->id)->where('user_id', Auth::User()->id)->where('id', $maxid)->value('record');
                    ?>
                    @if($today==$kaitadate)
                    <div class="tasseihenkou">
                        <div class="henkouhidari">
                            <h4>YOUの今日やった数</h4>
                            <h2>{{ $kaitarecord }}</h2>
                        </div>
                        <div class="henkoumannaka">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </div>
                        <div class="henkoumigi form-inline">
                            <h4>YOUの今日のトータル</h4>
                        {!! Form::open(['route' => ['update_activity', $maxid], 'method' => 'put']) !!}
                                {!! Form::number('record', null, ['class' => 'form-control tasseikaeru first-form', 'placeholder'=>'半角数字', 'min'=>'0']) !!}
                            {!! Form::submit('変更', ['class' => 'btn btn-success btn-block henkoubtn']) !!}
                        {!! Form::close() !!}
                        </div>
                    </div>
    
                    <!--今日の達成度を入力していない場合-->
                    @elseif(Auth::User()->is_joining($group->id))
                    <div class = "tasseiform">
                        <!--formつくってるよ-->
                        {!! Form::open(['route' => ['groups.store_activity', $group->id], 'files' => true]) !!}
                            <div class="form-group form-inline tasseiwrapper">
                                <h4 class="aori">今日はどれぐらいやったの？</h4>
                                {!! Form::number('score', null, ['class' => 'form-control tasseinum', 'rows' => '1','placeholder'=>'半角数字のみ', 'min'=>'0']) !!}
                                {!! Form::submit('入力', ['class' => 'btn btn-success btn-block btn-md']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    <div class='yours' align="center">
                        <div class="yourstatus">
                            <h4>
                                現在のあなたの状況
                            </h4>
                        </div>
                        <div class="yourtotal">
                            <h4>
                                <?php
                                $joinuser = Auth::User();
                                $joinid = $joinuser->id;
                                $joinname = $joinuser->name; 
                                
                                $tassei=0;
                                $records3 = \DB::table('activities')->where('user_id', $joinid)->where('group_id', $group->id)->get();
                                foreach($records3 as $record) {
                                    $tassei = $tassei + $record->record;
                                }
                                
                                $data[0] = array("目標値", $group->amount);
                                $data[1] = array($joinname, $tassei);
                                
                                $maxlen = 0;
                                $max = 0;
                                if(!empty($joinuser)){
                                    for($i = 0 ; $i < count($data) ; $i++){
                                        if(strlen($data[$i][0]) > $maxlen){        
                                            $maxlen = strlen($data[$i][0]);
                                        }
                                        if($data[$i][1] > $max) {           
                                            $max = $data[$i][1];
                                        }
                                    }
                                    printf($data[1][1]);
                                }  
                                ?>
                            </h4>
                        </div>
                        <div class="yoursamount">
                            <h4>{{'/'. $group->amount }}</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!--参加ユーザーにのみ見せるdiv-->
    @if(Auth::User()->is_joining($group->id))
        <?php $admitwaitings = \DB::table('user_group')->where('group_id', $group->id)->where('status', '1')->get(); ?>
        @if(count($admitwaitings)>0)
        <div>
            <a href="{{ route('join.index', $group->id) }}"><p class="alert alert-danger" role="alert" style="text-align: center; font-size: 18px;">申請一覧</p></a>
        </div>
        @endif
    @endif
    
<div class = "show">
      
      <!--特定のuser_idとgroup_idを持つrecordの有無で、フォームを表示するかしないか分ける-->
      
      <!--中間テーブルからグループに参加してるメンバーを取り出している-->
            
            <?php $users = \DB::table('user_group')->where('group_id', $group->id)->where('status', '2')->get(); ?>  
    
          
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
            $nokori2 = floor($nokori);
            ?>

            <?php
                $maxlen = 0;
                $max = 0;
                $data[0] = array("目標値", $group->amount);
                $goalnumber = \DB::table('groups')->where('id', $group->id)->value('amount');
                $tassei2=0;
                $records = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get();
                foreach($records as $record) {
                    $tassei2 = $tassei2 + $record->record;
                }
            ?>
            @if (($nokori2)<=-1)
                <div class="timeuptop">
                <h3 class="timeup">終了！お疲れさまでした！</h3>
                </div>
            
            @elseif($day==0)
                <?php $nokori3 = $nokori2 - 1; ?>
                <div class="nokoritoptop">
                    <h1 class="nokoritop">残り</h1>
                    <h1 class="nokori2">{{  $nokori3 . '日' }}</h1>
                </div>
            @else
                <div class="nokoritoptop">
                    <h1 class="nokoritop">残り</h1>
                    <h1 class="nokori2">{{  $nokori2 . '日' }}</h1>
                </div>
            @endif
            
            @if($tassei2 > $goalnumber)
            <?php 
            var_dump($tassei2);
            exit; ?>
            <div class='ome'>
                <h1 class='omecommnet'>目標達成！おめでとう</h1>
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
                                if($data[$i][1] > $group->amount){
                                    $max = $group->amount;
                                }else{
                                    $max = $data[$i][1];
                                }
                            }
                        }
                        
                        for($i = 0 ; $i < count($data) ; $i++) {    
                                print("<tr>");
                                printf("<td class = \"bab\"  align=\"left\">%s</td>", $data[$i][0]);
                            if($data[$i][1] > $max){
                                printf("<td><hr color=\"white\" align=\"left\" width=\"%d%%\"></td>", 100);
                            }else{
                                printf("<td><hr color=\"white\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
                            }
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

                <div class = "sankashiteru col-xs-4" align="center">
                    <div class="eachsanka">
                        <a href="{{ route('users.show',['id'=>$name->id])}}"><img src="{{ url($name->avatar_filename)}}" alt="avatar" /><p>{{ $name->name }}</p></a>
                    </div>
                    <div align='center' class='homeyou'>
                    @include('buttons.homeru_button',['user_id'=>$id])
                    </div>
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
            
    <!--残り日数が終わったら-->
    
    <?php
    $members =\DB::table('user_group')->where('group_id', $group->id)->where('status', 2)->get();
    $numofmembers = count($members);
    ?>
    
    @if(Auth::User()->is_joining($group->id))
        @if(floor($nokori)<=-1)
            div class="downest">
              <div align="center" class="btnwrapper col-xs-12">
                  <div class="groupbtn">
                      <a class="sakujobtn" href="{{ route('delete_confirm', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">削除</p></a>
                  </div>
              </div>
            </div>
        @elseif($numofmembers<=1)
            <div class="downest">
                <div align="center" class="btnwrapper">
                    <div class="groupbtn col-xs-6">
                        <a href="{{ route('group.edit', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">編集</p></a>
                    </div>
                    <div class="groupbtn col-xs-6">
                      <a class = "sakujobtn" href="{{ route('delete_confirm', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">削除</p></a>
                    </div>
                </div>
            </div>
        @else
          <div class="downest">
              <div align="center" class="btnwrapper">
                  <div class="groupbtn col-xs-4">
                      <a href="{{ route('group.edit', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">編集</p></a>
                    </div>
                    <div class="groupbtn col-xs-4">
                      <a class = "sakujobtn" href="{{ route('delete_confirm', $group->id) }}"><p class="btn" style="border:solid 1px white; width:100%">削除</p></a>
                  </div>
                  <div class="minamidesu col-xs-4">
                      @include('buttons.join_button', ['group' => $group])
                  </div>
              </div>
          </div>
         @endif
    @endif
    
</div>


@endsection


