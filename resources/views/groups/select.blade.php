@extends('layouts.app')

@section('content')

<a href="{{ route('groups.create', ['id' => $id]) }}">kojinn</a>

<a href="{{ route('groups.createdantai', ['id' => $id]) }}">dantai</a>


@endsection