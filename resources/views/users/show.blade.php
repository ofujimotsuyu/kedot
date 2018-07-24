@extends("layouts.app")
<!--グループ名マウスオーバーで色変わる-->
<head>
    <style>
        h2 a{
        display: inline-block;
        padding: 0.1em 0.3em;
        transition: all .3s;
        color : black;
        text-decoration: none;
        }
        h2 a:hover {
        color: #fff;
        background-color: #00BCD4;
        text-decoration: none;
        }
        .nav a{
            font-size: 20px; 
        }
    </style>
</head>

@section("content")
<div class="" style="margin-top:100px">
    <div class="">
        <div class="">
            <!--きりんとかのプロフィール画像を画面の中央に表示-->
            <div class="doji" align="center">
            <p style="text-align:center"><img src="{{url($user->avatar_filename)}}" alt="avatar" /></p>
            <div class="user_name"> 
                <h1>{{ $user->name }}</h1>
                <div class="userhomeru" align="center">
                @include('buttons.homeru_button',['user_id'=>$user->id])
                </div>
            </div>
            
            <div class = "baka">
                <ul class="aho nav nav-pills nav-justified">
                    <li class = "col-xs-4 ccc {{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show' , ['id' => $user->id]) }}"><span class="glyphicon glyphicon-user" style="font-size:20px"></span> 参加グループ</a></li>
                    <li class = "col-xs-4 aaa mypage tab"><a href="{{ route('user.favoritings' , ['id' => $user->id]) }}"><span class="glyphicon glyphicon-star" style="font-size:20px"></span> お気に入り</a></li>
                    <li class = "col-xs-4 bbb mypage tab"><a href="{{ route('user.tassei', ['id'=> $user->id]) }}"><span class="glyphicon glyphicon-ok" style="font-size:20px"></span> 達成リスト</a></li>
                </ul>
            </div>
            
            <!--参加しているグループをforeachで呼び出す-->
            <div class= "popopopo">
                @foreach($groups as $group)
                    <div class='pon'>
                        <div class ='vo'>
                        <a href="{{ route('groups.show', [ 'id' => $group->id ]) }}" style="text-decoration:none;" class="square_btn">
                        <div class='du'>
                            <span class='xxx'><h2>{{ ">>" . $group->goal }}</h2></span></a><br>
                            <h4>{{ "頑張ること : " . $group->to_do }}
                            {{ $group->term . "日間で" . $group->amount . $group->unit }}</h4>
                            <br>
                        </div>
                        </div>
                        <!--activitiesテーブルにアクセス、'user_id'の値に'\Auth::user()'のidを持つ行をすべて取り出す、さらに'group_id'の値に'$group'のidを持つ行を特定する-->
                        <!--<?php $records = \DB::table('activities')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get() ?>        -->
                           
                        <!--各グループにおいて、一つ一つのrecordカラムのvalueを取り出して表示する-->
                        <!--    @foreach($records as $record)-->
                        <!--        {{ $record->record }}       -->
                        <!--    @endforeach-->
                        
                    　　<?php $users = \DB::table('user_group')->where('group_id', $group->id)->get() ?>  
                        
                        <table class='ton' width="100%" align="center" rules="none" cellspacing="0">
                        
                            <?php
                            
                            $id = $user->id;
                            $name = App\User::find($id); 
                            
                            $tassei=0;
                            $records3 = \DB::table('activities')->where('user_id', $user->id)->where('group_id', $group->id)->get();
                            foreach($records3 as $record) {
                                $tassei = $tassei + $record->record;
                            }
                            
                            $data[0] = array("目標値", $group->amount);
                            $data[1] = array($name->name, $tassei);
                            
                            $maxlen = 0;
                            $max = 0;
                            if(!empty($name)){
                                for($i = 0 ; $i < count($data) ; $i++){
                                    if(strlen($data[$i][0]) > $maxlen){        
                                        $maxlen = strlen($data[$i][0]);
                                    }
                                    if($data[$i][1] > $max) {           
                                        $max = $data[$i][1];
                                    }
                                }
                                print("<tr>");
                                printf("<td  width=\"%d\" color=\"white\" align=\"left\">%s</td>", $maxlen * 10, $data[0][0]);
                                printf("<td><hr size=\"10\" color=\"white\" align=\"left\" width=\"%d%%\"></td>", $data[0][1] / $max * 100);
                                printf("<td width=\"%d\">%d</td>", strlen($max) * 10, $data[0][1]);
                                print("</tr>\n");
                                
                                print("<tr>");
                                printf("<td width=\"%d\" align=\"left\">%s</td>", $maxlen * 10, $data[1][0]);
                                printf("<td><hr size=\"10\" color=\"white\" align=\"left\" width=\"%d%%\"></td>", $data[1][1] / $max * 100);
                                printf("<td width=\"%d\">%d</td>", strlen($max) * 10, $data[1][1]);
                                print("</tr>\n");
                            }  
                                    
                            ?>
                    
                        </table>
                        
                    </div>
                @endforeach
                
            </div>
                
            
            <div align="center">
                <br>{!! $groups->render() !!}
            </div>    
            </div>
        </div>
    </div>
</div>
@endsection