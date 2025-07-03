<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.accounts.index', compact('users'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,medewerker,bezoeker',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Account aangemaakt.');
    }

    public function edit(User $account)
    {
        return view('admin.accounts.edit', compact('account'));
    }

public function update(Request $request, User $account)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $account->id,
        'role' => 'required|in:admin,medewerker,bezoeker',
        'password' => 'nullable|min:6',
    ]);

    $data = $request->only('name', 'email', 'role');

    if ($request->filled('password')) {
        $data['password'] = \Hash::make($request->password);
    }

    $account->update($data);

    return redirect()->route('admin.accounts.index')->with('success', 'Account bijgewerkt.');
}

    public function destroy(User $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Account verwijderd.');
    }
}