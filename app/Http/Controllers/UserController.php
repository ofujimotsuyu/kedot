<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        // User.phpのsankagroups function()を使ってその人の参加してるグループの情報を持ってくる
        $sankagroups = $user->sankagroups()->get();
         
          $data = [
            'user' => $user,
            'groups' => $sankagroups,
        ];

        // $data += $this->counts($user);

        return view('users.show', $data);
    }

}
