<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Group;
use App\Activity;
use App\Homeru;
use App\Homerunotification;

class UserHomeruController extends Controller
{
    public function homeru(Request $request, $id){
        $this->validate($request, [
        'iine' => 'required|max:15',
        ]);
        
        $homeru = new Homeru;
        $homeru->user_id = \Auth::User()->id;
        $homeru->homerare_id = $id;
        $homeru->iine = $request->iine;
        $homeru->save();

        $homenoti = new Homerunotification;
        $homenoti->user_id = $id;
        $homenoti->hometa_id = \Auth::User()->id;
        $homenoti->read = '0';
        $homenoti->save();
        
        return redirect()->back();
    }
    
    public function unhomeru($id){
        $homeru_id = \DB::table('homerus')->where('user_id', \Auth::User()->id)->where('homerare_id', $id)->value('id');
        $homeru = Homeru::find($homeru_id); 
        $homeru->delete();
        
        $noti_id = \DB::table('homerunotifications')->where('hometa_id', \Auth::User()->id)->where('user_id', $id)->value('id');
        $homenoti = Homenotification::find($noti_id);
        $homenoti->delete();
        
        return redirect()->back();
    }

}
