<?php

namespace App\Http\Controllers;

use App\Models\PaymentLink;
use App\Models\PaymentLinkDetail;
use App\Models\PaymentTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentLinkController extends Controller
{
    public static function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $payment_link = "https://payment.payment_link.com/".request()->user_id.Str::random(30);

                $payment_link_model = PaymentLink::create([
                    'user_id'=> request()->user_id,
                    'payment_link_name' => 'Product Payment',
                    'payment_link' => $payment_link,
                    'amount' => request()->amount,
                    'status' => 0,
                ]);
            for($i = 0; $i <= $request['count']; $i++)
            {
                $payment_link_details = new PaymentLinkDetail;
                $payment_link_details->payment_link_id = $payment_link_model->getKey();
                $payment_link_details->payment_link_name_id = $request['pro_id_'.$i];
                $payment_link_details->save();
            }
            DB::commit();
            return redirect('/payment/show_payment_link')->with('success',$payment_link);

        }catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/payment/show_payment_link')->with('success', $e);

        }
    }

    public function payment_store()
    {
dd(request()->all());
        $payment_data = request()->validate([
            'user_email'=> 'required',
            'card_no' => 'required',
            'date' => 'required',
            'cvc' => 'required',
            'transaction_id' => 'required',
            'total_amount' => 'required',
            // 'product_qty' => 'required',
        ]);

        PaymentTable::create([
            'user_id' => auth()->user()->id,
            'user_email' => $payment_data['user_email'],
            'card_no' => $payment_data['card_no'],
            'date' => $payment_data['date'],
            'cvc' => $payment_data['cvc'],
            'transaction_id' => $payment_data['transaction_id'],
            'amount' => $payment_data['total_amount'],
            'status' => 0
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:4242/success',
            'cancel_url' => 'http://localhost:4242/cancel',
          ]);
          
          header("HTTP/1.1 303 See Other");
          header("Location: " . $checkout_session->url);

          return redirect($checkout_session->url);
    }
}
