<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ForgotPassword extends Component
{
    use LivewireAlert;

    public $email;

    public function forgotPassword(){
        $this->validate([
            'email' => 'required|max:255|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(['email'=>$this->email]);

        if($status===Password::RESET_LINK_SENT){
            $this->alert('success', 'Password reset link was sent to your email. If not seen, check the Junk/Spam email folder', [
                'position' => 'top-start',
                'timer' => '2500',
                'toast' => true,
            ]);
            $this->email = "";
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')
        ->title('Forget Password: Flex E-Store');
    }
}
