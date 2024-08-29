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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });
        $this->insertSystems();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems');
    }

    private function insertSystems()
    {
        $sql = [
            ['description' => 'Captación'],
            ['description' => 'Potabilización'],
            ['description' => 'Producción'],
            ['description' => 'Conducción'],
            ['description' => 'Distribución']
        ];
        DB::table('systems')->insert($sql);
    }
};
