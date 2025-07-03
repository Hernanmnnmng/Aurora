<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users = \App\Models\User::where('role', 'bezoeker')->get();
        return view('admin.tickets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'seat' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
            'code' => 'nullable|string|max:20|unique:tickets,code',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Handle auto generation of ticket code if not provided
        if (!$request->code) {
            $code = Ticket::generateUniqueCode();
        } else {
            $code = $request->code;
        }

        Ticket::create([
            'code' => $code,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'seat' => $request->seat,
            'expires_at' => $request->expires_at,
            'notes' => $request->notes,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket succesvol aangemaakt met code: ' . $code);
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $users = \App\Models\User::where('role', 'bezoeker')->get();
        return view('admin.tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'seat' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
            'code' => 'nullable|string|max:20|unique:tickets,code,'.$ticket->id,
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update($request->all());

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket succesvol bijgewerkt.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket succesvol verwijderd.');
    }
    
    public function scanner()
    {
        // Double-check that the user is an admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Je hebt geen toegang tot de ticketscanner.');
        }
        
        return view('admin.tickets.scanner');
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
    
    public function cancel(Ticket $ticket)
    {
        $ticket->markAsCancelled();
        
        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Ticket is geannuleerd.');
    }
}
