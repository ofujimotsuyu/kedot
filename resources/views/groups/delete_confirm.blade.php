@extends('layouts.app')

@section('content')

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

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10 confirm">
            <div class="alert alert-danger" role="alert">下記データを削除します。よろしいですか？！</div>
            <table class="table table-bordered">
            {!! Form::open(['route' => ['group.delete', $group->id], 'method' => 'delete']) !!}
              <!--第三引数の中に'placeholder' => '○○○○'　を入れることでバックグラウンドにdescription-->
              <!--classにform-inlineをいれることで、２つのフォームを横並びにしている-->
                  <tr class="confirm">
                    <th class="col-lg-3 col-md-3 col-sm-4 col-xs-4">ゴール</th>
                    <td class=''><p>{{ $group->goal }}</p></td>
                  </tr>
          
                  <tr class="confirm">
                    <th class=''>カテゴリー</th>
                    <td class=''><p>{{ $group->category }}</p></td>
                  </tr>
            
                  <tr class="confirm">
                    <th class=''>やること</th>
                    <td class=''><p>{{ $group->to_do }}</p></td>
                  </tr>
          
                  <tr class="confirm">
                    <th class=''>期間</th>
                    <td class=''><p>{{ $group->term }}日間（残り{{ceil( $nokori )}}日間）</p></td>
                  </tr>
          
                  <tr class="confirm">
                    <th class=''>目標数値・単位</th>
                    <td class=''><p>{{ $group->amount." ".$group->unit }}</p></td>
                  </tr>
                  
            </table>
            <div class="center-block confirm-btn" align="center">
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{ route('groups.show', ['id'=>$group->id]) }}"><p class="btn btn-default">キャンセル</p></a>
            </div>
        </div>
    </div>
</div>


</div>
@endsection


