<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;
use App\Activity;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        // User.phpのsankagroups function()を使ってその人の参加してるグループの情報を持ってくる
        $sankagroups = $user->sankagroups()->get();
      
      
      //show.blade.phpの$userと$groupsに、$userと$sankagroupsをそれぞれ送る
          $data = [
            'user' => $user,
            'groups' => $sankagroups,
        ];

        return view('users.show', $data );
    }

}
