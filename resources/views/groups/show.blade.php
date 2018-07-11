@extends('layouts.app')

@section('content')
<div class = "show">
    <img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/><br>
    <h2>{{ "目標 : " . $group->goal }}<br></h2>
    <h3>
        {{ "頑張ること : " . $group->to_do }}<br>
        {{ $group->term . "日間で" . $group->amount . $group->unit }}
    </h3>
  
      <!--参加しているユーザーのページにのみフォームを表示したい-->  
    
      <?php $records = \DB::table('user_group')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->get() ?>        
     
    @if(count($records) > 0)
    
    <!--formつくってるよ-->
      {!! Form::open(['route' => ['groups.store_activity', $group->id], 'files' => true]) !!}
          <div class="form-group">
              
              {!! Form::label('score', '数値', ['class' => 'control-label']) !!}
              {!! Form::textarea('score', null, ['class' => 'form-control', 'rows' => '1']) !!}
    
              {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
          </div>
      {!! Form::close() !!}
   
    @endif
  
        <?php $users = \DB::table('user_group')->where('group_id', $group->id)->get() ?>  

        <?php $members=0 ?>
    @foreach($users as $user)
        <?php 
        $members= $members+1;
        
        $id = $user->user_id;
        $name = App\User::find($id); ?>
        
        
        <p><img src="{{ url($name->avatar_filename)}}" alt="avatar" /></p>
        <h3>{{ $name->name }}</h3>
        
        <?php $records3 = \DB::table('activities')->where('user_id', $user->user_id)->where('group_id', $group->id)->get() ?>
        
        <?php $tassei=0 ?>
        @foreach($records3 as $record)
        <?php
            echo $record->record;
            $tassei=$tassei + $record->record;
        ?>
        @endforeach
        <?php echo $tassei; ?>
        
        <br>
    @endforeach
        <?php echo $members; ?>
    
    <table width="95%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
    <caption>達成度</caption>
    
    <?php
    $maxlen = 0;
    $max = 0;
        foreach ($users as $key => $user) {
            $id = $user->user_id;
            $name = App\User::find($id); 
            
        $records3 = \DB::table('activities')->where('user_id', $user->user_id)->where('group_id', $group->id)->get();
        
        $tassei=0;
        foreach($records3 as $record) {
            $tassei=$tassei + $record->record;
        }
        
        $data[$key] = array($name->name, $tassei);
        }
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
            printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 10, $data[$i][0]);
            printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
            printf("<td width=\"%d\">%d</td>", strlen($max) * 10, $data[$i][1]);
            print("</tr>\n");
        }
    ?>
    
    </table>

          
    @include('buttons.join_button', ['group' => $group])

    <a href="{{ route('group.edit', $group->id) }}">編集</a>
</div>

@endsection


