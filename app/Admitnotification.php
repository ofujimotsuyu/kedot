<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admitnotification extends Model
{
    protected $fillable = ['user_id', 'group_id', 'read'];
}
