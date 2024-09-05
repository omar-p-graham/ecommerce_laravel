<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <x-main-heading>My Orders</x-main-heading>
    <div class="flex flex-col p-5 mt-4 rounded shadow-lg bg-lightest dark:bg-dark">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full text-center divide-y divide-mid">
              <thead>
                <tr class="bg-mid dark:bg-darkest">
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase rounded-tl-xl">Order</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase">Date</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase">Order Status</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase">Payment Status</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase">Order Amount</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium uppercase rounded-tr-xl">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($orders as $order)
                  @php
                    $statusClass = "";
                    if ($order->status=="new") {
                      $statusClass = "bg-cyan-400";
                    }elseif ($order->status=="processing") {
                      $statusClass = "bg-blue-500";
                    }elseif ($order->status=="shipped") {
                      $statusClass = "bg-emerald-400";
                    }elseif ($order->status=="delivered") {
                      $statusClass = "bg-green-700";
                    }elseif ($order->status=="canceled") {
                      $statusClass = "bg-red-500";
                    }

                    $paymentClass = "";
                    if ($order->payment_status=="pending") {
                      $paymentClass = "bg-orange-500";
                    }elseif ($order->payment_status=="paid") {
                      $paymentClass = "bg-green-700 text-lightest";
                    }elseif ($order->payment_status=="failed") {
                      $paymentClass = "bg-red-500";
                    }
                  @endphp
                  <tr class="odd:bg-lightest even:bg-light dark:odd:bg-dark dark:even:bg-darkest" wire:key="{{$order->id}}">
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">{{$order->id}}</td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap">{{$order->created_at->format('Y-m-d')}}</td>
                    <td class="px-6 py-4 text-sm capitalize whitespace-nowrap"><span class="px-3 py-1 {{$statusClass}} rounded shadow border">{{$order->status}}</span></td>
                    <td class="px-6 py-4 text-sm capitalize whitespace-nowrap"><span class="px-3 py-1 {{$paymentClass}} rounded shadow border">{{$order->payment_status}}</span></td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap">{{Number::currency($order->cost)}}</td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                      <x-primary-link-button href="/my-order/{{$order->id}}">View Details</x-primary-link-button>
                    </td>
                  </tr> 
                @empty
                  <tr>
                    <td colspan="6" class="text-4xl font-bold text-center">You Have Not Made Any Orders</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="">
            {{$orders->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>