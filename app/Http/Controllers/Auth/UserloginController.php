<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class UserloginController extends Controller
{
    public function login(request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:4',
            'username_or_email' => 'required',
        ]);

        if(filter_var($validatedData['username_or_email'], FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            Auth::guard('web')->attempt(['email' => $validatedData['username_or_email'], 'password' => $validatedData['password']]);
        } else {
            //they sent their username instead
            Auth::guard('web')->attempt(['username' => $validatedData['username_or_email'], 'password' => $validatedData['password']]);
        }

        if ( Auth::check() ) {
            //send them where they are going
            return redirect()->intended('/home');
        }
        return redirect()->back()->withInput($request->only('username_or_email','remember'))->with('error','These credentials do not match our records.');
    }
}
