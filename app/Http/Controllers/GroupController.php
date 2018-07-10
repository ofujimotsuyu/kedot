<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;

class GroupController extends Controller
{
    public function index(){
         return view('groups.groups');
    }

    public function create(){
        $user = \Auth::user();
        
        return view('groups.create', [
            'user' => $user,
            ]);
    }
    
    
    //グループ作成ページで入力した情報をテーブルに保存する
    
    public function store(Request $request){
        $user = \Auth::user();
        $id = $user->id;
        $this->validate($request, [
            'goal' => 'required|max:191',
            'to_do' => 'required|max:191',
            'term' => 'required|integer',
            'amount' => 'required|integer',
            'unit' => 'required|max:191',
            'group_filename' => 'required',
        ]);
        //画像のファイル名をいい感じにする
        $filename = $request->group_filename->store('public/group');
        
        $group = new Group;
        $group->goal = $request->goal;
        $group->to_do = $request->to_do;
        $group->term = $request->term;
        $group->amount = $request->amount;
        $group->unit = $request->unit;
        $group->group_filename = basename($filename);
        $group->save();

        return view('groups.groups' , [
            'id' => $id,
        ]);
    }

    public function show($id){
        $group = Group::find($id);
        
        return view('groups.show', [
            'group' => $group,
        ]);
    }
    
    public function search(Request $request){
        $goal = $request->goal;
        $to_do = $request->to_do;
        
        $query = Group::query();
        
        if(!empty($goal)){
            $query->where('goal','like','%'.$goal.'%');
        }
        
        if(!empty($to_do)){
            $query->where('to_do','like','%'.$to_do.'%');
        }
        
        $groups = $query->paginate(10);
        
        return view('groups.search')->with('groups',$groups)->with('goal',$goal)->with('to_do',$to_do);
    }
    
}
