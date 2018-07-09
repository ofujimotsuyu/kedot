@extends("layouts.app")

@section("content")
    <p><img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar" /></p>
    
    <h1>{{ $user->name }}</h1>
    
    <div>
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">参加グループ</a></li>
            <li><a href="#">お気に入り</a></li>
            <li><a href="#">達成リスト</a></li>
        </ul>
    </div>
    
    @foreach($groups as $group)
        {{ $group->goal }}
        {{ $group->term }}<br>
    @endforeach　
    
@endsection