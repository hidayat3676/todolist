<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
