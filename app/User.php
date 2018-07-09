<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->belongsToMany(Group::class, 'user_group', 'user_id', 'group_id')->withTimestamps();
    }
    
    public function join($groupId)
    {
        // confirm if already favorite
        $exist = $this->is_joining($groupId);
    
        if ($exist) {
            return false;
        } else {
            // follow if not following
            $this->sankagroups()->attach($groupId);
            return true;
        }
    }
    
    public function quit($groupId){
        // confirming if already following
        $exist = $this->is_joining($groupId);
    
    
        if ($exist) {
            // stop following if following
            $this->sankagroups()->detach($groupId);
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    public function is_joining($groupId){
        return $this->sankagroups()->where('group_id', $groupId)->exists();
    }
}
