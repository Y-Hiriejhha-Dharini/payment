<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PaymentLink;
use Livewire\WithPagination;

class PaymentView extends Component
{
    use WithPagination;

    public $paginationTheme = 'tailwind';

    public function go_to_payment_link_create_view()
    {
        return redirect()->to('/payment/create_payment_link');
    }

    public function render()
    {
        return view('livewire.payment-view', ['PaymentLinks' => PaymentLink::paginate(10)]);
    }
}
