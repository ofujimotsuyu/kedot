<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homerunotification extends Model
{
    protected $fillable = ['user_id', 'hometa_id', 'read'];
}
