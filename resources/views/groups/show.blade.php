@extends('layouts.app')

@section('content')
<div class = "show">
    <img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/><br>
    <h2>{{ "目標 : " . $group->goal }}<br></h2>
    <h3>
        {{ "頑張ること : " . $group->to_do }}<br>
        {{ $group->term . "日間で" . $group->amount . $group->unit }}
    </h3>
    
    
    <!--formつくってるよ-->
  {!! Form::open(['route' => ['groups.store_activity', $group->id], 'files' => true]) !!}
      <div class="form-group">
         
          {!! Form::label('score', '数値', ['class' => 'control-label']) !!}
          {!! Form::text('score', ['class' => 'form-control', 'rows' => '1']) !!}

          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
      </div>
  {!! Form::close() !!}
   
   
    @include('buttons.join_button', ['group' => $group])





</div>
@endsection


