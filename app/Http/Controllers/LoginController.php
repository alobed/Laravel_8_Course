<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
//    public function create()
//    {
//        return view('/'); // TODO: fix this
//    }

    public function store()
    {
        // if the validation is fail, it will redirect you back to the previous page
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:255',
//                Rule::exists('users', 'email') // don't do this for security concerns
            ],
            'password' => ['required']
        ]);

        // attempt function try to authenticate and login the user with checking the attributes
        if (auth()->attempt($attributes)) {
            return redirect('/')->with('success', 'Welcome Back!');
        }

        // in case if auth failed, go back with bellow message in email input
        //return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified']); // one way
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]); // another way
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/login')->with('success', 'Goodbye!');
    }
}
