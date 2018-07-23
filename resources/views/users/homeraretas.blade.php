@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        @foreach($homeraretas as $homerareta)
            <?php $hometa_id = $homerareta->user_id; 
                  $name = App\User::find($hometa_id)->name;?>
            {{ $name }}
        @endforeach
    </div>
</div>

@endsection