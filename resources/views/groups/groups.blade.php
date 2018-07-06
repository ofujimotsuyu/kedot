@extends('layouts.app')

@section('content')
<?php
$groups = App\Group::all();
?>
@foreach($groups as $group)
    <img src="{{ asset('storage/group/' . $group->group_filename) }}" alt="avatar"/>
@endforeach    
@endsection