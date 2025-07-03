<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedewerkerController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'medewerker')->get();
        return view('admin.medewerkers.index', compact('users'));
    }

    public function create()
    {
        return view('admin.medewerkers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'medewerker',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.medewerkers.index')->with('success', 'Medewerker aangemaakt.');
    }

    public function edit(User $medewerker)
    {
        return view('admin.medewerkers.edit', ['account' => $medewerker]);
    }

    public function update(Request $request, User $medewerker)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $medewerker->id,
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only('name', 'email');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $medewerker->update($data);

        return redirect()->route('admin.medewerkers.index')->with('success', 'Medewerker bijgewerkt.');
    }

    public function destroy(User $medewerker)
    {
        $medewerker->delete();
        return redirect()->route('admin.medewerkers.index')->with('success', 'Medewerker verwijderd.');
    }
}