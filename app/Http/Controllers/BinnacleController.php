<?php

namespace App\Http\Controllers;

use App\Models\Operability;
use Illuminate\Http\Request;
use App\Models\OperabilityLog;
use App\DataTables\BinnacleDataTable;

class BinnacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BinnacleDataTable $dataTable){
        return $dataTable->render('admin.operability.binnacle.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operability $operability){
        return view('admin.operability.binnacle.edit')->with('operability',$operability);
    }

    public function update(Operability $operability, Request $request){
        $operability->operability_type_id = $request['status'];
        $operability->status_description = $request['statusDescription'];
        $operability->observation = is_null($request['observation']) ? 'No hay observación': $request['observation'];
        $operability->save();

          //bitacora
          OperabilityLog::create([
            'user_id' => auth()->user()->id,
            'status' => $request['status'],
            'status_description' => $request['statusDescription']
        ]);
        return redirect()->route('binnacles.index')->with('successful-message', 'Ubicación guardada exitosamente');;
    }
}
