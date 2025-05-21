<?php

namespace App\Http\Controllers\Medewerker;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountenController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('medewerker.accounten.index', compact('users'));
    }

    public function create()
    {
        return view('medewerker.accounten.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,medewerker,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('medewerker.accounten.index')->with('success', 'User created.');
    }

    public function edit(User $account)
    {
        return view('medewerker.accounten.edit', compact('account'));
    }

    public function update(Request $request, User $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$account->id}",
            'role' => 'required|in:admin,medewerker,user',
        ]);

        $account->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('medewerker.accounten.index')->with('success', 'User updated.');
    }

    public function destroy(User $account)
    {
        $account->delete();

        return redirect()->route('medewerker.accounten.index')->with('success', 'User deleted.');
    }
}