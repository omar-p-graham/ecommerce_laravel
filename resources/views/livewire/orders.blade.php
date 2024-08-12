<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
    <div class="flex flex-col p-5 mt-4 bg-white rounded shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full text-center divide-y divide-gray-200 dark:divide-gray-700">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Order</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Date</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Order Status</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($orders as $order)
                  @php
                    $statusClass = "";
                    if ($order->status=="new") {
                      $statusClass = "bg-blue-300";
                    }elseif ($order->status=="processing") {
                      $statusClass = "bg-orange-400";
                    }elseif ($order->status=="shipped") {
                      $statusClass = "bg-green-300";
                    }elseif ($order->status=="delivered") {
                      $statusClass = "bg-green-700";
                    }elseif ($order->status=="canceled") {
                      $statusClass = "bg-red-500";
                    }

                    $paymentClass = "";
                    if ($order->payment_status=="pending") {
                      $paymentClass = "bg-orange-300";
                    }elseif ($order->payment_status=="paid") {
                      $paymentClass = "bg-green-500";
                    }elseif ($order->payment_status=="failed") {
                      $paymentClass = "bg-red-500";
                    }
                  @endphp
                  <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key="{{$order->id}}">
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-gray-200">{{$order->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">{{$order->created_at->format('Y-m-d')}}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 capitalize whitespace-nowrap dark:text-gray-200"><span class="px-3 py-1 text-white {{$statusClass}} rounded shadow">{{$order->status}}</span></td>
                    <td class="px-6 py-4 text-sm text-gray-800 capitalize whitespace-nowrap dark:text-gray-200"><span class="px-3 py-1 text-white {{$paymentClass}} rounded shadow">{{$order->payment_status}}</span></td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">{{Number::currency($order->cost)}}</td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                      <a href="/my-order/{{$order->id}}" class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-500">View Details</a>
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