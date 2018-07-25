<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;
use App\Activity;
use App\Homeru;
use App\Homenotification;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        // User.phpのsankagroups function()を使ってその人の参加してるグループの情報を持ってくる
        $sankagroups = $user->sankagroups()->paginate(5);
        $admitdatas = \DB::table('admitnotifications')->where('user_id', $id)->where('read','0')->get();
        $homerudatas = \DB::table('homerunotifications')->where('user_id', $id)->where('read','0')->get();
      //show.blade.phpの$userと$groupsに、$userと$sankagroupsをそれぞれ送る
          $data = [
            'user' => $user,
            'groups' => $sankagroups,
            'admitdatas' => $admitdatas,
            'homerudatas' => $homerudatas,
        ];

        return view('users.show', $data );
    }

     public function favoritings($id)
    {
        $user = User::find($id);
        $favoritings = $user->favorites()->paginate(10);

        $data = [
            'user' => $user,
            'favorites' => $favoritings,
        ];


        return view('users.favorites', $data);
    }
    
    public function index(Request $request){
        $user = $request->search;
        
        $query = User::query();

        // フリーワード検索の時の作業
        if(!empty($user)){
            $query->where('name','like','%'.$user.'%');
        }
        
   
        $users = $query->paginate(18);

        return view('users.users')->with('users',$users)->with('user',$user);
    }

    public function requests($id){
        
        if(\Auth::User()->id==$id){
        $user = User::find($id);
        $requests = \DB::table('user_group')->where('user_id', $id)->orderby('created_at','DESC')->paginate(10);
        
        $data = [
            'user' => $user,
            'requests' => $requests,
        ];
        
        return view('users.requests', $data);}
        else{
            return redirect('/');
        }
    }

    public function tasseis($id)
    {
        $user = User::find($id);
        $sankagroups = $user->sankagroups()->get();
      
        $data = [
            'user' => $user,
            'groups' => $sankagroups,
        ];

        return view('users.tassei', $data);
    }
    
    public function homeraretas($id)
    {   
        if(\Auth::User()->id==$id){
            $homerudatas = \DB::table('homerunotifications')->where('user_id', $id)->where('read','0')->get();

            return view('users.homeraretas', ['homerudatas' => $homerudatas]);
        }
        else{
            return redirect('/');
        }
            
    }    

}
