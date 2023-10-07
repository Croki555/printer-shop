<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = $request->validate([
            'login'=> ['exclude_if:email,null', 'unique:users,login'],
            'email'=> ['exclude_if:login,null', 'unique:' . User::class]
        ], [
            'login' => 'Логин занят',
            'email'=> 'Данный адрес электронной почты занят'
        ]);

        if($request->has('_token', 'name', 'surname', 'login', 'email', 'password', 'password_confirmation', 'agree')){
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->patronymic = $request->patronymic ?? null;
            $user->login = $request->login;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            event(new Registered($user));

            auth('web')->login($user);

            return redirect(route('home'));
        }

        return back()->withErrors($validator)->withInput(['login', 'email']);
    }
}
