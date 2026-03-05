<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        //  Validate input
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = AdminUsers::where('email', $request->username)->first();

        if (!$admin) {
            return redirect()->back()->withInput($request->only('username'))
                                    ->with('error', 'Admin user not found');
        }

        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->back()->withInput($request->only('username'))
                                    ->with('error', 'Invalid password');
        }


        Auth::login($admin);

        return redirect()->route('dashboard');
    }

    protected function redirectTo()
    {
        return route('admin.dashboard'); // login success ke baad
    }

    // // Login fail hone par
    // return redirect()->route('admin.login')->withErrors([
    //     'email' => 'These credentials do not match our records.',
    // ]);

    public function logout()
    {
        // Logout logic yahan likho
    }
}
