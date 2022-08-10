<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminat\Support\Facades\Redirect;
use App\Http\Requests\PasswordRequest;
use Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }
    
    public function PasswordUpdate(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'oldPassword' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        $OldPassword = $request->oldPassword;
        $Password = (auth()->user()->password);
        if (Hash::check($OldPassword, $Password)) { 
            $user->password = Hash::make($request->password);
            $user->update();
            return Redirect::route('dashboard');
        
        } else {
            return redirect()->route('dashboard')->with('failed');
        }

        
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function show()
    {
        $email = User::select('email')->first();
        return response($email);
    }
}
