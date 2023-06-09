<div class="max-w-lg mx-auto py-10">
    <h1 class="font-bold text-center text-lg">CREATE PAYMENT LINK</h1>
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('payment.store')}}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
            <input value={{Auth::user()->name}} class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" placeholder="Username" disabled>
            <input type="hidden" name="user_id" value={{Auth::user()->id}} >
            @error('username')
                <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
            @enderror
        </div>
        <div class="mb-4">
            @foreach ($products as $key =>$product)
                <div class="my-4">
                    <div class="search-box">
                        <div class="flex">
                            <input name="pro_name_{{$key}}" wire:keyup="searchResult({{$key}})" wire:model="products.{{$key}}.pro_name" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Payment Link Name"/>
                            <input name="pro_id_{{$key}}" wire:model="products.{{$key}}.pro_id" type="hidden"/>
                            <input type="submit" wire:click.prevent="delete_product({{$key}})" class="form-control bg-red-500 hover:bg-red-700 text-white font-bold mx-2 px-4 rounded" value="- Delete">    
                        </div>
                            @error('pro_name{{$key}}')
                            <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
                            @enderror
                        </div>

                    <!-- Search result list -->
                    @if($showResult[$key])
                        <ul >
                            @if(!empty($records))
                                @foreach($records as $record)
                                    <li wire:click="fetchProductDetail({{$key}},{{$record->id}})">{{ $record->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                </div>
            @endforeach
            <input type="hidden" name="count" value={{$key}}>
            <input type="submit" wire:click.prevent="add_product()" class="form-control bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="+ Add Payment Link Name">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="card_no">Amount</label>
            <input name="amount" wire:model="amount" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amount" id="amount" type="text" placeholder="Amount">
            @error('amount')
                <h6 class="text-red-600 text-sm mt-2">{{$message}}</h6>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="submit" class="form-control bg-green-500 hover:bg-gteen-700 text-white font-bold py-2 px-4 rounded" value="Generate a Payment Link">
            <input type="reset" wire:click.prevent="reset()" class="form-control bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" value="Cancel">
        </div>
    </form>
</div>