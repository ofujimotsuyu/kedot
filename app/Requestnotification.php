<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestnotification extends Model
{
    protected $fillable = ['requestuser_id', 'group_id', 'read'];
}
