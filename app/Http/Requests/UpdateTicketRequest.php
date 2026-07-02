<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorization is enforced via the TicketPolicy in the controller.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isAdmin = $this->user()?->isAdmin() ?? false;

        return [
            'title'        => ['sometimes', 'required', 'string', 'max:255'],
            'description'  => ['sometimes', 'required', 'string'],
            'categories'   => ['sometimes', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],

            // Only administrators may change the status or (re)assign a ticket,
            // and tickets can only be assigned to administrators.
            'status'      => [$isAdmin ? 'sometimes' : 'prohibited', Rule::in(['in_afwachting', 'in_behandeling', 'afgehandeld'])],
            'assigned_to' => [$isAdmin ? 'nullable' : 'prohibited', Rule::exists('users', 'id')->where('role', 'admin')],
        ];
    }
}
