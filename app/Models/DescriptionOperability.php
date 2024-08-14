<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionOperability extends Model
{
    use HasFactory;
    protected $fillable = [
        'operability_type_id','description','status'
    ];

    //Relación uno a muchos inversa
    public function OperabilityType(){
        return $this->belongsTo(OperabilityType::class);
    }
}
