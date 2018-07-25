@extends("layouts.app")

@section("content")
<div class="container" align="center">
    <div class="row homehome">
        <h2>{{ \Auth::User()->name }}へのお褒めの言葉</h2>
        <table class="table table-bordered myiine">
                @if(count($homerudatas)>0)
                    @foreach($homerudatas as $homerudata)
                        <?php 
                            $hometaid = $homerudata->hometa_id;
                            $homekotoba = \DB::table('homerus')->where('homerare_id', \Auth::User()->id)->where('user_id', $hometaid)->value('iine'); 
                            $homerudata = \DB::table('homerunotifications')->where('id', $homerudata->id)->update(['read'=>'1']);
                            $name = App\User::find($hometaid)->name; 
                            $photo = DB::table('users')->where('id', $hometaid)->value('avatar_filename')
                        ?>
                        <tr class="each_iine">
                            <th class="iiname"><img src="{{ url($photo)}}" alt="avatar" /><a href="{{ route('users.show', ['id' => $hometaid] ) }}"><p class='btn button-primary'>{{$name}}</p></a></th>
                            <td class="homeword"><p>{{ $homekotoba }}</p></td>
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>
</div>

@endsection
