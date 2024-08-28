<div class="">
{{-- Hero Section Start --}}
<section class="w-full h-96 md:h-[45rem]">
    <div class="xl:grid items-center justify-center grid-cols-1 xl:grid-cols-[1fr_2fr] relative">
        <div class="h-96 md:h-[45rem] mx-auto text-center grid place-items-center absolute xl:relative inset-0 z-10">
          <div class="">
            <h1 class="text-3xl font-semibold text-dark dark:text-light lg:text-4xl">Shop at <span class="text-brand">Flex E-Store</span> for the cheapest and most exclusive products.</h1>
            <div class="py-3 mt-6">
              <x-primary-link-button href="/products">Start Shopping</x-primary-link-button>
            </div>
          </div>
        </div>
        <div class="h-96 md:h-[45rem] absolute xl:relative inset-0" id="banner"></div>
    </div>
</section>
  {{-- Hero Section End --}}

{{-- Brands Section Start --}}
<section class="w-full px-4 md:px-6 lg:px-8">
  <div class="container relative px-4 py-6 mx-auto overflow-hidden md:py-10">
    <x-main-heading>Top Brands</x-main-heading>
    <div class="grid items-center justify-center grid-cols-2 md:gap-5 gap-3 py-2 md:justify-between md:grid-cols-4 xl:grid-cols-8 auto-rows-[1fr]">
      @foreach ($brands as $brand)
        <a href="/products?filterBrands[0]={{$brand->id}}" wire:navigate class="w-full h-full my-1 rounded-lg shadow-md md:w-36 lg:w-40 xl:w-44 bg-lightest dark:bg-dark" wire:key="{{$brand->id}}">
          <div class="rounded-t-lg bg-lightest dark:shadow-xl dark:shadow-darkest">
            <img src="{{url('storage', $brand->image)}}" alt="{{$brand->name}}" class="object-contain w-full rounded-t-lg md:h-20 aspect-video">
          </div>
          <div class="p-5 text-center">
            <p class="text-2xl font-bold tracking-tight">{{$brand->name}}</p>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
{{-- Brands Section End --}}
  
  {{-- Featured Section Start --}}
<section class="w-full px-4 md:px-6 lg:px-8 bg-dark dark:bg-darkest">
    <div class="container py-5 mx-auto">
      <x-main-heading class="text-lightest">Featured Products</x-main-heading>
      <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($featureds as $featured)
          <a href="/product/{{$featured->slug}}" class="flex flex-col justify-between text-center border border-dark rounded-xl md:p-5 dark:border-light bg-lightest dark:bg-dark" wire:key="{{$featured->id}}">
            <div class="flex items-center justify-center mx-auto overflow-hidden rounded-lg bg-lightest">
              <img src="{{url('storage',$featured->images[0])}}" alt="" class="object-contain w-full aspect-square">
            </div>
            <div class="mt-3">
              <h3 class="text-sm font-semibold sm:text-lg">
                {{$featured->name}}
              </h3>
            </div>
          </a>
        @endforeach
      </div>
    </div>
</section>
  {{-- Featured Section End --}}

  {{-- Testimonials Section Start --}}
<section class="w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <div class="container mx-auto">  
    <x-main-heading>What customers are saying</x-main-heading>
    <!-- Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      
      <!-- Card -->
      <div class="flex flex-col border border-gray-200 shadow-sm bg-lightest rounded-xl dark:bg-dark">
        <div class="flex-auto p-4 md:p-6">
          <x-rating rating="5"/>
          <p class="mt-3 text-base text-darkest sm:mt-6 md:text-xl dark:text-lightest"><em>
            "I'm absolutely floored by the level of care and attention to detail the team at Flex E-Store have put into their customer service and for one can guarantee that I will be a return customer."
          </em></p>
        </div>
        <div class="p-4 rounded-b-xl md:px-6">
          <h3 class="text-sm font-semibold text-dark sm:text-base dark:text-light">
            Nicole Green
          </h3>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col border border-gray-200 shadow-sm bg-lightest rounded-xl dark:bg-dark">
        <div class="flex-auto p-4 md:p-6">
          <x-rating rating="3"/>
          <p class="mt-3 text-base text-darkest sm:mt-6 md:text-xl dark:text-lightest"><em>
            "With Flex E-Store, we're able to easily track our orders in full detail. It's become an essential place for us to get anything that we want."
          </em></p>
        </div>
        <div class="p-4 rounded-b-xl md:px-6">
          <h3 class="text-sm font-semibold text-dark sm:text-base dark:text-light">
            Leroy Tyson
          </h3>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col border border-gray-200 shadow-sm bg-lightest rounded-xl dark:bg-dark">
        <div class="flex-auto p-4 md:p-6">
          <x-rating rating="4"/>
          <p class="mt-3 text-base text-darkest sm:mt-6 md:text-xl dark:text-lightest"><em>
            "I have been using this store for 2 years. I went through multiple updates and changes and I'm very glad to see the consistency and effort made by the team."
          </em></p>
        </div>
        <div class="p-4 rounded-b-xl md:px-6">
          <h3 class="text-sm font-semibold text-dark sm:text-base dark:text-light">
            Brandon Luiz
          </h3>
        </div>
      </div>
      <!-- End Card -->
    </div>
    </div>
    <!-- End Grid -->
  </section>
  {{-- Testimonials Section End --}}
</div>

<script>
  //console.log(document.documentElement.getAttribute('class'));
  var banner = document.getElementById('banner');
  var images = [
      'https://images.unsplash.com/photo-1522115174737-2497162f69ec?q=80&w=2669&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
      'https://images.unsplash.com/photo-1486401899868-0e435ed85128?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
      'https://images.unsplash.com/photo-1458538977777-0549b2370168?q=80&w=2374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
      'https://images.unsplash.com/flagged/photo-1556637640-2c80d3201be8?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
      'https://images.unsplash.com/photo-1622866027662-14e3c5ee67e7?q=80&w=2456&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
      ]
  var count = 0;
  var currentTheme = [232,237,242];

  currentTheme = (localStorage.theme === 'dark') ? [17,24,39] : [232,237,242];
  
  banner.setAttribute("style",`background: linear-gradient(to right, rgba(${currentTheme[0]},${currentTheme[1]},${currentTheme[2]},1) 20%,rgba(0,0,0,0.1)), url(${images[0]}) no-repeat center center / cover`);
  banner.setAttribute("style",`background: -webkit-gradient(linear, left top, right top, from(rgba(${currentTheme[0]},${currentTheme[1]},${currentTheme[2]},1)),to(rgba(0,0,0,0.1))), url(${images[0]}) no-repeat center center / cover`);
  
  setInterval(() => {
    currentTheme = (localStorage.theme === 'dark') ? [17,24,39] : [232,237,242];
    count++;
    if(count==images.length){count = 0;}
    banner.setAttribute("style",`background: linear-gradient(to right, rgba(${currentTheme[0]},${currentTheme[1]},${currentTheme[2]},1) 20%,rgba(0,0,0,0.1)), url(${images[count]}) no-repeat center center / cover`);
    banner.setAttribute("style",`background: -webkit-gradient(linear, left top, right top, from(rgba(${currentTheme[0]},${currentTheme[1]},${currentTheme[2]},1)),to(rgba(0,0,0,0.1))), url(${images[count]}) no-repeat center center / cover`);
  }, 3000);
</script>