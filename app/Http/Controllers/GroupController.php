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
            'term' => 'required|integer|min:1',
            'amount' => 'required|integer|min:1',
            'unit' => 'required|max:191',
        ]);
        //画像のファイル名をいい感じにする
        $daietto = 'images/daietto.jpg';
        $training = 'images/training.jpg';
        $study = 'images/study.jpg';
        $life = 'images/life.jpg';
        $health = 'images/health.jpg';
        $hobby = 'images/hobby.jpg';
        $sonota = 'images/yunokis.jpg';
        
        $group = new Group;
        $group->goal = $request->goal;
        $group->to_do = $request->to_do;
        $group->term = $request->term;
        $group->amount = $request->amount;
        $group->unit = $request->unit;
        $group->category = $request->category;
        $group->user_id = $user->id;
        
        switch($group->category){
            case 'ダイエット':
                $group->group_filename = $daietto;
                break;
            
            case 'トレーニング':
                $group->group_filename = $training;
                break;
                
            case '学習':
                $group->group_filename = $study;
                break;
                
            case '生活':
                $group->group_filename = $life;
                break;
                
            case '健康・美容':
                $group->group_filename = $health;
                break;
                
            case '趣味':
                $group->group_filename = $hobby;
                break;
                
            case 'その他':
                $group->group_filename = $sonota;
                break;
                
            default:
                $group->group_filename = $sonota;
                break;
        }
        
        $group->save();
        $user->sankagroups()->attach($group->id);

        \DB::table('user_group')->where('group_id', $group->id)->where('user_id', $user->id)->update(['status'=>'2']);
        
       //更新してcreateが増えないようにする
    //   return redirect('/');
       return view('groups.show', ['group' => $group]);
    }

    public function show($id){
        $group = Group::find($id);
        $status = DB::table('user_group')->where('user_id', \Auth::user()->id)->where('group_id', $group->id)->value('status');
        
        return view('groups.show', [
            'group' => $group,
            'status' => $status,
           
        ]);
        
    }
    
    //formに入力して、それをテーブルに保存
    public function store_activity(Request $request, $id){
        if(\Auth::User()->is_joining($id)){
            $this->validate($request, [
                'score' => 'required|integer|min:1',
            ]);

            $group = Group::find($id);
            $activity = new Activity;
            $activity->user_id = \Auth::user()->id;
            $activity->group_id = $group->id;
            $activity->record = $request->score;
            $activity->save();
            return redirect()->back();
        }else{
            return redirect('/');
        }
    }
        
    public function search(Request $request){
        $goal = $request->search;
        $category = $request->category;
        $groupid = $request->groupid;         
        
        $query = Group::query();

        // フリーワード検索の時の作業
        if(!empty($goal)){
            $query->where('goal','like','%'.$goal.'%')->orWhere('to_do','like','%'.$goal.'%');
        }
        
        // カテゴリー検索のときの作業        
        if(!empty($category)){
            $query->where('category','like','%'.$category.'%');
        }
        
        if(!empty($groupid)){
            $query->where('id',$groupid);
        }

        $groups = $query->orderBy('created_at','DESC')->paginate(18);

        return view('groups.search')->with('groups',$groups)->with('goal',$goal)->with('category',$category)->with('groupid',$groupid);
    }
    
    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'goal' => 'required|max:191',
            'to_do' => 'required|max:191',
            'category' => 'required|max:191',
            'term' => 'required|integer|min:1',
            'amount' => 'required|integer|min:1',
            'unit' => 'required|max:191',
        ]);

        
        //画像のファイル名をいい感じにする
        $daietto = 'images/daietto.jpg';
        $training = 'images/training.jpg';
        $study = 'images/study.jpg';
        $life = 'images/life.jpg';
        $health = 'images/health.jpg';
        $hobby = 'images/hobby.jpg';
        $sonota = 'images/yunokis.jpg';
        
        $group = Group::find($id);
        $group->goal = $request->goal;
        $group->category = $request->category;
        $group->to_do = $request->to_do;
        $group->term = $request->term;
        $group->amount = $request->amount;
        $group->unit = $request->unit;
        
         switch($group->category){
            case 'ダイエット':
                $group->group_filename = $daietto;
                break;
            
            case 'トレーニング':
                $group->group_filename = $training;
                break;
                
            case '学習':
                $group->group_filename = $study;
                break;
                
            case '生活':
                $group->group_filename = $life;
                break;
                
            case '健康・美容':
                $group->group_filename = $health;
                break;
                
            case '趣味':
                $group->group_filename = $hobby;
                break;
                
            case 'その他':
                $group->group_filename = $sonota;
                break;
                
            default:
                $group->group_filename = $sonota;
                break;
        }

        $group->save();
        return view('groups.show', ['group'=>$group]);
    }
    
    public function edit($id) {
        if(\Auth::User()->is_joining($id)){
            $group = Group::find($id);
            return view('groups.edit', ['group'=>$group]);
        }else{
            return redirect('/');
        }
    }
    
    public function destroy($id)
    {
        if(\Auth::User()->is_joining($id)){
            $group = Group::find($id);
            $group->delete();
        return redirect('/');
        }else{
            return redirect('/');
        }
    }
    
    public function delete_confirm($id){
        if(\Auth::User()->is_joining($id)){
            $group = Group::find($id);
            return view('groups.delete_confirm',['group'=>$group]);
        }else{
            return redirect('/');
        }
    }
    
    
//   mypageに所属しているグループだけ一覧で表示する
  public function mygroups(){
       
          
         $groups = \Auth::User()->sankagroups()->paginate(18);
        
        return view ('groups.mygroups', [ 'groups'=>$groups ]);
    }
    
   
  
    }

