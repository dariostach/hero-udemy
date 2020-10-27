<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;
    protected $table = 'heroes';
    public function level(){ // se define la relacion con el level_id
        return $this->hasOne('App\Models\Level', 'id','level_id');
    }
}
