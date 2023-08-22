<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketStatResource;

class TicketController extends Controller
{
    //get list of tickets unprocessed
    public function getOpenTickets(Request $request)
    {
        $tickets = Ticket::where('status', false)
            ->with('user:id,name,email')
            ->paginate(50);

        return TicketResource::collection($tickets);
      //  return Inertia::render('Tickets/Open', ['tickets' => $tickets]);

    //     $response->header('Cache-Control', 'public, max-age=3600'); // Cache the response for 1 hour

    // return $response;
    }

    //get list of tickets processed
    public function getClosedTickets(Request $request)
    {
        $tickets = Ticket::where('status', true)
            ->with('user:id,name,email')
            ->paginate(50);

        return TicketResource::collection($tickets);
    }

     //get list of tickets for selected user
    public function getUserTickets(Request $request, $email)
    {
        $user = User::where('email', $email)->firstOrFail();

        $tickets = Ticket::where('user_id', $user->id)
            ->with('user:id,name,email')
            ->paginate(10);

        return TicketResource::collection($tickets);
    }

    //get statistics of tickets
    public function getStats(Request $request)
    {
        $totalTickets = Ticket::count();
        $unprocessedTickets = Ticket::where('status', false)->count();
        $highestTicketUser = Ticket::select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $lastProcessingTime = Ticket::where('status', true)
            ->latest('updated_at')
            ->value('updated_at');

        $data = [
            'total_tickets' => $totalTickets,
            'unprocessed_tickets' => $unprocessedTickets,
            'highest_ticket_user' => User::find($highestTicketUser->user_id, ['name', 'email']),
            'last_processing_time' => $lastProcessingTime,
        ];

        return response()->json($data);
    }
    // $stats = Cache::remember('ticket_stats', 60, function () {
    //     $totalTickets = Ticket::count();
    //     $unprocessedTickets = Ticket::where('status', false)->count();
    //     $highestTicketUser = Ticket::select('user_id')
    //         ->groupBy('user_id')
    //         ->orderByRaw('COUNT(*) DESC')
    //         ->first();

    //     $lastProcessingTime = Ticket::where('status', true)
    //         ->latest('updated_at')
    //         ->value('updated_at');

    //     return [
    //         'total_tickets' => $totalTickets,
    //         'unprocessed_tickets' => $unprocessedTickets,
    //         'highest_ticket_user' => User::find($highestTicketUser->user_id, ['name', 'email']),
    //         'last_processing_time' => $lastProcessingTime,
    //     ];
    // });
}

