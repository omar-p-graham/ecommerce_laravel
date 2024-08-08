{{-- SideBar Start --}}
<div class="h-dvh">
<div class="absolute left-0 z-20 transition-all opacity-50 bg-my_white h-dvh" id="filter-backdrop">
</div>
<aside class="absolute top-0 bottom-0 z-50 flex flex-col justify-start transition-all opacity-0 bg-my_white border-e h-dvh w-72 -left-72" id="filter-menu">
    <div class="flex justify-end">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shadow-lg cursor-pointer size-6" id="filter-close-btn">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>              
    </div>
    <div class="block w-full">
        {{-- Categories --}}
      <div class="p-4 mb-5 bg-my_lt_grey">
        <h2 class="underline">Categories</h2>
        <ul>
            @foreach ($categories as $category)
                <li class="mb-1" wire:key="{{$category->id}}">
                    <label for="{{$category->slug}}" class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 mr-2" id="{{$category->slug}}" value="{{$category->id}}" wire:model="filterCategories">
                        <span class="text-lg">{{$category->name}}</span>
                    </label>
                </li>
            @endforeach
        </ul>
      </div>
      {{-- Brands --}}
      <div class="p-4 mb-5 bg-my_lt_grey">
        <h2 class="underline">Brands</h2>
        <ul>
            @foreach ($brands as $brand)
                <li class="mb-1" wire:key="{{$brand->id}}">
                    <label for="{{$brand->slug}}" class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 mr-2" id="{{$brand->slug}}" value="{{$brand->id}}" wire:model="filterBrands">
                        <span class="text-lg">{{$brand->name}}</span>
                    </label>
                </li>
            @endforeach
        </ul>
      </div>
      {{-- Product Status --}}
      <div class="p-4 mb-5 bg-my_lt_grey">
        <h2 class="underline">Status</h2>
        <ul>
            <li class="mb-1">
                <label for="on_sale" class="flex items-center">
                    <input type="checkbox" class="w-4 h-4 mr-2" id="on_sale" value="1" wire:model="filterOnSale">
                    <span class="text-lg">On Sale</span>
                </label>
            </li>
            <li class="mb-1">
                <label for="is_featured" class="flex items-center">
                    <input type="checkbox" class="w-4 h-4 mr-2" id="is_featured" value="1" wire:model="filterIsFeatured">
                    <span class="text-lg">Is Featured</span>
                </label>
            </li>
        </ul>
      </div>
      {{-- Price Range --}}
      <div class="p-4 mb-5 bg-my_lt_grey">
        <h2 class="underline">Price Range</h2>
        <div class="">
          <label for="min_price" class="block px-3 py-2 mb-1 overflow-hidden border border-gray-200 rounded-md shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
            <span class="text-xs font-medium text-gray-700">Min. Price</span>
            <input type="number" id="min_price" min="0" step="100" placeholder="Min. Price" class="w-full p-0 mt-1 border-none focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" wire:model="filterMinPrice"/>
          </label>
          <label for="max_price" class="block px-3 py-2 overflow-hidden border border-gray-200 rounded-md shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
            <span class="text-xs font-medium text-gray-700">Max. Price</span>
            <input type="number" id="max_price" min="100" step="100" placeholder="Max. Price" class="w-full p-0 mt-1 border-none focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" wire:model="filterMaxPrice"/>
          </label>
        </div>
      </div>
      <div class="p-4 mb-5">
        <button type="button" wire:click="applyFilters">Apply Filters</button>
      </div>
    </div>
  
    <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
      <a href="#" class="flex items-center gap-2 p-4 bg-my_white hover:bg-gray-50">
        <img
          alt=""
          src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
          class="object-cover rounded-full size-10"
        />
  
        <div>
          <p class="text-xs">
            <strong class="block font-medium">Eric Frusciante</strong>
  
            <span> eric@frusciante.com </span>
          </p>
        </div>
      </a>
    </div>
</aside>
</div>
{{-- SideBar End --}}