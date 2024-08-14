<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operability extends Model
{
    use HasFactory;
    protected $fillable =  [
        'user_id','operability_type_id','icon_id','details','municipality_id',
        'parish_id','sector','latitude','longitude','capacity','flow','status_description',
        'observation','status'
    ];

    //Relación uno a uno
    public function icon(){
        return $this->belongsTo(Icon::class);
    }
}
