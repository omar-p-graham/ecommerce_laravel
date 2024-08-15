<nav x-data="{ isOpen: false }" class="relative shadow bg-lightest dark:bg-dark">
    <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <a href="/" wire:navigate>
                <img class="w-auto h-6 sm:h-7 drop-shadow-md" src="/images/logo.png" alt="">
            </a>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
            
                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-lightest dark:bg-dark md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center">
            <div class="flex flex-col md:flex-row md:mx-6">
                <x-menu-link>Home</x-menu-link>
                <x-menu-link href="/categories">Categories</x-menu-link>
                <x-menu-link href="/products">Shop</x-menu-link>
            </div>

            <div class="flex justify-center md:block">
                <x-menu-link href="/my-cart" class="relative">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.70711 15.2929C4.07714 15.9229 4.52331 17 5.41421 17H17M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM9 19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19C5 17.8954 5.89543 17 7 17C8.10457 17 9 17.8954 9 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span class="absolute top-0 p-1 text-xs rounded-full {{$cartItemsCount < 10 ? '-left-3':'-left-4'}} bg-brand text-lightest">{{$cartItemsCount}}</span>
                </x-menu-link>
            </div>
            
            @guest
                <div class="flex justify-center md:block md:mx-6">
                    <x-primary-link-button href="/login">Sign In</x-primary-link-button>
                </div>
            @endguest
            
            @auth
            <div x-data="{ isOpen: false }" class="relative inline-block mx-2 w-fit md:mx-6">
                <!-- Dropdown toggle button -->
                <button @click="isOpen = !isOpen" class="relative z-10 flex items-center justify-between p-2 text-gray-700 bg-white dark:text-white focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                    {{auth()->user()->name}}
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            
                <!-- Dropdown menu -->
                <div x-show="isOpen" 
                    @click.away="isOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90" 
                    class="absolute right-0 z-20 w-48 py-2 mt-2 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
                >
                    <a href="/my-orders" wire:navigate class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">My Orders</a>
                    <a href="/account" wire:navigate class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">My Account</a>
                    <a href="/logout" wire:navigate class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Sign Out</a>
                </div>
            </div>
            @endauth
            <span id="theme" class="block size-7">
                <img src="/images/moon.svg" alt="dark mode icon" class="p-1 border rounded-full cursor-pointer border-darkest dark:border-lightest dark:bg-lightest">
            </span>
        </div>
    </div>
</nav>

<script>
    let theme = document.getElementById('theme');
    let themeIcon = document.querySelector('#theme img');

    /*window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        themeIcon.setAttribute('src',event.matches ? "/images/sun.svg" : "/images/moon.svg");
    });

    // if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        //console.log(window.matchMedia('(prefers-color-scheme: dark)').matches);
    // }
    
    theme.addEventListener('click',function(){
        if(themeIcon.getAttribute('src')=='/images/moon.svg'){
            themeIcon.setAttribute('src','/images/sun.svg');
            document.documentElement.classList.add('dark');
            console.log('if: '+document.documentElement.classList.contains('dark'));
        }else{
            themeIcon.setAttribute('src','/images/moon.svg');
            document.documentElement.classList.remove('dark');
            console.log(document.documentElement.classList.contains('dark'));
        }
    });*/

    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark')
} else {
  document.documentElement.classList.remove('dark')
}

// Whenever the user explicitly chooses light mode
localStorage.theme = 'light'

// Whenever the user explicitly chooses dark mode
localStorage.theme = 'dark'

// Whenever the user explicitly chooses to respect the OS preference
localStorage.removeItem('theme')
</script>