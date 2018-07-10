@extends('layouts.app')


@section('content')

    <form method="get" action="./search" >
        <input type="text" name="goal">
        <input type="text" name="to_do">
        <input type="submit" value="search">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>
    
    @foreach($groups as $group)
        {{$group->goal}}<br>
        {{$group->to_do}}<br>
    @endforeach
    
    {!! $groups->appends(['goal'=>$goal,'to_do'=>$to_do])->render() !!}

@endsection