<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function loginUser(){
        $this->validate([
            'email' => 'required|max:255|email|exists:users,email',
            'password' => 'required|max:255',
        ]);

        if (!auth()->attempt(['email'=>$this->email,'password'=>$this->password])) {
            session()->flash('error','Invalid Email or Password');
            return;
        }

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->title('Login: Flex E-Store');
    }
}
