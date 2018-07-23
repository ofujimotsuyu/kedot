@extends("layouts.app")

@section("content")
<div class="container" align="center">
    <div class="row">
        <h2>{{ \Auth::User()->name }}へのお褒めの言葉</h2>
        <table class="table table-bordered myiine">
            @foreach($homeraretas as $homerareta)
                <?php $hometa_id = $homerareta->user_id; 
                      $name = App\User::find($hometa_id)->name; 
                      $photo = DB::table('users')->where('id', $hometa_id)->value('avatar_filename');?>
            <tr class="each_iine">
                <th class="minami"><a href="{{ route('users.show', ['id' => $hometa_id] ) }}"><img src="{{ url($photo)}}" alt="avatar" /><p class='btn button-primary'>{{$name}}</p></a></th>
                <td>{{ $homerareta->iine }}</td>
            </tr>
            @endforeach
        </table>
        
    </div>
</div>

@endsection
