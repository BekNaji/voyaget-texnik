<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ApplicationModal extends Component
{
    public $app_id;
    public $type;
    public $message;
    public $status;
    
    public function mount($app_id,$type,$message,$status)
    {
        $this->app_id = $app_id;
        $this->type = $type;
        $this->message = $message;
        $this->status = $status;
    }
    public function render()
    {
        return view('livewire.application-modal');
    }
}
