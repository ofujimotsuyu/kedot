@if (Auth::User()->id != $user_id)
    <?php $homering = \DB::table('homerus')->where('user_id', Auth::User()->id)->where('homerare_id',$user_id)->get(); ?>
    @if (count($homering)>0)
        <?php $homekotoba = \DB::table('homerus')->where('user_id', Auth::User()->id)->where('homerare_id', $user_id)->value('iine'); 
              $name = \DB::table('users')->where('id', $user_id)->value('name')?>
        <p class="pc">{{ $name.'さんに'.'「'.$homekotoba.'」と褒めました。' }}</p>
        <p class="sp">{{ $name.'さんを褒めました。'}}</p>
        {!! Form::open(['route' => ['user.unhomeru', $user_id], 'method' => 'delete']) !!}
            {!! Form::submit('取り下げ', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.homeru', $user_id]]) !!}
            {!! Form::text('iine', null, ['class' => 'form-control full-form', 'rows' => '1','placeholder' => '例）すごーい！']) !!}
            {!! Form::submit('褒めちゃう', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif