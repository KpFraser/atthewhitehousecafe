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

    public function passwordUpdate(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'oldPassword' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        $oldPassword = $request->oldPassword;
        $password = ($user->password);

        if (Hash::check($oldPassword, $password)) {
            $user->password = Hash::make($request->password);
            $user->update();
            return response()->success();
        } else
            return response()->error("The Password with Confirm Password doesn't match", 500);
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
        $email = Auth()->user()->email;
        return response($email);
    }
    public function update(Request $request)
    { 
        $user = auth()->user();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->update();
        
        return response()->success();
    }
    public function showPersonalInfo(Request $request)
    { 
        $data['name'] = auth()->user()->name;
        $data['address'] = auth()->user()->address;
        $data['postcode'] = auth()->user()->postcode;
        $data['phone_number'] = auth()->user()->phone_number;
         
        return ['data'=>$data];
            
    }
    public function healthUpdate(Request $request)
    { 
        $user = auth()->user();
        $user->emergency_name = $request->name;
        $user->emergency_number = $request->phone_number;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->update();
        
        return response()->success();
            
    }
}
