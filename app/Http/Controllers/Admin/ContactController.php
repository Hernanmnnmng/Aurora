<?php


// app/Http/Controllers/Admin/ContactController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.placeholder', ['section' => 'Contactaanvragen']);
    }
}
