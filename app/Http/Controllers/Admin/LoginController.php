<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function showLoginForm()
    {
        return view('admin.login'); // admin/login.blade.php view
    }

     public function login(Request $request)
    {
        dd($request);
        // Validation aur login logic yahan likho
    }

    public function logout()
    {
        // Logout logic yahan likho
    }
}
