<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'assigned_to' => null,
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(['in_afwachting', 'in_behandeling', 'afgehandeld']),
        ];
    }

    /**
     * Assign the ticket to a specific admin.
     */
    public function assignedTo(User $admin): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_to' => $admin->id,
        ]);
    }
}

