<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
        return view('panel.dashboard');
    }
}
