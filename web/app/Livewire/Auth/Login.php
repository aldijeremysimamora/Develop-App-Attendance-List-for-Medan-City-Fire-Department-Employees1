<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $nip;
    public $password;

    protected $rules = [
        'nip' => 'required|string',
        'password' => 'required|string',
    ];

    public function render()
    {
        return view('auth.login')->title("Login");
    }

    public function login()
    {
        $this->validate([
            'nip' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $this->resetErrorBag();

        $user = User::where('nip', $this->nip)->first();

        if (!$user) {
            $this->addError('nip', 'NIP yang anda input tidak terdaftar.');
            return;
        }

        if ($user->role != 'admin') {
            $this->addError('nip', 'Hanya admin yang bisa login.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password yang anda input tidak sesuai.');
            return;
        }

        if (Auth::attempt(['nip' => $this->nip, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
