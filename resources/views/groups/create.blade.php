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
    <!--767px以下でform-inlineが効かなくなるのを直す！-->
        <tr>
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'><p>ゴール</p></th>
          <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::text('goal', old('goal'), ['class' => 'form-control full-form', 'rows' => '1','placeholder' => '例）パーフェクトボディを手に入れる']) !!}</td>
        </tr>
  
        <tr>
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'><p>具体的にやること</p></th>
          <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::text('to_do', old('to_do'), ['class' => 'form-control half-form', 'rows' => '1','placeholder' => '例）腹筋']) !!}</td>
        </tr>

        <tr>
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'><p>期間</p></th>
          <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::text('term', old('term'), ['class' => 'form-control quarter-form', 'rows' => '1','placeholder' => '例）20']) !!}日間（半角数字）</td>
        </tr>

        <tr>
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4 each'><p>目標数値・単位</p></th>
          <td  class='col-lg-10 col-md-8 col-sm-8 col-xs-8 form-inline'>{!! Form::text('amount', old('amount'), ['class' => 'form-control quarter-form', 'rows' => '1','placeholder' => '例）500']) !!}{!! Form::text('unit', old('unit'), ['class' => 'form-control small-form', 'rows' => '1','placeholder' => '回']) !!}（半角数字）</td>
        </tr>
        
        <tr>
          <th class='col-lg-2 col-md-4 col-sm-4 col-xs-4'><p>イメージ画像</p></th>
          <td class='col-lg-10 col-md-8 col-sm-8 col-xs-8'>{!! Form::file('group_filename', old('group_filename')) !!}</td>
        </tr>
        
  </table>
  {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
  {!! Form::close() !!}
</div>

@endsection
