<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function transfers(){
        return $this->hasMany('App\Transfer');
    }
}
