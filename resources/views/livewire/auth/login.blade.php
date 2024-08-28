<div class="grid w-full h-[80dvh] place-content-center">
    <div class="w-1/4 mx-auto overflow-hidden rounded-lg shadow-md bg-lightest min-w-96 dark:bg-dark">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="/images/lock.svg" alt="">
            </div>

            <h3 class="mt-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Welcome Back</h3>

            <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Login or create account</p>

            <form wire:submit.prevent="loginUser">
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="email" placeholder="Email Address" aria-label="Email Address" id="email" wire:model="email"/>
                    @error('email')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="password" placeholder="Password" aria-label="Password" id="password" wire:model="password"/>
                    @error('password')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
                @if (Session::has('error'))
                    <div class="flex w-full max-w-sm overflow-hidden rounded-lg shadow-md bg-lightest dark:bg-dark">
                        <div class="flex items-center justify-center w-12 bg-red-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
                            </svg>
                        </div>
                    
                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                                <span class="font-semibold text-red-500 dark:text-red-400">Error</span>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    {{Session::get('error')}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-between mt-4">
                    <a href="/forgot-password" wire:navigate class="text-sm hover:font-semibold">Forgot Password?</a>
                    <div class="">
                        <x-primary-button type="submit">Sign In</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Don't have an account? </span>

            <a href="/sign-up" wire:navigate class="mx-2 text-sm font-bold hover:underline">Register</a>
        </div>
    </div>
</div>