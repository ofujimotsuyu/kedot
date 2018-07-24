<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Group;
use App\Activity;
use App\Homeru;

class UserHomeruController extends Controller
{
    public function homeru(Request $request, $id){
        $this->validate($request, [
        'iine' => 'required',
        ]);
        
        $homeru = new Homeru;
        $homeru->user_id = \Auth::User()->id;
        $homeru->homerare_id = $id;
        $homeru->iine = $request->iine;
        $homeru->save();
        return redirect()->back();
    }
    
    public function unhomeru($id){
        $homeru_id = \DB::table('homerus')->where('user_id', \Auth::User()->id)->where('homerare_id', $id)->value('id');
        $homeru = Homeru::find($homeru_id); 
        $homeru->delete();
        return redirect()->back();
    }

}
