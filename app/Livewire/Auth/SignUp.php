<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SignUp extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function registerUser()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:8|max:255|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        if($user){
            $this->flash('success', 'Your account was successfully created', [
                'position' => 'top-start',
                'timer' => '2000',
                'toast' => true,
            ]);
            return redirect('/login');
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-up')
        ->title('Register: Flex E-Store');
    }
}
