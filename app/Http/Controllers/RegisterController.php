<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // if the validation is fail, it will redirect you back to the previous page
        $attributes = request()->validate([
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')], // another format
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        $user = User::create($attributes);

        // session()->flash('success','Your account has been created.');

        auth()->login($user);

        return redirect('/')->with('success','Your account has been created.');
    }
}
