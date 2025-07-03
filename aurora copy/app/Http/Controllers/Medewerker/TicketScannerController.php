<?php

namespace App\Http\Controllers\Medewerker;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketScannerController extends Controller
{    public function index()
    {
        // Double-check that the user is a medewerker or admin
        if (auth()->user()->role !== 'medewerker' && auth()->user()->role !== 'admin') {
            return redirect()->route('bezoeker.dashboard')
                ->with('error', 'Je hebt geen toegang tot de ticketscanner.');
        }
        
        return view('medewerker.tickets.scanner');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string',
        ]);

        $code = $request->ticket_code;
        $ticket = Ticket::where('code', $code)->first();

        if (!$ticket) {
            return back()->with([
                'status' => 'invalid',
                'message' => 'Ticket niet gevonden.',
            ]);
        }

        if ($ticket->cancelled) {
            return back()->with([
                'status' => 'invalid',
                'message' => 'Ticket is geannuleerd.',
                'ticket' => $ticket,
            ]);
        }

        if ($ticket->isExpired()) {
            return back()->with([
                'status' => 'invalid',
                'message' => 'Ticket is verlopen.',
                'ticket' => $ticket,
            ]);
        }

        if ($ticket->used) {
            return back()->with([
                'status' => 'used',
                'message' => 'Ticket is al gebruikt op ' . $ticket->used_at->format('d-m-Y H:i'),
                'ticket' => $ticket,
            ]);
        }

        // Valid ticket, mark as used
        $ticket->markAsUsed();

        return back()->with([
            'status' => 'success',
            'message' => 'Ticket gevalideerd en als gebruikt gemarkeerd.',
            'ticket' => $ticket,
        ]);
    }
}