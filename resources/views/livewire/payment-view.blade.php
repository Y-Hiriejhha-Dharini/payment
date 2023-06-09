<div>
    <div>
        <button wire:click="go_to_payment_link_create_view" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            + Create Payment Link
        </button>

        <a href="{{route('payment.show_payment_link')}}" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
          Pay Now
        </a>
    </div>
    <div class="my-5">
        <table class="table-auto mx-auto w-full">
            <thead>
              <tr>
                <th class="px-4 py-2">Payment Link</th>
                <th class="px-4 py-2">Payment Link Name</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Created At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($PaymentLinks as $PaymentLink)
                @if($PaymentLink->status == 0)
                  <tr class="bg-red-300">
                    <td class="border px-4 py-2">{{$PaymentLink->payment_link_name}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->payment_link}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->amount}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->status}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->created_at->format('j F, Y')}}</td>
                  </tr>
                @else
                  <tr class="bg-green-300">
                    <td class="border px-4 py-2">{{$PaymentLink->payment_link_name}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->payment_link}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->amount}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->status}}</td>
                    <td class="border px-4 py-2">{{$PaymentLink->created_at->format('j F, Y')}}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
          <div class="my-5">
            {{ $PaymentLinks->links() }}
          </div>
    </div>
</div>
