<div class="relative flex w-full">
    <livewire:partials.sidebar-filter />

    {{-- Products Start --}}
    <div class="absolute inset-0 w-full">
        <div class="container px-6 py-4 mx-auto">
            <div class="mb-2">
                <button type="button" id="filter-btn" class="inline-flex items-center px-6 py-2 font-medium tracking-wide text-gray-900 rounded-md shadow-sm bg-my_white ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg>
                      
                    Filter
                  </button>
            </div>
            <x-main-heading>Products</x-main-heading>
            <div class="w-full md:w-40">
                <label for="sortBy" class="block text-sm font-medium text-gray-900">Sort</label>
                <select name="sortBy" id="sortBy" class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm" wire:model.live="sortBy">
                    <option value="">Relevance</option>
                    <option value="latest">Latest</option>
                    <option value="name_asc">Name [A-Z]</option>
                    <option value="name_desc">Name [Z-A]</option>
                    <option value="price_asc">Price [0-9]</option>
                    <option value="price_desc">Price [9-0]</option>
                </select>
            </div>
            <div class="grid items-center justify-center grid-cols-1 gap-6 py-5 my-5 auto-rows-[1fr] sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <article class="flex flex-col items-center justify-center w-full h-full mx-auto" wire:key="{{$product->id}}">
                        <a class="w-full h-64 bg-center bg-no-repeat bg-contain border rounded-lg shadow-md bg-lightest" style="background-image: url({{$product->images[0]}})" href="/product/{{$product->slug}}"></a>
                    
                        <div class="w-56 -mt-10 overflow-hidden border rounded-lg shadow-lg bg-light md:w-64">
                            <h3 class="py-2 font-bold tracking-wide text-center uppercase text-darkest dark:text-lightest">{{$product->name}}</h3>
                    
                            <div class="flex items-center justify-between px-3 py-2">
                                <span class="font-bold text-my_black dark:text-gray-200">{{Number::currency($product->price)}}</span>
                                <button class="px-2 py-1 text-xs font-semibold uppercase transition-colors duration-300 transform rounded bg-mid focus:outline-none" wire:click="addToCart({{$product->id}})" wire:loading.remove wire:target="addToCart({{$product->id}})">Add to cart</button>
                            </div>
                            <span class="block mb-1 text-center" wire:loading wire:target="addToCart({{$product->id}})">Adding Item...</span>
                        </div>
                    </article>
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="flex justify-end mt-6">
              {{$products->links() }}
            </div>
        </div>
    </div>
    {{-- Products End --}}
</div>

<script>
    const filter_btn = document.getElementById('filter-btn');
    const filter_close_btn = document.getElementById('filter-close-btn');
    const filter_menu = document.getElementById('filter-menu');
    const filter_backdrop = document.getElementById('filter-backdrop');

    function close_menu(){
        filter_backdrop.classList.remove('inset-0');
        filter_backdrop.classList.add('left-0');
        filter_menu.classList.remove('left-0','opacity-100');
        filter_menu.classList.add('-left-72','opacity-0');
    }

    filter_btn.addEventListener('click', function(){
        filter_backdrop.classList.remove('left-0');
        filter_backdrop.classList.add('inset-0');
        filter_menu.classList.remove('-left-72','opacity-0');
        filter_menu.classList.add('left-0','opacity-100');
    });

    filter_close_btn.addEventListener('click', function(){close_menu();});
    filter_backdrop.addEventListener('click', function(){close_menu();});
</script>