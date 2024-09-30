<?php

namespace App\Console\Commands;

use Exception;
use proj4php\Proj;
use proj4php\Point;
use proj4php\Proj4php;
use App\Models\Operability;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class ConvertToGeographicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-to-geographic-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $operabilities = Operability::all();
        try{
            foreach($operabilities as $operability){
                if(is_null($operability->utm_x) && is_null($operability->utm_y) && is_null($operability->zone)){
                    $utmRequest = [$operability->latitude,$operability->longitude];
                    $result = $this->convertToUtm($utmRequest);
                    Operability::where('id',$operability->id)->update(['utm_x' => $result[0],'utm_y' => $result[1] ,'zone' => $result[2]]);
                }

            }
        }catch(Exception $e){
            Log::error('Error:'.$e->getMessage());
        }
    }

    private function convertToUtm($geoRequest)
    {
        $latitude = $geoRequest[0];
        $longitude = $geoRequest[1];

        // Crear una instancia de Proj4php
        $proj4 = new Proj4php();

        // Definir proyecciones geográficas y UTM
        $wgs84 = new Proj('EPSG:4326', $proj4); // WGS84
        $zone = floor(($longitude + 180) / 6) + 1; // Calcular la zona UTM
        $utm = new Proj('EPSG:326' . str_pad($zone, 2, '0', STR_PAD_LEFT), $proj4); // UTM zona norte

        // Crear el punto geográfico
        $point = new Point($longitude, $latitude);

        // Transformar las coordenadas geográficas a UTM
        $utmPoint = $proj4->transform($wgs84, $utm, $point);

        // Retornar el resultado
        $result = [$utmPoint->x, $utmPoint->y, $zone]; // Retorna las coordenadas UTM y la zona
        return $result;
    }
}
