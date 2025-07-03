<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--email=admin@aurora.nl} {--password=admin123} {--name="Admin Aurora"}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Check if an admin with this email already exists
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            // Update the existing admin account
            $existingUser->update([
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'admin'
            ]);
            
            $this->info("Admin account '{$email}' updated with new credentials.");
        } else {
            // Create a new admin account
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin'
            ]);
            
            $this->info("New admin account '{$email}' created.");
        }
    }
}
