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
        // Only show users with role 'bezoeker'
        $users = User::where('role', 'bezoeker')->get();
        return view('accounten.index', compact('users'));
    }

    public function create()
    {
        return view('accounten.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            // 'role' validation removed
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'bezoeker', // Always set to bezoeker
        ]);

        return redirect()->route('medewerker.accounten.index')->with('success', 'Bezoeker aangemaakt.');
    }

    public function edit(User $account)
    {
        return view('accounten.edit', compact('account'));
    }

    public function update(Request $request, User $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$account->id}",
            // 'role' validation removed
        ]);

        $account->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'bezoeker', // Always set to bezoeker
        ]);

        return redirect()->route('medewerker.accounten.index')->with('success', 'Bezoeker bijgewerkt.');
    }

   public function destroy(User $account)
{
    $account->delete();

    return redirect()->route('medewerker.accounten.index')->with('success', 'Bezoeker verwijderd.');
}
}