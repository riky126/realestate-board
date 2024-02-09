<?php
namespace App\Http\Controllers;

/** External Imports */
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/** Internal Imports */

class AuthController extends Controller {
    
    /**
     * Request the login page.
     *
     * @return \Illuminate\Http\HttpResponse
     */
    public function show() {
        $data['title'] = 'Login';
        return view('pages.login', $data);
    }

    /**
     * Get the authenticated User.
     * @param request
     * @param error
     * @return \Illuminate\Http\HttpResponse
     */
    public function login(Request $request, MessageBag $error) {
        
        validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }

    /**
     * Logout the User and and discard User session.
     * @param request
     * @return \Illuminate\Http\HttpResponse
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}