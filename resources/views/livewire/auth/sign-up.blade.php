<div class="grid w-full h-[80dvh] place-content-center">
    <div class="w-1/4 mx-auto overflow-hidden rounded-lg shadow-md bg-lightest min-w-96 dark:bg-dark">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="/images/add_user.svg" alt="">
            </div>
    
            <h3 class="mt-3 text-xl font-medium text-center">Hi There</h3>
    
            <p class="mt-1 text-center">Create an account</p>
    
            <form wire:submit.prevent="registerUser">
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="text" placeholder="Full Name" aria-label="Full Name" id="name" wire:model="name"/>
                    @error('name')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

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
    
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 border rounded-lg bg-lightest dark:bg-dark" type="password" placeholder="Password Confirmation" aria-label="Password Confirmation" id="password_confirmation" wire:model="password_confirmation"/>
                </div>
    
                <div class="mt-4 text-center">
                    <x-primary-button type="submit">Create Account</x-primary-button>
                </div>
            </form>
        </div>
    
        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Already have an account? </span>
    
            <a href="/login" wire:navigate class="mx-2 text-sm font-bold hover:underline">Login</a>
        </div>
    </div>
    </div>