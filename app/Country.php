<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = ['id'];
    protected $table = "countries";

    public function leagues(){
        return $this->hasMany(League::class, 'country_key', 'country_key');
    }

    public function matches(){
        return $this->hasMany(Match::class, 'country_key', 'country_key');
    }
}
