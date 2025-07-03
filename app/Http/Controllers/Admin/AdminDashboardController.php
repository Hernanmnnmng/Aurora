<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()?->role !== 'admin') {
            abort(403, 'Access denied');
        }

        return view('admin.dashboard');
    }
}