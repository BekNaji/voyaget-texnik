<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GosNumber as GosNumberModel;
use App\Models\GosNumberCustomer;

class GosNumber extends Component
{
    public $gosNumbers;
    public $gosNumber;

    public function mount($gosNumber)
    {
        $this->gosNumber = $gosNumber;
    }

    public function getGosNumbers()
    {
        
        $this->gosNumbers = GosNumberModel::where('number','like','%'.$this->gosNumber.'%')->orderBy('number','DESC')->limit(5)->get();

        if(empty($this->gosNumber)){
            return $this->gosNumbers = [];
        }
    }

    public function gosNumberSelected($number)
    {
        $this->gosNumber = $number;
 
        // $gosNumber = GosNumberModel::where('number',$this->gosNumber)->first();
        
        // $gosNumberCustomer = GosNumberCustomer::where('gos_number_id', $gosNumber->id)->first();

        // //echo '<pre>'; print_r($gosNumberCustomer); echo '</pre>';

        $this->gosNumbers = [];
    }

    public function render()
    {
        return view('livewire.gos-number');
    }

}
