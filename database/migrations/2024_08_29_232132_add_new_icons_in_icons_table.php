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
        $icons = Icon::all();
        foreach($icons as $icon){
            if($icon->description =='Bombillo'){
                $icon->icon = '<span class="material-symbols-outlined">lightbulb</span>';
            }
            if($icon->description =='Agua'){
                $icon->icon = '<span class="material-symbols-outlined">water</span>';
            }
            if($icon->description =='Camión'){
                $icon->icon = '<span class="material-symbols-outlined">local_shipping</span>';
            }
            if($icon->description =='Edificio'){
                $icon->icon = '<span class="material-symbols-outlined">apartment</span>';
            }
            if($icon->description =='Ubicación'){
                $icon->icon = '<span class="material-symbols-outlined">location_on</span>';
            }
            if($icon->description =='Árbol'){
                $icon->icon = '<span class="material-symbols-outlined">park</span>';
            }
            if($icon->description =='Círculo'){
                $icon->icon = '<span class="material-symbols-outlined">circle</span>';
            }
            if($icon->description =='Neutro'){
                $icon->icon = '<span class="material-symbols-outlined">fmd_bad</span>';
            }
            if($icon->description =='Triángulo'){
                $icon->icon = '<span class="material-symbols-outlined">change_history</span>';
            }
            if($icon->description =='Cuadrado'){
                $icon->icon = '<span class="material-symbols-outlined">crop_square</span>';
            }
            $icon->save();
        }
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
