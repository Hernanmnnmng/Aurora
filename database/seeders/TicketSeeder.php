<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 sample tickets
        for ($i = 1; $i <= 10; $i++) {
            Ticket::create([
                'code' => 'TIX' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'event_name' => 'Aurora Theater Show ' . $i,
                'event_date' => Carbon::now()->addDays(rand(1, 30))->setHour(19)->setMinute(0),
                'customer_name' => 'Bezoeker ' . $i,
                'customer_email' => 'bezoeker' . $i . '@example.com',
                'seat' => 'Rij ' . chr(64 + $i) . ', Stoel ' . rand(1, 30),
                'expires_at' => $i > 8 ? Carbon::yesterday() : null,
                'used' => $i > 9,
                'used_at' => $i > 9 ? Carbon::yesterday() : null,
                'notes' => $i % 2 == 0 ? 'VIP Bezoeker' : null,
            ]);
        }
    }
}
