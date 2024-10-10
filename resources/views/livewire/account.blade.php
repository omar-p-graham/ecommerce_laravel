<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <x-main-heading>My Account</x-main-heading>
    <div class="flex gap-2 p-5 mt-4 rounded shadow-lg bg-lightest dark:bg-dark">
        <div class="w-full px-3 py-4 rounded-sm lg:w-1/2 bg-light dark:bg-darkest">
            <h3 class="font-bold">My Information</h3>
            <div class="w-full mt-4">
                <label for="fullname">Full Name</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="text" aria-label="Full Name" id="fullname" value="{{$profile->name}}" disabled/>
            </div>
            <div class="w-full mt-4">
                <label for="fullname">Email Address</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="email" aria-label="Email Address" id="email" value="{{$profile->email}}" disabled/>
            </div>
            <div class="w-full mt-4">
                <label for="fullname">Account Created</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="text" aria-label="Account Created" id="created_date" value="{{$profile->created_at->format('F d, Y')}}" disabled/>
            </div>
        </div>
        <form wire:submit.prevent="updatePassword" class="w-full px-3 py-4 lg:w-1/2">
            <h3 class="font-bold">Reset Password</h3>
            <div class="w-full mt-4">
                <label for="fullname">Current Password</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="password" aria-label="Current Password" id="current_password" wire:model="current_password"/>
                @error('current_password')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="w-full mt-4">
                <label for="fullname">New Password</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="password" aria-label="New Password" id="password" wire:model="password"/>
                @error('password')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="w-full mt-4">
                <label for="fullname">Confirm Password</label>
                <input class="block w-full px-4 py-2 mt-2 border rounded-lg bg-lightest dark:bg-dark" type="password" aria-label="Confirm Password" id="password_confirmation" wire:model="password_confirmation"/>
                @error('password_confirmation')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            @if (Session::get('error'))
                <div class="p-4 mt-4 text-center bg-red-500 rounded bg-opacity-20">
                    <p class="text-sm font-bold text-red-500">{{Session::get('error')}}</p>
                </div>
            @endif
            <div class="w-full mt-4 text-end">
                <x-primary-button type="submit">Update Password</x-primary-button>
            </div>
        </form>
    </div>
</div>
