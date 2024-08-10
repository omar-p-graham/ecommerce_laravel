<div class="w-full px-4 py-10 mx-auto sm:px-6 lg:px-8">
    <div class="container px-4 mx-auto">
      <livewire:partials.main-heading :heading="'My Cart'"/>
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="md:w-3/4">
          <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full">
              <thead>
                <tr>
                  <th class="font-semibold text-left">Product</th>
                  <th class="font-semibold text-left">Price</th>
                  <th class="font-semibold text-left">Quantity</th>
                  <th class="font-semibold text-left">Total</th>
                  <th class="font-semibold text-left">Remove</th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($items as $key => $item) 
                  <tr>
                    <td class="py-4">
                      <div class="flex items-center">
                        <img class="w-16 h-16 mr-4" src="{{url('storage',$item['image'])}}" alt="Product image">
                        <a href="/product/{{$item['slug']}}" class="font-semibold hover:underline">{{$item['name']}}</a>
                      </div>
                    </td>
                    <td class="py-4">{{Number::currency($item['price'])}}</td>
                    <td class="py-4">
                      <div class="flex items-center">
                        <button class="px-4 py-2 mr-2 border rounded-md" wire:click="decreaseItemQuantity({{$item['productID']}})">-</button>
                        <span class="w-8 text-center">{{$item['quantity']}}</span>
                        <button class="px-4 py-2 ml-2 border rounded-md" wire:click="increaseItemQuantity({{$item['productID']}})">+</button>
                      </div>
                    </td>
                    <td class="py-4">{{Number::currency($item['totalAmount'])}}</td>
                    <td><button class="px-3 py-1 border-2 rounded-lg bg-slate-300 border-slate-400 hover:bg-red-500 hover:text-white hover:border-red-700" wire:click="removeItemFromCart({{$item['productID']}})"><span wire:loading.remove wire:target="removeItemFromCart({{$item['productID']}})">Remove</span><span wire:loading wire:target="removeItemFromCart({{$item['productID']}})">Removing...</span></button></td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="py-4 font-bold text-center">There Are No Items In Your Cart</td>
                  </tr>
                  @endforelse
                <!-- More product rows -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-lg font-semibold">Summary</h2>
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>{{Number::currency($grandTotal)}}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Taxes</span>
              <span>{{Number::currency($tax = $grandTotal*(rand(1,3)/1000))}}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Shipping</span>
              <span>{{Number::currency($shipping = (($items) ? rand(0,10) : 0))}}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Total</span>
              <span class="font-semibold">{{Number::currency($grandTotal+$tax+$shipping)}}</span>
            </div>
            @if ($items)
              <livewire:partials.primary-link-button :url="'/checkout'" :content="'Checkout'"/>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>