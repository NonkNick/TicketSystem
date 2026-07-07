<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketCommentRequest;
use App\Http\Requests\UpdateTicketCommentRequest;
use App\Http\Resources\TicketCommentResource;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Notifications\TicketReplyNotification;
use Illuminate\Support\Facades\Gate;

class TicketCommentController extends Controller
{
    /**
     * Add a comment (reply) to the given ticket (administrators only).
     */
    public function store(StoreTicketCommentRequest $request, Ticket $ticket)
    {
        Gate::authorize('create', TicketComment::class);

        $comment = $ticket->comments()->create([
            'user_id' => $request->user()->id,
            'message' => $request->validated('message'),
        ]);

        // Notify the ticket creator that a reply was added (skip self-replies).
        if ($ticket->creator && $ticket->creator->isNot($request->user())) {
            $ticket->creator->notify(new TicketReplyNotification($ticket));
        }

        return TicketCommentResource::make($comment->load('user'));
    }

    /**
     * Update an existing comment (administrators only).
     */
    public function update(UpdateTicketCommentRequest $request, TicketComment $comment)
    {
        Gate::authorize('update', $comment);

        $comment->update([
            'message'   => $request->validated('message'),
            'edited_at' => now(),
        ]);

        return TicketCommentResource::make($comment->load('user'));
    }
}
