<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminloginController extends Controller
{

    public function __construct( )
    {
        $this->middleware('guest:admin');

    }

    public function index()
    {
        return view('auth.adminlogin');
    }
    public function login(request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:4',
            'username_or_email' => 'required',
        ]);

        if(filter_var($validatedData['username_or_email'], FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            Auth::guard('admin')->attempt(['email' => $request->username_or_email, 'password' => $request->password,'remember_token' =>$request->remember]);
        } else {
            //they sent their username instead
            Auth::guard('admin')->attempt(['username' => $request->username_or_email, 'password' => $request->password,'remember_token' =>$request->remember]);
        }

        if ( Auth::check() ) {
            //send them where they are going
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->withInput($request->only('username_or_email','remember'))->with('error','These credentials do not match our records.');
    }
}
