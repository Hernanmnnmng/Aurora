<?php

// app/Http/Controllers/Admin/PerformanceController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        return view('admin.placeholder', ['section' => 'Voorstellingen']);
    }
}
