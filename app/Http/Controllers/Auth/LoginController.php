<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index():View
    {
        return view('auth.login');
    }

    public function auntificate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if(auth('web')->attempt($data)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->onlyInput('login')->withErrors([
            'login'=> 'Данные неверные или пользователь не найден'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
