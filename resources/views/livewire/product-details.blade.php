<div class="w-full py-10">
    <div class="container px-6 py-3 mx-auto md:py-8">
        <div class="grid grid-cols-1 gap-6 py-3 md:py-5 md:grid-cols-2">
            <div class="overflow-hidden border border-dark bg-lightest" x-data="{currentImg:'{{url('storage',$product->images[0])}}'}">
                <img x-bind:src="currentImg" alt="{{$product->name}}" class="object-contain w-full aspect-square">
                <div class="flex flex-wrap justify-end w-full h-24">
                  @foreach ($product->images as $image)
                    <div class="p-1 overflow-hidden border border-dark size-24" x-on:click="currentImg='{{url('storage',$image)}}'">
                      <img src="{{url('storage',$image)}}" alt="{{$product->name}}" class="object-fill w-full">
                    </div>
                  @endforeach
                </div>
            </div>
            <div class="p-4">
              <div class="space-y-3">
                <x-main-heading>{{$product->name}}</x-main-heading>
                {{-- Product Status --}}
                <div class="px-2 py-4">
                  <div class="flex flex-wrap items-center justify-center gap-4 px-2">
                    @if ($product->in_stock)
                      <span class="inline-flex items-center px-2 py-1 text-xs font-medium border rounded-md shadow bg-emerald-400 text-darkest border-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        In Stock
                      </span>
                    @endif
                    @if ($product->is_featured)
                      <span class="inline-flex items-center px-2 py-1 text-xs font-medium border rounded-md shadow bg-cyan-400 text-darkest border-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                        Featured
                      </span>
                    @endif
                    @if ($product->on_sale)
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-300 border rounded-md shadow text-darkest border-dark">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                      </svg>
                      On Sale
                    </span>
                    @endif
                  </div>
                  {{-- Details --}}
                  <div class="[&>ul]:list-disc">
                    <p class="my-1 mb-4 text-4xl font-bold"><span>{{Number::currency($product->price)}}</span></p>
                    <div>
                      <h3 class="mb-2 font-bold">Description:</h3>
                      @if ($product->description)
                        {!! Str::markdown($product->description) !!}
                      @endif
                    </div>
                    <div class="my-10">
                      <div class="w-full mb-4 md:w-60">
                        <livewire:partials.item-counter :quantity="$productQuantity"/>
                      </div>
                      <div class="w-full md:w-60">
                        <x-primary-button class="w-full">Add to Cart</x-primary-button> {{-- :productid="$product->id" wire:click="addToCart({{$productID}})" --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @if(!$related_products->isEmpty())
          <div class="flex items-center w-full mt-3 rounded-full">
            <div class="flex-1 border-b border-dark dark:border-mid"></div>
            <span class="px-8 py-1 text-lg font-semibold leading-8">Related Products</span>
            <div class="flex-1 border-b border-dark dark:border-mid"></div>
          </div>
          <div class="w-full">
            <div class="grid grid-cols-2 gap-4 mt-3 md:grid-cols-3 lg:grid-cols-5">
              @foreach ($related_products as $related_product)
                <a href="/product/{{$related_product->slug}}" class="flex flex-col justify-between text-center border w-36 rounded-xl md:p-5 md:w-60 bg-lightest" wire:key="{{$related_product->id}}">
                  <div class="flex items-center justify-center mx-auto overflow-hidden rounded-lg">
                    <img src="{{url('storage',$related_product->images[0])}}" alt="" class="object-contain w-full aspect-square">
                  </div>
                  <div class="mt-3">
                    <h3 class="text-sm font-semibold text-darkest sm:text-lg">
                      {{$related_product->name}}
                    </h3>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif
    </div>
</div>