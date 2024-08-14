<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperabilityType extends Model
{
    use HasFactory;
    protected $fillable = [
        'description','status',
    ];

    //Relación uno a muchos
    public function descriptionOperabilities(){
        return $this->hasMany(DescriptionOperability::class);
    }
}
