<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Display registration form
    public function register(){
        return view('auth.register');
    }

    //User Registration
    public function regisSub(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|max:30',
            'cpassword' => 'required|min:6|max:30|same:password',
        ],
        [
            'cpassword.required' => 'The Confirm Password is required',
            'cpassword.same' => 'The Password and Confirmd password must not be same'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success','Registration has been successfully');

    }

    //User Login form
    public function login(){
        return view('auth.login');
    }


    //User login functionality
    public function check(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30',
        ],[
            'email.exists' => 'This email is not exists on user table',
        ]);

        $check = $request->only('email', 'password');
        if(Auth::guard('web')->attempt($check)){
            return redirect()->route('dashboard')->with('success','Login Has been Successfully');
        }else{
            return redirect()->route('login')->with('error', 'Incorrect Credentials');
        }
    }

    //Logout Functionality
    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
