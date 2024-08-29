<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operability extends Model
{
    use HasFactory;
    protected $guarded =  ['id'];

    //Relación uno a uno
    public function icon(){
        return $this->belongsTo(Icon::class);
    }
}
