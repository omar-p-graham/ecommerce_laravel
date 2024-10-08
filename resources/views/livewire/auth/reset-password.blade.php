<div class="grid w-full h-[80dvh] place-content-center">
    <div class="w-1/4 mx-auto overflow-hidden bg-white rounded-lg shadow-md min-w-96 dark:bg-gray-800">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="/images/arrow-circle.svg" alt="">
            </div>
    
            <h3 class="mt-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Reset Password</h3>
    
            <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Enter and confirm new password</p>
    
            <form wire:submit.prevent="resetPassword">
                @csrf
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password" aria-label="Password" id="password" wire:model="password"/>
                    @error('password')
                        <span class="">{{$message}}</span>
                    @enderror
                </div>
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password Confirmation" aria-label="Password Confirmation" id="password_confirmation" wire:model="password_confirmation"/>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="/login" wire:navigate class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500">Remember Password?</a>
                    <div class="">
                        <livewire:partials.primary-button :content="'Reset Password'" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>