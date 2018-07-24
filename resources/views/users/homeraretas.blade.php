@extends("layouts.app")

@section("content")
<div class="container" align="center">
    <div class="row homehome">
        <h2>{{ \Auth::User()->name }}へのお褒めの言葉</h2>
        <table class="table table-bordered myiine">
            @foreach($homeraretas as $homerareta)
                <?php $hometa_id = $homerareta->user_id; 
                      $name = App\User::find($hometa_id)->name; 
                      $photo = DB::table('users')->where('id', $hometa_id)->value('avatar_filename');?>
            <tr class="each_iine">
                <th class="iiname"><img src="{{ url($photo)}}" alt="avatar" /><a href="{{ route('users.show', ['id' => $hometa_id] ) }}"><p class='btn button-primary'>{{$name}}</p></a></th>
                <td class="homeword"><p>{{ $homerareta->iine }}</p></td>
            </tr>
            @endforeach
        </table>
        
    </div>
</div>

@endsection
