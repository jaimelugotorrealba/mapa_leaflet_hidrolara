<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       DB::table('icons')->where('icon','<span class="material-symbols-outlined">water_pump</span>')->where('description','Tubería')->update(['description'=>'Bomba de agua']);
    }

 
};
