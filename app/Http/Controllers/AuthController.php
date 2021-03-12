<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect()->route('dashboard');
        }
        Alert::toast('Oppes! You have entered invalid credentials', 'error');
        return redirect('/');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'gender' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required|string'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = new Login;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->roles = 'adminkost';

        if($request->file('profile_photo'))
        {
            $file = $request->file('profile_photo')->store('user', 'public');
            $user->profile_photo = $file;
        }

        $user->save();
        Alert::toast('User successfully registered !', 'success');

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Logout Successfully', 'success');
        return redirect('/');
    }
}
