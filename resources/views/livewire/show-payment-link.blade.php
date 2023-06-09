<div>
        <div class="container mx-auto"> 
            @if(session()->get('success')== true)
              @php
                  $session = session()->get('success')
              @endphp
              <h1 class="text-center font-bold my-5">COPY THE LINK TO PAY</h1>
              <div class="block my-5">
                <label class="block text-gray-700 text-md font-bold my-2 me-5">PAYMENT LINK</label>
                <input value="{{$session}}" name="first_payment_link" class="shadow appearance-none rounded w-9/12 px-3 py-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text">
                <button wire:click.prevent="show_payment_field()" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white my-4 py-3 ms-5 px-4 border border-blue-500 hover:border-transparent rounded">Go To Pay</button>
              </div>
              
            <div>
              <button wire:click="go_to_payment_view" class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white my-4 py-2 px-4 border border-yellow-500 hover:border-transparent rounded">
                  Go Back to Payment Link View
              </button>
              <button wire:click="go_to_payment_link_create_view" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                + Create Payment Link
              </button>
            </div>
          @elseif($showForm == true)
            <div class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-8">
              <form wire:submit.prevent="save_payment">
                @csrf
                <h1 class="font-bold text-center text-lg">Pay Your Payment Link</h1>
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2">Payment Link</label>
                      <input name="payment_link" wire:model="payment_link" wire:keyup="payment_details" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Payment Link">
                  </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">User Name</label>
                    <input name="user_name" wire:model="user_name" wire:model="user_name" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="User Name" >
                  </div>
                  @foreach ($paylink_products as $key => $paylink_product)
                  {{-- @dd($paylink_products[]) --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Payment Products</label>
                        <input wire:model="paylink_products.{{$key}}.name"  class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Payment Products" >
                        <input type="hidden" wire:model="paylink_products.{{$key}}.id">
                        <input type="hidden" value="{{$key}}" wire:model="count">
                      </div>
                  @endforeach
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                  <input name="amount" wire:model="amount" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Amount" disabled>
                </div>
                <hr>
                {{-- <h1 class="font-bold text-center text-lg">Payment Details</h1>
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">User Email</label>
                  <input name="user_email" wire:model="user_email" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="User Email">
                  @error('user_email')
                    <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Card No</label>
                  <input name="card_no" wire:model="card_no" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Card No">
                  @error('card_no')
                      <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                  <input name="date" wire:model="date" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Date">
                  @error('date')
                      <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
                  @enderror
                </div><div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">CVC</label>
                  <input name="cvc" wire:model="cvc" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="cvc">
                  @error('cvc')
                      <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
                  @enderror
                  <input type="hidden" wire:model="transaction_id"  name="transaction_id">
                </div> --}}
                  <div class="input-group mb-3">
                      <input type="submit" class="form-control bg-green-500 hover:bg-gteen-700 text-white font-bold py-2 px-4 rounded" value="Checkout">
                      <input type="reset" class="form-control bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" value="Cancel">
                  </div>
              </form>
        @endif
        </div>
</div>
