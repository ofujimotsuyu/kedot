<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\DB;
use App\Auth;
use App\Requestnotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'avatar_filename',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function sankagroups()
    {
        return $this->belongsToMany(Group::class, 'user_group', 'user_id', 'group_id')->where('status', 2)->withTimestamps();
    }
    
    
    public function joinrequest($groupId)
    {
        // confirm if already favorite
        $exist = $this->is_joining($groupId);
    
        if ($exist) {
            return false;
        } else {
            // follow if not following
            $this->sankagroups()->attach($groupId);
            \DB::table('user_group')->where('group_id', $groupId)->where('user_id', \Auth::user()->id)->update(['status'=>'1']);
            
            $requestnoti = new Requestnotification;
            $requestnoti->requestuser_id = \Auth::user()->id;
            $requestnoti->group_id = $groupId;
            $requestnoti->read = '0';
            $requestnoti->save();

            return true;
        }
    }
    
    public function quit($groupId){
        // confirming if already following
        $exist = $this->is_joining($groupId);
    
    
        if ($exist) {
            // stop following if following
           $this->sankagroups()->detach($groupId);
           
           $requestnoti_id = \DB::table('requestnotifications')->where('group_id', $groupId)->where('requestuser_id', \Auth::User()->id)->value('id');
           $requestnoti = Requestnotification::find($requestnoti_id);
           $requestnoti->delete();
            
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    public function is_joining($groupId){
        return $this->sankagroups()->where('group_id', $groupId)->where('status', '2')->exists();
    }
    
    public function is_shinseing1($groupId){
        return \DB::table('user_group')->where('user_id', $this->id)->where('group_id', $groupId)->where('status', '1')->exists();
    }
    
    public function is_shinseing2($groupId){
        return $this->sankagroups()->where('group_id', $groupId)->where('status', '0')->exists();
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Group::class, 'user_favorite', 'user_id', 'favorite_id')->withTimestamps();
    }
    
    public function favorite($groupId)
    {   
        $exist = $this->is_favoriting($groupId);

         if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($groupId);
            return true;
        }
    }
    public function unfavorite($groupId)
    {
        $exist = $this->is_favoriting($groupId);
       
    
        if ($exist) {
            $this->favorites()->detach($groupId);
            return true;
        } else {
            return false;
        }
    
    }

    public function is_favoriting($groupId) {
        return $this->favorites()->where('favorite_id', $groupId)->exists();
    }
    
}