@extends('layouts.app')

@section('content')

  {!! Form::open(['route' => ['groups.store', $user->id], 'files' => true]) !!}
      <div class="form-group">
          {!! Form::label('goal', 'ゴール', ['class' => 'control-label']) !!}
          {!! Form::textarea('goal', old('goal'), ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::label('to_do', '具体的にやること', ['class' => 'control-label']) !!}
          {!! Form::textarea('to_do', old('to_do'), ['class' => 'form-control half-form', 'rows' => '1']) !!}

          {!! Form::label('term', '期間', ['class' => 'control-label']) !!}
          {!! Form::textarea('term', old('term'), ['class' => 'form-control half-form', 'rows' => '1']) !!}
          <span class="input-group-addon half-form">日間</span>

          {!! Form::label('amount', '目標数値', ['class' => 'control-label']) !!}
          {!! Form::textarea('amount', old('amount'), ['class' => 'form-control half-form', 'rows' => '1']) !!}

          {!! Form::label('unit', '単位', ['class' => 'control-label']) !!}
          {!! Form::textarea('unit', old('unit'), ['class' => 'form-control half-form', 'rows' => '1']) !!}

          {!! Form::label('group_filename', 'グループ画像', ['class' => 'control-label']) !!}
          {!! Form::file('group_filename', old('group_filename')) !!}

          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
      </div>
  {!! Form::close() !!}

@endsection