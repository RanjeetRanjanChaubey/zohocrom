<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminActivity;

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


        // Login with admin guard
        Auth::guard('admin')->login($admin);

        $admin->update(['last_activity' => now()]);

        // Save login activity
        AdminActivity::create([
            'admin_id' => $admin->id,
            'activity' => 'Login',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    protected function redirectTo()
    {
        return route('admin.dashboard'); // login success ke baad
    }

    // // Login fail hone par
    // return redirect()->route('admin.login')->withErrors([
    //     'email' => 'These credentials do not match our records.',
    // ]);

   public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if($admin) {
            AdminActivity::create([
                'admin_id' => $admin->id,
                'activity' => 'Logout',
                'ip_address' => $request->ip(),
            ]);

            $admin->update(['last_activity' => null]);
        }
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
