<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_name', 'goal', 'to_do', 'term', 'amount', 'unit', 'group_filename'];
}
