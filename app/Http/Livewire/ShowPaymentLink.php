<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PaymentLink;
use App\Models\PaymentLinkDetail;
use App\Models\PaymentLinkName;
use App\Models\User;
use App\Http\Controllers\PaymentLinkController;
use App\Models\PaymentDetails;
use App\Models\PaymentTable;

class ShowPaymentLink extends Component
{
    public $payment_link ='';
    public $user_name = '';
    public $paylink_products;
    public $amount = '';
    public $transaction_id = '';
    public $showForm = true;
    public $first_payment_link = '';
    public $user_email = '';
    public $card_no = '';
    public $date = '';
    public $cvc = '';
    public $count = '';

    public function mount()
    {
        $this->paylink_products = [
            ['id' => '',
            'name' => '']
        ];
    }
    protected $rules = [
            'user_email'=> 'required',
            'card_no' => 'required',
            'date' => 'required',
            'cvc' => 'required',
            'transaction_id' => 'required',
            'payment_link' => 'required',
            'user_name' => 'required',
            'paylink_products' => 'required',
            'amount' => 'required',
            'count' => 'required',
        ];

    public function payment_details()
    {
        $payment_link_name = PaymentLink::where('payment_link',$this->payment_link)->first();

        if($payment_link_name)
        {
            $this->user_name = User::where('id',$payment_link_name['user_id'])->pluck('name');
            $this->amount = $payment_link_name->amount;
            $this->transaction_id = $payment_link_name->id;

            $products = $payment_link_name
                            // ->with('payment_link_detail','user')
                            ->join('payment_link_details', 'payment_links.id','payment_link_details.payment_link_id')
                            ->where('payment_links.id',$payment_link_name->id)
                            ->get();

            foreach($products as $key => $product)
            {
                $pro = PaymentLinkName::where('id',$product['payment_link_name_id'])->pluck('name');
                $this->paylink_products[$key]['id'] = $product['payment_link_name_id'];
                $this->paylink_products[$key]['name'] = $pro[0];
            }
                $this->count = $key + 1;
                // dd($this->paylink_products);
        }
    }

    public function save_payment()
    {
        // dd(request()->all());
       $payment =  PaymentTable::create([
            'user_id' => auth()->user()->id,
            // 'user_email' => $this->user_email,
            // 'card_no' => $this->card_no,
            // 'date' => $this->date,
            // 'cvc' => $this->cvc,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'status' => 0
        ]);

        $paid_update = PaymentLink::find($this->transaction_id);
        $paid_update->status = 1;
        $paid_update->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        foreach($this->paylink_products as $product)
        {
            PaymentDetails::create([
                'payment_tables_id' => $payment->getKey(),
                'product_id' => $product['id'],
                'status' => 0 
            ]);   

            $product_price = PaymentLinkName::find($product['id']);
            
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [[
                  'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                      'name' => $product['name'],
                    ],
                    'unit_amount' => $product_price->default_price * 300,
                  ],
                  'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('dashboard', [], true),
                'cancel_url' => route('payment.show_payment_link', [], true),
              ]);
              
        }
    
                return redirect($checkout_session->url);
    }

    public function go_to_payment_view()
    {
        return redirect()->to('/dashboard');
    }

    public function go_to_payment_link_create_view()
    {
        return redirect()->to('/payment/create_payment_link');
    }

    public function show_payment_field()
    {
        $showForm = false;
    }

    public function render()
    {
        return view('livewire.show-payment-link');
    }
}
