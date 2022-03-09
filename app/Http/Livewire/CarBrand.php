<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarBrand as CarBrandModel;

class CarBrand extends Component
{

    public $carBrands;
    public $carBrand;

    public function mount($carBrand)
    {
        $this->carBrand = $carBrand;
    }
    public function getCarBrand()
    {
        $this->carBrands = CarBrandModel::where('title','like','%'.$this->carBrand.'%')->orderBy('title','DESC')->limit(5)->get();

        if(empty($this->carBrand)){
            return $this->carBrands = [];
        }
    }

    public function carBrandSelected($brand)
    {
        $this->carBrand = $brand;
        $this->carBrands = [];
    }

    public function render()
    {
        return view('livewire.car-brand');
    }

}
