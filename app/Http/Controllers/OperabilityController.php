<?php

namespace App\Http\Controllers;

use App\DataTables\OperabilityDataTable;
use proj4php\Proj;
use proj4php\Point;
use proj4php\Proj4php;
use App\Models\Operability;
use Illuminate\Http\Request;
use App\Models\DescriptionOperability;
use App\Models\OperabilityLog;

class OperabilityController extends Controller
{
    public function index(OperabilityDataTable $dataTable){
        return $dataTable->render('admin.operability.index');
    }

    public function create()
    {
        $operability = null;
        return view('admin.operability.create')->with('operability', $operability);
    }

    public function store(Request $request){
        $request->validate([
            'municipalitySelected' => 'required',
            'parishesSelected' => 'required',
            'sector' => 'required',
            'capacity' => 'required',
            'utm_x'=> 'required|numeric',
            'utm_y' => 'required|numeric',
            'zone' => 'required',
            'flow' => 'required',
            'status' => 'required',
            'statusDescription' => 'required',
            'details' => 'required',
            'icons' => 'required',
            'system' => 'required',
            'code' =>'required'
        ]);
        $utm = [$request['utm_x'],$request['utm_y'],$request['zone']];
        $resultConvert = $this->convert($utm);
        Operability::create([
            'user_id' => auth()->user()->id,
            'operability_type_id' => $request['status'],
            'code' => $request['code'],
            'icon_id' => $request['icons'],
            'details' => $request['details'],
            'municipality_id' => $request['municipalitySelected'],
            'parish_id' => $request['parishesSelected'],
            'system_id' => $request['system'],
            'sector' => $request['sector'],
            'utm_x' => $request['utm_x'],
            'utm_y' => $request['utm_y'],
            'zone' => $request['zone'],
            'latitude' => $resultConvert[0],
            'longitude' => $resultConvert[1],
            'capacity'  => $request['capacity'],
            'flow' => $request['flow'],
            'status_description' => $request['statusDescription'],
            'observation' => is_null($request['observation']) ? 'No hay observación': $request['observation']
        ]);
        //bitacora
        OperabilityLog::create([
            'user_id' => auth()->user()->id,
            'status' => $request['status'],
            'status_description' => $request['statusDescription']
        ]);
        return redirect()->action([OperabilityController::class,'index'])->with('successful-message', 'Ubicación guardada exitosamente');
    }

    public function edit(Operability $operability){
        return view('admin.operability.create')->with('operability',$operability);
    }

    public function update(Operability $operability, Request $request){
        $request->validate([
            'municipalitySelected' => 'required',
            'parishesSelected' => 'required',
            'sector' => 'required',
            'capacity' => 'required',
            'utm_x'=> 'required|numeric',
            'utm_y' => 'required|numeric',
            'zone' => 'required',
            'flow' => 'required',
            'status' => 'required',
            'statusDescription' => 'required',
            'details' => 'required',
            'icons' => 'required',
            'system' => 'required',
            'code' =>'required'
        ]);
        $utm = [$request['utm_x'],$request['utm_y'],$request['zone']];
        $resultConvert = $this->convert($utm);
        $operability->operability_type_id = $request['status'];
        $operability->icon_id = $request['icons'];
        $operability->details = $request['details'];
        $operability->municipality_id = $request['municipalitySelected'];
        $operability->parish_id = $request['parishesSelected'];
        $operability->sector = $request['sector'];
        $operability->utm_x = $request['utm_x'];
        $operability->utm_y = $request['utm_y'];
        $operability->zone = $request['zone'];
        $operability->code = $request['code'];
        $operability->system_id = $request['system'];
        $operability->latitude = $resultConvert[0];
        $operability->longitude = $resultConvert[1];
        $operability->flow = $request['flow'];
        $operability->capacity = $request['capacity'];
        $operability->status_description = $request['statusDescription'];
        $operability->observation = is_null($request['observation']) ? 'No hay observación': $request['observation'];
        $operability->save();

          //bitacora
        //   OperabilityLog::create([
        //     'user_id' => auth()->user()->id,
        //     'status' => $request['status'],
        //     'status_description' => $request['statusDescription']
        // ]);
        return redirect()->action([OperabilityController::class,'index'])->with('successful-message', 'Ubicación guardada exitosamente');
    }

    private function convert($utmRequest)
    {
        $utm_x = $utmRequest[0];
        $utm_y = $utmRequest[1];
        $zone = $utmRequest[2];

        // Crear una instancia de Proj4php
        $proj4 = new Proj4php();

        // Definir proyecciones UTM y geográficas
        $utm = new Proj('EPSG:326' . str_pad($zone, 2, '0', STR_PAD_LEFT), $proj4); // UTM zona norte
        $wgs84 = new Proj('EPSG:4326', $proj4); // WGS84

        // Crear el punto UTM
        $point = new Point($utm_x, $utm_y);

        // Transformar las coordenadas UTM a geográficas
        $geographicPoint = $proj4->transform($utm, $wgs84, $point); // Transformar usando el método correcto

        // Retornar el resultado
        $result = [$geographicPoint->y, $geographicPoint->x];
        return $result;
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

    public function destroy(Operability $operability)
    {
        $operability->delete();
    }
}
