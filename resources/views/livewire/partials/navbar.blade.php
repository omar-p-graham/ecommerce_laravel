<nav x-data="{ isOpen: false }" class="relative shadow bg-my_white dark:bg-my_dk_grey">
    <div class="container flex justify-end px-4 py-1 mx-auto md:px-8">
        <span id="theme" class="size-8">
            <img src="/images/moon.svg" alt="dark mode icon" class="cursor-pointer">
        </span>
    </div>
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
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-my_white dark:bg-gray-800 md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center">
            <div class="flex flex-col md:flex-row md:mx-6">
                <a class="my-2 transition-colors duration-300 transform hover:text-my_lt_orange dark:hover:text-my_dk_orange md:mx-4 md:my-0 {{request()->is('/') ? 'text-my_dk_orange font-bold underline' : 'text-my_black dark:text-my_white'}}" wire:navigate href="/">Home</a>
                <a class="my-2 transition-colors duration-300 transform hover:text-my_lt_orange dark:hover:text-my_dk_orange md:mx-4 md:my-0 {{request()->is('categories') ? 'text-my_dk_orange font-bold underline' : 'text-my_black dark:text-my_white'}}" wire:navigate href="/categories">Categories</a>
                <a class="my-2 transition-colors duration-300 transform hover:text-my_lt_orange dark:hover:text-my_dk_orange md:mx-4 md:my-0 {{request()->is('products') ? 'text-my_dk_orange font-bold underline' : 'text-my_black dark:text-my_white'}}" wire:navigate href="/products">Shop</a>
                <a class="my-2 transition-colors duration-300 transform hover:text-my_lt_orange dark:hover:text-my_dk_orange md:mx-4 md:my-0" wire:navigate href="#">About</a>
            </div>

            <div class="flex justify-center md:block">
                <a class="relative transition-colors duration-300 transform hover:text-gray-600 dark:hover:text-gray-300 {{request()->is('my-cart') ? 'text-my_dk_orange font-bold underline' : 'text-my_black dark:text-my_white'}}" wire:navigate href="/my-cart">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.70711 15.2929C4.07714 15.9229 4.52331 17 5.41421 17H17M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM9 19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19C5 17.8954 5.89543 17 7 17C8.10457 17 9 17.8954 9 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span class="absolute top-0 left-0 p-1 text-xs rounded-full bg-my_lt_orange text-my_white"></span>
                </a>
            </div>
            <div class="flex justify-center md:block md:ml-6">
                <livewire:partials.primary-link-button :url="'/login'" :content="'Sign In'"/>
            </div>
            <span id="theme" class="border rounded size-8">
                <img src="/images/moon.svg" alt="dark mode icon" class="object-cover cursor-pointer">
            </span>
        </div>
    </div>
</nav>

<script>
    let theme = document.getElementById('theme');
    let themeIcon = document.querySelector('#theme img');
    
    theme.addEventListener('click',function(){
        if(themeIcon.getAttribute('src')=='/images/moon.svg'){
            themeIcon.setAttribute('src','/images/sun.svg');
            document.documentElement.classList.add('dark');
            return;
        }
        themeIcon.setAttribute('src','/images/moon.svg');
        document.documentElement.classList.remove('dark');
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        themeIcon.setAttribute('src',event.matches ? "/images/sun.svg" : "/images/moon.svg");
    });
</script>