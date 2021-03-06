@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @include('commons.error_messages')
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
      
      <div class="createpage">
        <h1>グループ内容編集ペーージ</h1>
      </div>
      
      <div class="form-group nomform">
        <table class="table table-bordered">
        {!! Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'put']) !!}
          <!--第三引数の中に'placeholder' => '○○○○'　を入れることでバックグラウンドにdescription-->
          <!--classにform-inlineをいれることで、２つのフォームを横並びにしている-->
          <!--767px以下でform-inlineが効かなくなるのを直す！-->
              <tr class="create">
                <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>ゴール</th>
                <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::text('goal', old('goal'), ['class' => 'form-control full-form', 'rows' => '1','placeholder' => '例）パーフェクトボディを手に入れる']) !!}</td>
              </tr>
      
              <tr class="create">
                <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>カテゴリー</th>
                <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::select('category', [''=>'選択してください','ダイエット'=>'ダイエット','トレーニング'=>'トレーニング','学習'=>'学習','生活'=>'生活','健康・美容'=>'健康・美容','趣味'=>'趣味','その他'=>'その他'], $group->category, ['class' => 'form-control half-form', 'rows' => '1']) !!}</td>
              </tr>
        
              <tr class="create">
                <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>具体的にやること</th>
                <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::text('to_do', old('to_do'), ['class' => 'form-control half-form', 'rows' => '1','placeholder' => '例）腹筋']) !!}</td>
              </tr>
      
              <tr class="create">
                <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>期間・目標値・単位</th>
                <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::text('term', old('term'), ['class' => 'form-control quarter-form first-form', 'rows' => '1','placeholder' => '例）20']) !!}<p class="first-form megumi">日間で</p><p class="first-form megumi">合計</p>{!! Form::text('amount', old('amount'), ['class' => 'form-control quarter-form first-form', 'rows' => '1','placeholder' => '例）500']) !!}{!! Form::text('unit', old('unit'), ['class' => 'form-control small-form first-form', 'rows' => '1','placeholder' => '回']) !!}<p class="first-from hankaku">（半角数字）</p></td>
              </tr>
              
        </table>
        {!! Form::submit('完了', ['class' => 'btn btn-success btn-block']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection