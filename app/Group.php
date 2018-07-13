<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['goal', 'to_do', 'term', 'amount', 'unit', 'group_filename','category','user_id'];

    public function sankausers()
    {
        return $this->belongsToMany(User::class, 'user_group', 'group_id', 'user_id')->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
