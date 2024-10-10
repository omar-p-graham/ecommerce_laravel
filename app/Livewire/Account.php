<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Account extends Component
{
    use LivewireAlert;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function render()
    {
        $profile = Auth::user();
        return view('livewire.account',['profile'=>$profile])
        ->title('My Account: Flex E-Store');
    }

    public function updatePassword(){
        $this->validate([
            'current_password' => 'required|max:255',
            'password' => 'required|confirmed|max:255',
            'password_confirmation' => 'required',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->getAuthPassword())) {
            session()->flash('error','Current password is incorrect');
            return;
        }

        Auth::user()->fill([
            'password' => Hash::make($this->password)
        ])->save();

        $this->flash('success', 'Your password was successfully updated!!', [
            'position' => 'top-start',
            'timer' => '2000',
            'toast' => true,
        ]);
        return redirect('/profile');
    }
}
