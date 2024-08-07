<div class="relative flex w-full h-full">
    <livewire:partials.sidebar-filter />

    {{-- Products Start --}}
    <div class="w-full">
        <div class="container px-6 py-4 mx-auto">
            <div class="mb-2">
                <button type="button" id="filter-btn" class="inline-flex items-center px-6 py-2 font-medium tracking-wide text-gray-900 rounded-md shadow-sm bg-my_white ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg>
                      
                    Filter
                  </button>
            </div>
            <livewire:partials.main-heading :heading="'Products'"/>
            <div class="grid grid-cols-1 gap-6 py-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                <article class="flex flex-col items-center justify-center w-full max-w-sm mx-auto" wire:key="{{$product->id}}">
                    <a class="w-full h-64 bg-gray-300 bg-center bg-no-repeat bg-contain border rounded-lg shadow-md" style="background-image: url({{$product->images[0]}})" href="/product/{{$product->slug}}"></a>
                
                    <div class="w-56 -mt-10 overflow-hidden border rounded-lg shadow-lg bg-my_lt_grey md:w-64 dark:bg-my_dk_grey">
                        <h3 class="py-2 font-bold tracking-wide text-center uppercase text-my_black dark:text-my_white">{{$product->name}}</h3>
                
                        <div class="flex items-center justify-between px-3 py-2">
                            <span class="font-bold text-my_black dark:text-gray-200">{{Number::currency($product->price)}}</span>
                            <button class="px-2 py-1 text-xs font-semibold uppercase transition-colors duration-300 transform rounded bg-my_dk_grey text-my_white hover:bg-my_lt_grey hover:border hover:border-my_dk_grey hover:text-my_black dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">Add to cart</button>
                        </div>
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
