<?php

use App\Models\Icon;
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

        $newIcons = [
                'Tubería' => '<span class="material-symbols-outlined">water_pump</span>',
                'Válvula de Tubería' => '<span class="material-symbols-outlined">valve</span>',
                'Grifo' => '<span class="material-symbols-outlined">faucet</span>',
                'Mano sosteniendo agua' => '<span class="material-symbols-outlined">wash</span>',
                'Barril' => '<span class="material-symbols-outlined">oil_barrel</span>',
                'Hidrante' => '<span class="material-symbols-outlined">fire_hydrant</span>',
                'Botella de agua' => '<span class="material-symbols-outlined">water_bottle_large</span>',
                'Alerta' => '<span class="material-symbols-outlined">warning</span>',
                'Teléfono' => '<span class="material-symbols-outlined">call</span>',
            ];
            $dataToInsert = [];

            foreach ($newIcons as $description => $newIcon) {
                $dataToInsert[] = [
                    'description' => $description, // Usa la descripción del array
                    'icon' => $newIcon, // Usa el icono correspondiente
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('icons')->insert($dataToInsert);
    }


};
