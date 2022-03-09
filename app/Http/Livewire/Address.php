<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Region;
use App\Models\District;

class Address extends Component
{
    public $regions;
    public $districts;

    public $region;
    public $district;

    public $address;

    protected $listeners = ['getDistricts'];

    public function mount($address,$region,$district)
    {
        $this->regions = Region::orderBy('name_uz','DESC')->get();
        $this->address = $address;
        $this->region = $region;
        $this->getDistricts();
        $this->district = $district;
    }

    public function render()
    {
        return view('livewire.address');
    }

    public function getDistricts()
    {
        $this->districts = District::where('region_id',$this->region)->get();
    }
}
