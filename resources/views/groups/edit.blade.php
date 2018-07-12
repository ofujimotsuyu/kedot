@extends('layouts.app')

@section('content')

  {!! Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'put']) !!}
      <div class="form-group">
          {!! Form::label('goal', 'ゴール') !!}
          {!! Form::textarea('goal', old('goal'), ['class' => 'form-control', 'rows' => '1']) !!}
          
          {!! Form::label('category','カテゴリー') !!}
          <br>
          {!! Form::select('category', [''=>'選択してください','ダイエット'=>'ダイエット','トレーニング'=>'トレーニング','学習'=>'学習','生活'=>'生活','健康・美容'=>'健康・美容','趣味'=>'趣味','その他'=>'その他'], ['class' => 'form-control quarter-form', 'rows' => '1']) !!}

          <br>
          
          {!! Form::label('to_do', '具体的にやること', ['class' => 'control-label']) !!}
          {!! Form::textarea('to_do', old('to_do'), ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::label('term', '期間', ['class' => 'control-label']) !!}
          {!! Form::textarea('term', old('term'), ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::label('amount', '目標数値', ['class' => 'control-label']) !!}
          {!! Form::textarea('amount', old('amount'), ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::label('unit', '単位', ['class' => 'control-label']) !!}
          {!! Form::textarea('unit', old('unit'), ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
      </div>
  {!! Form::close() !!}

@endsection