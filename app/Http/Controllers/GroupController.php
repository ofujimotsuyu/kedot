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
        return view('groups.create');
    }
    
    
    //グループ作成ページで入力した情報をテーブルに保存する
    
    public function store(Request $request){
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

        return redirect('groups');
    }

    
}
