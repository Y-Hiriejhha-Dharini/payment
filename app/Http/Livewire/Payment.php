<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Stripe;
use App\Models\PaymentLinkName;
use Illuminate\Support\Facades\Validator;

class Payment extends Component
{
    public $items = [];
    public $showResult = [];
    public $records;
    public $amount = 0;
    public $products = [];
 
    public function mount()
    {
        $this->products = [
            [
                'pro_id' => '',
                'pro_name'=>''
            ]
        ];
        $this->showResult[] = false;
    }

    public function delete_product($i)
    {
        unset($this->products[$i]);
        $this->products = array_values($this->products);
    }

    public function add_product()
    {
        $this->products[] = [
            'pro_id' => '',
            'pro_name'=> ''
        ];
        $this->showResult[] = false;
    }

    public function searchResult($key){

        if(!empty($this->products[$key]['pro_name'])){

            $this->records = PaymentLinkName::orderby('name','asc')
                      ->select('*')
                      ->where('name','like','%'.$this->products[$key]['pro_name'].'%')
                      ->limit(5)
                      ->get();

            $this->showResult[$key] = true;
        }else{
            $this->showResult[] = false;
        }
    }

    public function fetchProductDetail($key, $id = 0){

        $record = PaymentLinkName::find($id);
            $this->products[$key]['pro_name'] = $record['name'];
            $this->products[$key]['pro_id'] = $record['id'];
            $this->amount = $this->amount + $record->default_price;
            $this->showResult[$key] = false;
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
