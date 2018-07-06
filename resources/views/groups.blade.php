@extends('layouts.app')

@section('content')
@if(Auth::check())
    <h1>welcome to kedot</h1>
    
    <a href="{{ route('logout.get') }}">Logout</a>
    
@endif
@endsection