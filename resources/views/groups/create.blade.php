@extends('layouts.app')

@section('content')

<div class="createpage">
  <h1>グループを作成しよう！</h1>
</div>

<div class="form-group">
  <table class="table table-bordered">
    {!! Form::open(['route' => ['groups.store', $user->id], 'files' => true]) !!}
    <!--第三引数の中に'placeholder' => '○○○○'　を入れることでバックグラウンドにdescription-->
    <!--classにform-inlineをいれることで、２つのフォームを横並びにしている-->
        <tr class="create">
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-2'>ゴール</th>
          <td class='col-lg-10 col-md-8 col-sm-8 col-xs-9'>{!! Form::text('goal', old('goal'), ['class' => 'form-control full-form', 'rows' => '1','placeholder' => '例）パーフェクトボディを手に入れる']) !!}</td>
        </tr>

        <tr class="create">
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>カテゴリー</th>
          <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::select('category', [''=>'選択してください','ダイエット'=>'ダイエット','トレーニング'=>'トレーニング','学習'=>'学習','生活'=>'生活','健康・美容'=>'健康・美容','趣味'=>'趣味','その他'=>'その他'],'選択してください', ['class' => 'form-control half-form', 'rows' => '1']) !!}</td>
        </tr>
  
        <tr class="create">
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>やること</th>
          <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::text('to_do', old('to_do'), ['class' => 'form-control half-form', 'rows' => '1','placeholder' => '例）腹筋']) !!}</td>
        </tr>

        <tr class="create">
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'>期間</th>
          <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::text('term', old('term'), ['class' => 'form-control quarter-form first-form', 'rows' => '1','placeholder' => '例）20']) !!}<p>日間（半角数字）</p></td>
        </tr>

        <tr class="create">
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4 each'>目標数値・単位</th>
          <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::text('amount', old('amount'), ['class' => 'form-control quarter-form first-form', 'rows' => '1','placeholder' => '例）500']) !!}{!! Form::text('unit', old('unit'), ['class' => 'form-control small-form first-form', 'rows' => '1','placeholder' => '回']) !!}<p>（半角数字）</p></td>
        </tr>

        
  </table>
  {!! Form::submit('Post', ['class' => 'btn btn-success btn-block']) !!}
  {!! Form::close() !!}
</div>

@endsection
