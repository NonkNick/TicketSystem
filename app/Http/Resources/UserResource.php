<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,

            // Contact details are only added for administrators (e.g. the admin
            // user-overview). For everyone else — including when a user object is
            // embedded as a ticket's creator/assignee/author — these keys are
            // simply omitted from the response.
            $this->mergeWhen($request->user()?->isAdmin() ?? false, [
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'email'      => $this->email,
                'phone'      => $this->phone,
            ]),
        ];
    }
}
