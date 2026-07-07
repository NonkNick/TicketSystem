<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    /**
     * Notes are strictly an administrator tool: only admins may read, create,
     * update or delete them.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }
}
