<?php

require 'vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check if an admin with this email already exists
$existingUser = User::where('email', 'admin@aurora.nl')->first();

if ($existingUser) {
    // Update the existing admin account
    $existingUser->update([
        'name' => 'Admin Aurora',
        'password' => Hash::make('admin123'),
        'role' => 'admin'
    ]);
    
    echo "Admin account updated with new password.\n";
} else {
    // Create a new admin account
    User::create([
        'name' => 'Admin Aurora',
        'email' => 'admin@aurora.nl',
        'password' => Hash::make('admin123'),
        'role' => 'admin'
    ]);
    
    echo "New admin account created.\n";
}
