@extends('layouts.app')

@section('content')
<body>
    <a href="{{ route('groups.create', ['id' => $id]) }}">kojinn</a>
    <a href="{{ route('groups.createdantai', ['id' => $id]) }}">dantai</a>
</body>

@endsection