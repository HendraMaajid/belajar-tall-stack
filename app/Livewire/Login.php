<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    #[Rule(['required', 'string',])]
    public string $password = '';
    public function login()
    { 
        if (Auth::attempt($this->validate())) {
            session()->flash('message', 'Login successful!');
            return redirect()->route('home');
        } else {
            $this->addError('email', 'The provided credentials do not match our records.');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
