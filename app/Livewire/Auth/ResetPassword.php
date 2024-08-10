<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;

class ResetPassword extends Component
{
    use LivewireAlert;

    #[Url]
    public $email;
    public $token;
    public $password;
    public $password_confirmation;

    public function resetPassword(){
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        $status = Password::reset(
            [
            'email' => $this->email,
            'token' => $this->token,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            ],
            function(User $user, string $password){
                $password = $this->password;
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if($status===Password::PASSWORD_RESET){
            $this->flash('success', 'Your password was successfully updated', [
                'position' => 'top-start',
                'timer' => '2000',
                'toast' => true,
            ]);
            return redirect('/login');
        }else{
            $this->flash('error', 'Something went wrong, link has expired.', [
                'position' => 'top-start',
                'timer' => '2000',
                'toast' => true,
            ]);
            return redirect(`/reset-password/$this->token?email=$this->email`);
        }
    }

    public function mount($token){
        $this->token = $token;
    }

    public function render()
    {
        return view('livewire.auth.reset-password')
        ->title('Password Reset: Flex E-Store');
    }
}
