<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <x-main-heading>Order Details</x-main-heading>
    <div class="my-5">
      <x-secondary-link-button href="/my-orders">Back To Orders</x-secondary-link-button>
    </div>
    <!-- Grid -->
    <div class="grid gap-4 mt-5 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
      <!-- Card -->
      <div class="flex flex-col shadow-sm bg-lightest rounded-xl dark:bg-dark">
        <div class="flex p-4 md:p-5 gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[60px] rounded-lg">
            <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center justify-center gap-x-2">
              <p class="text-xs tracking-wide uppercase">Customer</p>
            </div>
            <div class="flex items-center justify-center mt-1 gap-x-2">
              <div>{{$order->user->name}}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col shadow-sm bg-lightest dark:bg-dark rounded-xl">
        <div class="flex p-4 md:p-5 gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[60px] rounded-lg">
            <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 22h14" />
              <path d="M5 2h14" />
              <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
              <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center justify-center gap-x-2">
              <p class="text-xs tracking-wide uppercase">Order Date</p>
            </div>
            <div class="flex items-center justify-center mt-1 gap-x-2">
              <div>{{$order->created_at->format('F d, Y')}}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col shadow-sm bg-lightest dark:bg-dark rounded-xl">
        <div class="flex p-4 md:p-5 gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[60px] rounded-lg">
            <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
              <path d="m12 12 4 10 1.7-4.3L22 16Z" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center justify-center gap-x-2">
              <p class="text-xs tracking-wide uppercase">Order Status</p>
            </div>
            @php
              $statusClass = "";
              if ($order->status=="new") {
                $statusClass = "bg-cyan-400";
              }elseif ($order->status=="processing") {
                $statusClass = "bg-blue-500 text-lightest";
              }elseif ($order->status=="shipped") {
                $statusClass = "bg-emerald-400";
              }elseif ($order->status=="delivered") {
                $statusClass = "bg-green-700 text-lightest";
              }elseif ($order->status=="canceled") {
                $statusClass = "bg-red-500 text-lightest";
              }
            @endphp
            <div class="flex items-center justify-center mt-1 gap-x-2">
              <span class="px-3 py-1 capitalize rounded shadow {{$statusClass}} w-full text-center">{{$order->status}}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col shadow-sm bg-lightest dark:bg-dark rounded-xl">
        <div class="flex p-4 md:p-5 gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[60px] rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
            </svg>            
          </div>
  
          <div class="grow">
            <div class="flex items-center justify-center gap-x-2">
              <p class="text-xs tracking-wide uppercase">Payment Status</p>
            </div>
            @php
              $paymentClass = "";
              if ($order->payment_status=="pending") {
                $paymentClass = "bg-orange-500";
              }elseif ($order->payment_status=="paid") {
                $paymentClass = "bg-green-700 text-lightest";
              }elseif ($order->payment_status=="failed") {
                $paymentClass = "bg-red-500 text-lightest";
              }
            @endphp
            <div class="flex items-center justify-center mt-1 gap-x-2">
              <span class="px-3 py-1 capitalize rounded shadow text-center w-full {{$paymentClass}}">{{$order->payment_status}}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
    </div>
    <!-- End Grid -->
  
    <div class="flex flex-col gap-4 mt-4 md:flex-row">
      <div class="md:w-3/4">
        <div class="p-6 mb-4 overflow-x-auto rounded-lg shadow-md bg-lightest dark:bg-dark">
          <table class="w-full">
            <thead>
              <tr class="text-center bg-mid dark:bg-darkest">
                <th class="px-6 py-3 text-xs font-medium text-left uppercase rounded-l-md">Product</th>
                <th class="px-6 py-3 text-xs font-medium uppercase">Price</th>
                <th class="px-6 py-3 text-xs font-medium uppercase">Quantity</th>
                <th class="px-6 py-3 text-xs font-medium uppercase rounded-r-md">Total</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-mid">
              @php
                $total_discount = 0;
                $sub_total = 0;
              @endphp
              @foreach ($order->items as $item)
                @php
                  $total_discount += $item->unit_discount * $item->quantity;
                  $sub_total += $item->unit_amount * $item->quantity;
                @endphp
                <tr class="text-center" wire:key="{{$item->id}}">
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="w-16 h-16 mr-4" src="{{url('storage',$item->product->images[0])}}" alt="{{$item->product->name}}">
                      <span class="font-semibold truncate">{{$item->product->name}}</span>
                    </div>
                  </td>
                  <td>
                    <div class="flex items-center py-4 justify-center {{$item->unit_discount>0 ? 'text-green-700 dark:text-emerald-400' : ''}}">
                      {{Number::currency($item->unit_amount - $item->unit_discount)}}
                      @if ($item['unit_discount'] > 0)
                        <span class="ml-2 text-xs text-red-500 line-through dark:font-semibold">{{Number::currency($item->unit_amount)}}</span>
                      @endif
                    </div>
                  </td>
                  <td class="py-4">
                    <span class="w-8 text-center">{{$item->quantity}}</span>
                  </td>
                  {{-- <td class="py-4">{{Number::currency($item->total_amount)}}</td> --}}
                  <td>
                    <div class="flex items-center py-4 justify-center {{$item->unit_discount>0 ? 'text-green-700 dark:text-emerald-400' : ''}}">
                      {{Number::currency($item->total_amount)}}
                      @if ($item['unit_discount'] > 0)
                        <span class="ml-2 text-xs text-red-500 line-through dark:font-semibold">{{Number::currency($item->unit_amount*$item->quantity)}}</span>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  
        <div class="p-6 mb-4 overflow-x-auto rounded-lg shadow-md bg-lightest dark:bg-dark">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="mb-3 font-bold font-3xl">Shipping Address</h1>
              <p>{{$order->address->street_address}}, {{$order->address->city}}, {{$order->address->state}}, {{$order->address->zip_code}}</p>
            </div>
            <div class="text-center">
              <h1 class="mb-3 font-bold font-3xl">Phone</h1>
              <p>{{$order->address->phone}}</p>
            </div>
          </div>
        </div>
  
      </div>
      <div class="md:w-1/4">
        <div class="p-6 rounded-lg shadow-md bg-lightest dark:bg-dark">
          <h2 class="mb-4 text-lg font-semibold">Summary</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>{{Number::currency($sub_total)}}</span>
          </div>
          @if ($order->items()->sum('unit_discount')>0)
            <div class="flex justify-between mb-2">
              <span>Discount</span>
              <span>-{{Number::currency($total_discount)}}</span>
            </div> 
          @endif
          <div class="flex justify-between mb-2">
            <span>Shipping</span>
            <span>Free</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Grand Total</span>
            <span class="font-semibold">{{Number::currency($order->cost)}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>