<?php

namespace App\Http\Controllers;

use App\Models\DescriptionOperability;
use App\Models\Operability;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        $operability = null;
        return view('map.create')->with('operability', $operability);
    }

    public function store(Request $request){
        $request->validate([
            'municipalitySelected' => 'required',
            'parishesSelected' => 'required',
            'sector' => 'required',
            'capacity' => 'required',
            'latitude'=> 'required',
            'longitude' => 'required',
            'flow' => 'required',
            'status' => 'required',
            'statusDescription' => 'required',
            'details' => 'required',
            'icons' => 'required'
        ]);
        Operability::create([
            'user_id' => auth()->user()->id,
            'operability_type_id' => $request['status'],
            'icon_id' => $request['icons'],
            'details' => $request['details'],
            'municipality_id' => $request['municipalitySelected'],
            'parish_id' => $request['parishesSelected'],
            'sector' => $request['sector'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'capacity'  => $request['capacity'],
            'flow' => $request['flow'],
            'status_description' => $request['statusDescription'],
            'observation' => is_null($request['observation']) ? 'No hay observación': $request['observation']
        ]);
        return redirect()->action([MapController::class,'index'])->with('successful-message', 'Ubicación guardada exitosamente');
    }

    public function edit(Operability $operability){
        return view('map.create')->with('operability',$operability);
    }

    public function update(Operability $operability, Request $request){
        $request->validate([
            'municipalitySelected' => 'required',
            'parishesSelected' => 'required',
            'sector' => 'required',
            'capacity' => 'required',
            'latitude'=> 'required',
            'longitude' => 'required',
            'flow' => 'required',
            'status' => 'required',
            'statusDescription' => 'required',
            'details' => 'required',
            'icons' => 'required'
        ]);

        $operability->operability_type_id = $request['status'];
        $operability->icon_id = $request['icons'];
        $operability->details = $request['details'];
        $operability->municipality_id = $request['municipalitySelected'];
        $operability->parish_id = $request['parishesSelected'];
        $operability->sector = $request['sector'];
        $operability->latitude = $request['latitude'];
        $operability->longitude = $request['longitude'];
        $operability->flow = $request['flow'];
        $operability->capacity = $request['capacity'];
        $operability->status_description = $request['statusDescription'];
        $operability->observation = is_null($request['observation']) ? 'No hay observación': $request['observation'];
        $operability->save();
        return redirect()->route('dashboard');
    }
}
