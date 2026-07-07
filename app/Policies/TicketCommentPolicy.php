<?php

namespace App\Policies;

use App\Models\TicketComment;
use App\Models\User;

class TicketCommentPolicy
{
    /**
     * Determine whether the user can add a comment (reply) to a ticket.
     *
     * Only administrators handle tickets by replying to them.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can edit an existing comment.
     */
    public function update(User $user, TicketComment $ticketComment): bool
    {
        return $user->isAdmin();
    }
}
