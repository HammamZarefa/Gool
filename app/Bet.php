<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = "bet";
}
