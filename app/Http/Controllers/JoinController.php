<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use App\User;
use App\Activity;

class JoinController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->joinrequest($id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->quit($id);
        return redirect()->back();
    }
    
    public function admit($id, $request_id)
    {   
        $group = Group::find($id);
        $admitwaiting = \DB::table('user_group')->where('id', $request_id)->update(['status'=>'2']);
        return redirect()->back();
    }

    public function index($id)
    {
        $group =Group::find($id);
        $admitwaitings = \DB::table('user_group')->where('group_id', $group->id)->where('status', '1')->get();

        $data = [
            'group' => $group,
            'admitwaitings' => $admitwaitings,
        ];
        
        return view('groups.requests', $data);
    }
    
    public function decline($id, $request_id)
    {
        $group = Group::find($id);
        $admitwaiting = \DB::table('user_group')->where('id', $request_id)->update(['status'=>'0']);
        return redirect()->back();
    }
    
    public function cancel($id)
    {
       $group = Group::find($id);
       \DB::table('user_group')->where('group_id', $group->id)->where('user_id', \Auth::user()->id)->update(['status'=>'0']);
       return redirect()->back();
    }
    
    public function request($id)
    {
       $group = Group::find($id);
       \DB::table('user_group')->where('group_id', $group->id)->where('user_id', \Auth::user()->id)->update(['status'=>'1']);
       return redirect()->back();
        
    }

    
}
