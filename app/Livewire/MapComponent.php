<?php

namespace App\Livewire;

use App\Models\Operability;
use Livewire\Component;

class MapComponent extends Component
{
    public $operabilities = array(), $reloadMap = true, $latitude = null, $longitude = null, $search = null;
    protected $listeners = ['mapReset' => 'mapInit'];

    public function mapInit()
    {
        $this->dispatch('mapInit');
    }
    public function mount()
    {
        $this->operabilities = Operability::join('icons', 'operabilities.icon_id', '=', 'icons.id')
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
            )
            ->get();
        if ($this->reloadMap) $this->dispatch('mapInit');
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
