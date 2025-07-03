<?php

namespace App\Http\Controllers\Medewerker;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(15);
        return view('medewerker.tickets.index', compact('tickets'));
    }
}
