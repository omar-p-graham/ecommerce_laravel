{{-- SideBar Start --}}
<div>
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
                        <input type="checkbox" class="w-4 h-4 mr-2" id="{{$category->slug}}" value="{{$category->id}}">
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
                        <input type="checkbox" class="w-4 h-4 mr-2" id="{{$brand->slug}}" value="{{$brand->id}}">
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
                    <input type="checkbox" class="w-4 h-4 mr-2" id="on_sale" value="">
                    <span class="text-lg">On Sale</span>
                </label>
            </li>
            <li class="mb-1">
                <label for="is_featured" class="flex items-center">
                    <input type="checkbox" class="w-4 h-4 mr-2" id="is_featured" value="">
                    <span class="text-lg">Is Featured</span>
                </label>
            </li>
        </ul>
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