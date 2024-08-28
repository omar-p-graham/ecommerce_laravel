<div class="w-full">
    <div class="container px-6 py-4 mx-auto">
        <x-main-heading>Categories</x-main-heading>
        <div class="grid items-center justify-center grid-cols-1 gap-6 py-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($categories as $category)
                <div class="w-full overflow-hidden rounded-lg shadow-md bg-lightest hover:shadow-lg dark:bg-dark" wire:key="{{$category->id}}">
                    <img class="object-cover w-full h-56" src="{{$category->image}}" alt="{{$category->name}}">

                    <div class="py-5">
                        <a href="/products?filterCategories[0]={{$category->id}}" class="flex items-center justify-around text-xl font-bold text-gray-800 dark:text-white" tabindex="0" role="link" wire:navigate>
                            {{$category->name}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>