<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        prx('ddddd');
        echo "ddddd";die;
        // Dashboard view return karna
        return view('dashboard'); // resources/views/admin/dashboard.blade.php
    }
}
