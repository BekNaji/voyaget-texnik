<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer as CustomerModel;

class Customer extends Component
{

    public $customers;
    public $customer;

    public function mount($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        $this->customers = CustomerModel::where('full_name','like','%'.$this->customer.'%')->orderBy('full_name','DESC')->limit(5)->get();

        if(empty($this->customer)){
            return $this->customers = [];
        }
    }

    public function customerSelected($customer)
    {
        $this->customer = $customer;
        $this->customers = [];
    }

    public function render()
    {
        return view('livewire.customer');
    }
}
