<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    /**
     * Add a note to the given ticket (administrators only).
     */
    public function store(StoreNoteRequest $request, Ticket $ticket)
    {
        Gate::authorize('create', Note::class);

        $note = $ticket->notes()->create([
            'user_id' => $request->user()->id,
            'note'    => $request->validated('note'),
        ]);

        return NoteResource::make($note->load('user'));
    }

    /**
     * Update the specified note (administrators only).
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);

        $note->update($request->validated());

        return NoteResource::make($note->load('user'));
    }

    /**
     * Remove the specified note (administrators only).
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return response()->noContent();
    }
}
