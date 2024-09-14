<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Operability;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MapComponent extends Component
{
    public $operabilities = array(), $reloadMap = true, $latitude = null, $longitude = null, $search = null, $systems= null,$systemSelected = null;
    public $municipalities = null, $parishes = null,$municipalitySelected = null, $parishesSelected = null;
    public $operabilityTypeSelected =null,$operabilityTypes;
    protected $listeners = ['mapReset' => 'mapInit'];

    public function mapInit()
    {
        $this->dispatch('mapInit');
    }
    public function mount($systemId=null,$municipality=null,$parish=null,$operabilityTypeSelected = null)
    {
        $this->municipalities = DB::table('municipalities')->where('state_id','=',12)->get();
        $this->operabilityTypes =  DB::table('operability_types')->where('status','=','A')->get();
        $operabilities = Operability::join('icons', 'operabilities.icon_id', '=', 'icons.id')
            ->join('operability_types', 'operabilities.operability_type_id', '=', 'operability_types.id')
            ->join('users', 'operabilities.user_id', '=', 'users.id')
            ->join('municipalities', 'operabilities.municipality_id', '=', 'municipalities.id')
            ->join('parishes', 'operabilities.parish_id', '=', 'parishes.id')
            ->select(
                'operabilities.*',
                'users.name as username',
                'icons.icon',
                'municipalities.municipality',
                'parishes.parish',
                'operability_types.description as operability_type'
            );
            if(!is_null($systemId) && !empty($systemId)){
                $operabilities =  $operabilities->where('system_id',$systemId);
            }
            if(!is_null($municipality) && !empty($municipality)){
                $operabilities =  $operabilities->where('operabilities.municipality_id',$municipality);
            }
            if(!is_null($parish) && !empty($parish)){
                $operabilities =  $operabilities->where('operabilities.parish_id',$parish);
            }
            if(!is_null($operabilityTypeSelected) && !empty($operabilityTypeSelected)){
                $operabilities =  $operabilities->where('operabilities.operability_type_id',$operabilityTypeSelected);
            }
            $this->operabilities =  $operabilities->get();
            $this->systems = DB::table('systems')->get();
        if ($this->reloadMap) $this->dispatch('mapInit');
    }

    public function updatedSystemSelected($systemId)
    {
        $this->systemSelected = $systemId;
        $municipality = $this->municipalitySelected;
        $parish = $this->parishesSelected;
        $operabilityTypeSelected = $this->operabilityTypeSelected;
        $this->reset('operabilities');
        $this->mount($systemId,$municipality,$parish,$operabilityTypeSelected);
        $this->dispatch('resetMap', [
            'locations' => $this->getLocations()
        ]);
    }

    public function updatedOperabilityTypeSelected($operabilityTypeSelected)
    {
        $systemId = $this->systemSelected;
        $municipality = $this->municipalitySelected;
        $parish = $this->parishesSelected;
        $this->reset('operabilities');
        $this->mount($systemId,$municipality,$parish,$operabilityTypeSelected);
        $this->dispatch('resetMap', [
            'locations' => $this->getLocations()
        ]);
    }

    protected function getLocations()
    {
        $locations = [];

        foreach ($this->operabilities as $operability) {
            $locations[] = [
                'coords' => [$operability->latitude, $operability->longitude],
                'icon' => $operability->icon,
                'className' => $operability->operability_type_id == 1 ? 'my-icon-green' : ($operability->operability_type_id == 3 ? 'my-icon-red' : 'my-icon-yellow'),
                'popupContent' =>'<h2 class="font-bold uppercase text-center">'.$operability->details .'</h2> <p>Municipio:'.$operability->municipality .'</p> <p>Parroquia:'.$operability->parish.'</p><p class="capitalize">Sector: '.$operability->sector .'</p><p class="capitalize">Capacidad:'. $operability->capacity .' litros</p> <p class="capitalize">Caudal:'. $operability->flow .' litros</p><p class="capitalize">Estatus:'. $operability->operability_type .'</p><p>Motivo:'. $operability->status_description .'</p><p>Coordenadas:'.$operability->latitude.','. $operability->longitude.'</p>'
            ];
        }
        return $locations;
    }

    public function delete(Operability $operability)
    {
        $this->latitude = $operability->latitude;
        $this->longitude = $operability->longitude;
        $operability->delete();
        $this->reset('operabilities');
        $this->reloadMap = false;
        $this->mount();
    }
    public function updatedMunicipalitySelected($municipality_id){
        if($municipality_id && $this->municipalitySelected){
            $this->reset(['parishes','parishesSelected']);
            $this->parishes = DB::table('parishes')->where('municipality_id','=',$municipality_id)->get();
        }else
            $this->reset(['parishes','municipalitySelected','parishesSelected']);

        $systemId = $this->systemSelected;
        $municipality = $municipality_id;
        $parish = $this->parishesSelected;
        $operabilityTypeSelected = $this->operabilityTypeSelected;
        $this->reset('operabilities');
        $this->mount($systemId,$municipality,$parish,$operabilityTypeSelected);
        $this->dispatch('resetMap', [
            'locations' => $this->getLocations()
        ]);
    }
    public function updatedParishesSelected($parishId)
    {
        $systemId = $this->systemSelected;
        $municipality = $this->municipalitySelected;
        $operabilityTypeSelected = $this->operabilityTypeSelected;
        $this->reset('operabilities');
        $this->mount($systemId,$municipality,$parishId,$operabilityTypeSelected);
        $this->dispatch('resetMap', [
            'locations' => $this->getLocations()
        ]);
    }
    public function render()
    {
        if ($this->search) {
            $this->operabilities = Operability::join('icons', 'operabilities.icon_id', '=', 'icons.id')
                ->join('operability_types', 'operabilities.operability_type_id', '=', 'operability_types.id')
                ->join('users', 'operabilities.user_id', '=', 'users.id')
                ->join('municipalities', 'operabilities.municipality_id', '=', 'municipalities.id')
                ->join('parishes', 'operabilities.parish_id', '=', 'parishes.id')
                ->where(function($query){
                    $query->where('operabilities.details', 'like', '%' . $this->search . '%')
                          ->orWhere('operabilities.sector', 'like', '%' . $this->search . '%')
                          ->orWhere('operability_types.description', 'like', '%' . $this->search . '%');
                })
                ->select(
                    'operabilities.*',
                    'users.name as username',
                    'icons.icon',
                    'municipalities.municipality',
                    'parishes.parish',
                    'operability_types.description as operability_type'
                )
                ->get();
        }else{
            $this->mount();
        }
        return view('livewire.map-component')->layout('layouts.app');
    }
}
