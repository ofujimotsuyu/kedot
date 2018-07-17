@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
            <div class="apbank">
                <h2 class="user_result">Search USER!</h2><br>
        
                <form class='form-inline'method="get" action="./users" >
                    <!--name=でcontrollerに送る名前を決定-->
                    <input class='form-control gigigi col-xs-8 col-md-8 col-lg-8 first-form' type="text" name="search" placeholder = "ユーザーを検索" >
                    <button  class='form-control input_button' type="submit">
                        <span class="glyphicon glyphicon-search bobobo"></span>
                    </button>       
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>
            </div>
            <h2>
            @if($user)「@endif
            {{$user}}
            @if($user)」の検索結果@endif
            </h2>
            <div class = "ichiran">
                @foreach($users as $user)
                <div class = "each_user">
                    <a href="{{ route('users.show', ['id' => $user->id]) }}"><img src="{{url($user->avatar_filename)}}" alt="avatar"/><p>{{ $user->name }}</p></a>
                </div>
                @endforeach
            </div>
            <div align="center">
                <br>{!! $users->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection