<?php

namespace App\Livewire;

use App\Models\DescriptionOperability;
use App\Models\OperabilityType;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UbicationCreate extends Component
{
    public $municipalities = null, $parishes = null, $prueba, $parishesSelected = null, $sector = null;
    public $operabilityTypes = null, $operabilityTypeSelected = null, $descriptionOperabilities = null;
    public $municipalitySelected = null, $icons = null, $iconSelected = null, $iconImage = null, $details;
    public $latitude = null , $longitude =null ,$flow = null , $capacity = null ,$operability = null;
    public $statusDescription = null, $observation = null;
    public $utmY,$utmX,$zone,$systems,$systemSelected,$code;
    public function mount(){
        if($this->operability){
            $this->municipalitySelected = $this->operability->municipality_id;
            $this->parishes = DB::table('parishes')->where('municipality_id','=',$this->municipalitySelected)->get();
            $this->parishesSelected = $this->operability->parish_id;
            $this->sector = $this->operability->sector;
            $this->details = $this->operability->details;
            $this->latitude = $this->operability->latitude;
            $this->longitude = $this->operability->longitude;
            $this->flow = $this->operability->flow;
            $this->utmY = $this->operability->utm_y;
            $this->utmX = $this->operability->utm_x;
            $this->zone = $this->operability->zone;
            $this->capacity = $this->operability->capacity;
            $this->systemSelected = $this->operability->system_id;
            $this->code = $this->operability->code;
            $this->operabilityTypeSelected = $this->operability->operability_type_id;
            $this->descriptionOperabilities = DB::table('description_operabilities')->where('operability_type_id','=',$this->operabilityTypeSelected)->get();
            $this->statusDescription = $this->operability->status_description;
            $this->iconSelected = $this->operability->icon_id;
            $this->iconImage = DB::table('icons')->where('id', '=', $this->iconSelected)->first();
            $this->observation = $this->operability->observation;
        }
        $this->systems = DB::table('systems')->get();
        $this->municipalities = DB::table('municipalities')->where('state_id','=',12)->get();
        $this->icons = DB::table('icons')->get();
        $this->operabilityTypes = DB::table('operability_types')->where('status','=','A')->get();
    }
    public function updatedMunicipalitySelected($municipality_id){
        if($municipality_id && $this->municipalitySelected){
            $this->reset(['parishes','parishesSelected']);
            $this->parishes = DB::table('parishes')->where('municipality_id','=',$municipality_id)->get();
        }else
            $this->reset(['parishes','municipalitySelected','parishesSelected']);
    }
    public function updatedIconSelected($icon_id){
        if($icon_id && $this->iconSelected){
            $this->reset(['iconImage']);
            $this->iconImage = DB::table('icons')->where('id', '=', $icon_id)->first();
        }else
            $this->reset(['iconImage','iconSelected']);
    }

    public function updatedOperabilityTypeSelected($operabilityStatusId){
        if($operabilityStatusId){
            $descriptionOperability = new DescriptionOperability();
            $this->descriptionOperabilities = DB::table('description_operabilities')->where('operability_type_id','=',$operabilityStatusId)->get();
        }
    }

    public function render()
    {
        return view('livewire.ubication-create');
    }


}
