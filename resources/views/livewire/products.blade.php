<div class="px-4 md:px-6 lg:px-8">
    <div id="backdrop" class="fixed inset-0 z-30 hidden bg-opacity-50 bg-dark"></div>
    <aside id="drawer" class="fixed inset-y-0 left-0 z-30 overflow-y-auto transition-transform transform -translate-x-full w-72 bg-lightest dark:bg-dark">
        <div class="p-4">
            <div class="flex justify-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="rounded-full shadow-lg cursor-pointer shadow-dark dark:shadow-mid dark:shadow size-6" id="closeDrawer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>              
            </div>
            <h2 class="text-xl font-bold text-center">Products Filter</h2>
            <div class="mt-4">
                <details class="bg-gradient-to-b from-light to-mid dark:bg-darkest dark:bg-none">
                    <summary class="px-2 py-1 border rounded-t cursor-pointer">Categories</summary>
                    <ul class="px-2 py-1 border rounded-b">
                        @foreach ($categories as $category)
                            <li class="mb-1" wire:key="{{$category->id}}">
                                <label for="{{$category->slug}}" class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 mr-2 filter-option" id="{{$category->slug}}" value="{{$category->id}}" wire:model="filterCategories">
                                    <span class="text-lg">{{$category->name}}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </details>
            </div>
            <div class="mt-4">
                <details class="bg-gradient-to-b from-light to-mid dark:bg-darkest dark:bg-none">
                    <summary class="px-2 py-1 border rounded-t cursor-pointer">Brands</summary>
                    <ul class="px-2 py-1 border rounded-b">
                        @foreach ($brands as $brand)
                            <li class="mb-1" wire:key="{{$brand->id}}">
                                <label for="{{$brand->slug}}" class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 mr-2 filter-option" id="{{$brand->slug}}" value="{{$brand->id}}" wire:model="filterBrands">
                                    <span class="text-lg">{{$brand->name}}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </details>
            </div>
            <div class="mt-4">
                <details class="bg-gradient-to-b from-light to-mid dark:bg-darkest dark:bg-none">
                    <summary class="px-2 py-1 border rounded-t cursor-pointer">Status</summary>
                    <ul class="px-2 py-1 border rounded-b">
                        <li class="mb-1">
                            <label for="on_sale" class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 mr-2 filter-option" id="on_sale" value="1" wire:model="filterOnSale">
                                <span class="text-lg">On Sale</span>
                            </label>
                        </li>
                        <li class="mb-1">
                            <label for="is_featured" class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 mr-2 filter-option" id="is_featured" value="1" wire:model="filterIsFeatured">
                                <span class="text-lg">Is Featured</span>
                            </label>
                        </li>
                    </ul>
                </details>
            </div>
            <div class="mt-4">
                <details class="bg-gradient-to-b from-light to-mid dark:bg-darkest dark:bg-none">
                    <summary class="px-2 py-1 border rounded-t cursor-pointer">Price Range</summary>
                    <div class="px-2 py-1 border rounded-b">
                        <label for="min_price" class="block px-3 py-2 mb-1 overflow-hidden border rounded-md shadow-sm border-mid ">
                          <span class="text-xs font-medium">Min. Price</span>
                          <input type="number" id="min_price" min="0" step="100" placeholder="Min. Price" class="w-full px-2 py-1 mt-1 border-none sm:text-sm text-darkest" wire:model="filterMinPrice"/>
                        </label>
                        <label for="max_price" class="block px-3 py-2 overflow-hidden border rounded-md shadow-sm border-mid ">
                          <span class="text-xs font-medium">Max. Price</span>
                          <input type="number" id="max_price" min="100" step="100" placeholder="Max. Price" class="w-full p-0 px-2 mt-1 border-none sm:text-sm text-darkest" wire:model="filterMaxPrice"/>
                        </label>
                      </div>
                </details>
            </div>
            <div class="p-4 mt-10">
                <x-secondary_button wire:click="filter_products" class="block w-full">Apply Filters</x-secondary_button>
                <a href="/products" class="block w-full mt-5 text-center hover:underline" wire:navigate>Clear Filter</a>
            </div>
        </div>
    </aside>
    <div class="container py-5 mx-auto">
        <x-main-heading>Products</x-main-heading>
        <div class="inline-flex items-center justify-between w-full">
            <div class="">
                <x-secondary-button id="openDrawer" class="inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filter
                </x-secondary-button>
            </div>
            <div class="flex items-center px-2 w-fit">
                <label for="sortBy" class="block font-medium sm:text-sm">Sort</label>
                <select name="sortBy" id="sortBy" class="w-full px-2 py-3 mx-2 border rounded-lg bg-lightest dark:bg-dark sm:text-sm border-mid" wire:model.live="sortBy">
                    <option value="">Relevance</option>
                    <option value="latest">Latest</option>
                    <option value="name_asc">Name [A-Z]</option>
                    <option value="name_desc">Name [Z-A]</option>
                    <option value="price_asc">Price [0-9]</option>
                    <option value="price_desc">Price [9-0]</option>
                </select>
            </div>
        </div>
        <div class="grid items-center grid-flow-row justify-center grid-cols-1 gap-6 py-5 my-5 auto-rows-[1fr] sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <article class="overflow-hidden border rounded-lg shadow-lg dark:shadow-mid dark:shadow bg-lightest dark:bg-dark border-mid dark:border-dark" wire:key="{{$product->id}}">
                    <div class="px-4 py-2 bg-lightest dark:text-dark">
                        <h1 class="text-sm font-bold uppercase truncate" title="{{$product->name}}">{{$product->name}}</h1>
                    </div>
                    <a href="/product/{{$product->slug}}" class="w-full h-full">
                        <img class="object-contain w-full h-48 bg-lightest aspect-video" src="{{url('storage',$product->images[0])}}" alt="{{$product->name}}">
                    </a>
                    <div class="flex items-center justify-between w-full p-2 mt-1 bg-gradient-to-b from-lightest to-mid dark:from-dark dark:to-darkest">
                        <h1 class="flex items-center text-lg font-bold {{$product->on_sale ? 'text-green-700 dark:text-emerald-400' : ''}}">
                            {{$product->on_sale ? Number::currency($product->price - ($product->price * ($product->sale_discount/100))) : Number::currency($product->price)}}
                            @if ($product->on_sale)
                                <span class="ml-2 text-xs text-red-500 line-through">{{Number::currency($product->price)}}</span>
                            @endif
                        </h1>
                        <button class="px-2 py-1 text-xs font-semibold uppercase transition-colors duration-300 transform border rounded shadow border-mid hover:bg-mid dark:hover:bg-darkest focus:bg-gray-400 focus:outline-none" wire:click="addToCart({{$product->id}})" wire:loading.remove wire:target="addToCart({{$product->id}})">
                            <span wire:loading.remove wire:target="addToCart({{$product->id}})">Add to cart</span>
                            <span wire:loading wire:target="addToCart({{$product->id}})">Adding Item...</span>
                        </button>
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

<script>
    document.getElementById('openDrawer').addEventListener('click', function() {
        document.getElementById('drawer').classList.remove('-translate-x-full');
        document.getElementById('backdrop').classList.remove('hidden');
    });

    document.getElementById('closeDrawer').addEventListener('click', function() {
        document.getElementById('drawer').classList.add('-translate-x-full');
        document.getElementById('backdrop').classList.add('hidden');
    });

    document.getElementById('backdrop').addEventListener('click', function() {
        document.getElementById('drawer').classList.add('-translate-x-full');
        document.getElementById('backdrop').classList.add('hidden');
    });
</script>
