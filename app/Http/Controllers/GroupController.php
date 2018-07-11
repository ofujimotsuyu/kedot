<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\User;
use App\Group;
use App\Activity;




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
            'category' => 'required|max:191',
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
        $group->category = $request->category;
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
    
    //formに入力して、それをテーブルに保存
    public function store_activity(Request $request, $id){
        $group = Group::find($id);
        $activity = new Activity;
        
        
        $activity->user_id = \Auth::user()->id;
        $activity->group_id = $group->id;
        $activity->record = $request->score;
        $activity->save();
        
        return redirect()->back();
    }
        
    public function search(Request $request){
        $goal = $request->search;
        
        $query = Group::query();

        if(!empty($goal)){
            $query->where('goal','like','%'.$goal.'%')->orWhere('to_do','like','%'.$goal.'%');
        }
        
        $groups = $query->paginate(10);
        
        return view('groups.search')->with('groups',$groups)->with('goal',$goal);
    }
    
    public function update(Request $request, $id) {
        $group = Group::find($id);
        $group->goal = $request->goal;
        $group->to_do = $request->to_do;
        $group->term = $request->term;
        $group->amount = $request->amount;
        $group->unit = $request->unit;
        $group->save();
        return redirect('/');
    }
    
    public function edit($id) {
        $group = Group::find($id);
        
        return view('groups.edit', ['group'=>$group]);
    }
}
