<?php

namespace App\Http\Controllers\Medewerker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MedewerkerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'medewerker') {
            abort(403, 'Access denied');
        }

        return view('medewerker.dashboard');
    }
}