<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;
    protected $fillable = [
        'description','icon','status',
    ];

    //Relación uno a uno inversa
    public function operability(){
        return $this->hasOne(Operability::class);
    }
}
