<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class UserTicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->latest()->paginate(10);
        
        return view('bezoeker.tickets.index', compact('tickets'));
    }
    
    public function show(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('bezoeker.tickets.show', compact('ticket'));
    }
}
