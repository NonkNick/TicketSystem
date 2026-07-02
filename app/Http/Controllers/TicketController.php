<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     *
     * Regular users only see the tickets they created; administrators see
     * every ticket. Results are sorted chronologically (newest first).
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Ticket::class);

        $user = $request->user();

        $tickets = Ticket::query()
            ->with(['creator', 'assignee', 'categories'])
            ->unless($user->isAdmin(), fn ($query) => $query->where('user_id', $user->id))
            ->latest()
            ->get();

        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created ticket.
     */
    public function store(StoreTicketRequest $request)
    {
        Gate::authorize('create', Ticket::class);

        $validated = $request->validated();

        $ticket = $request->user()->tickets()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
        ]);

        $ticket->categories()->sync($validated['categories'] ?? []);
        return TicketResource::make($ticket->load(['creator', 'assignee', 'categories']),);

    }

    /**
     * Display the specified ticket with all related information.
     *
     * Comments are shown to everyone who may view the ticket; notes are
     * admin-only and returned in chronological order.
     */
    public function show(Request $request, Ticket $ticket)
    {
        Gate::authorize('view', $ticket);

        $ticket->load([
            'creator',
            'assignee',
            'categories',
            'comments.user',
        ]);

        if ($request->user()->isAdmin()) {
            $ticket->load(['notes' => fn ($query) => $query->oldest(), 'notes.user']);
        }

        return TicketResource::make($ticket);
    }

    /**
     * Update the specified ticket.
     *
     * The creator (or any administrator) may edit the title/description and
     * categories. Only administrators may change the status or assignee —
     * this is enforced by UpdateTicketRequest.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        $validated = $request->validated();

        $ticket->fill($validated)->save();

        if (array_key_exists('categories', $validated)) {
            $ticket->categories()->sync($validated['categories'] ?? []);
        }

        return TicketResource::make($ticket->load(['creator', 'assignee', 'categories']));
    }

    /**
     * Remove the specified ticket.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);

        $ticket->delete();

        return response()->noContent();
    }
}
