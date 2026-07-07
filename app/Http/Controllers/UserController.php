<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        Gate::authorize('viewAny', User::class);

        return UserResource::collection(User::orderBy('first_name')->get());
    }

    public function indexAdmin()
    {
        Gate::authorize('viewAny', User::class);

        return UserResource::collection(
            User::where('role', 'admin')->orderBy('first_name')->get()
        );
    }

    public function show(User $user)
    {
        Gate::authorize('view', $user);

        return UserResource::make($user);
    }

    /**
     * Update the given user's details (administrators only).
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();

        $user->fill($validated);

        if (isset($validated['first_name']) || isset($validated['last_name'])) {
            $user->name = $user->first_name.' '.$user->last_name;
        }

        $user->save();

        return UserResource::make($user);
    }

    /**
     * Remove the given user (administrators only).
     *
     * A user with unresolved (not "afgehandeld") tickets cannot be deleted;
     * the administrator is told to resolve those tickets first.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        if ($user->tickets()->where('status', '!=', 'afgehandeld')->exists()) {
            return response()->json([
                'message' => 'Deze gebruiker heeft nog niet-afgehandelde tickets en kan niet worden verwijderd.',
            ], 409);
        }

        $user->delete();

        return response()->noContent();
    }


}
