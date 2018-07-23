@if (Auth::User()->id != $user_id)
    <?php $homering = \DB::table('homerus')->where('user_id', Auth::User()->id)->where('homerare_id',$user_id)->get(); ?>
    @if (count($homering)>0)
        <?php $homekotoba = \DB::table('homerus')->where('user_id', Auth::User()->id)->where('homerare_id', $user_id)->value('iine'); ?>
        <p>{{ $user->name.'さんに'.'「'.$homekotoba.'」と褒めました。' }}</p>
        {!! Form::open(['route' => ['user.unhomeru', $user_id], 'method' => 'delete']) !!}
            {!! Form::submit('Unhomeru', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.homeru', $user_id]]) !!}
            {!! Form::text('iine', null, ['class' => 'form-control full-form', 'rows' => '1','placeholder' => '褒めてあげて！']) !!}
            {!! Form::submit('Homeru', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif