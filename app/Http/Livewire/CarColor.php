<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarColor as CarColorModel;

class CarColor extends Component
{

    public $carColors;
    public $carColor;

    public function mount($carColor)
    {
        $this->carColors = CarColorModel::orderBy('title','DESC')->get();
        $this->carColor = $carColor;
    }


    public function render()
    {
        return view('livewire.car-color');
    }

    public function getCarColor()
    {
        $this->carColors = CarColorModel::where('title','like','%'.$this->carColor.'%')->orderBy('title','DESC')->limit(5)->get();

        if(empty($this->carColor)){
            return $this->carColors = [];
        }
    }

    public function carColorSelected($color)
    {
        $this->carColor = $color;
        $this->carColors = [];
    }
}
