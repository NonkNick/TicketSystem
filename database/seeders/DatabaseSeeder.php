<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Note;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // password: password
        $admin = User::factory()->admin()->create([
            'first_name' => 'Admin',
            'last_name' => 'Beheerder',
            'name' => 'Admin Beheerder',
            'email' => 'admin@example.com',
        ]);

        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'Gebruiker',
            'name' => 'Test Gebruiker',
            'email' => 'user@example.com',
        ]);

        $admins = User::factory(2)->admin()->create()->push($admin);
        $users = User::factory(10)->create()->push($user);

        // --- Categories --------------------------------------------------
        $categories = collect(['Hardware', 'Software', 'Netwerk', 'Account', 'E-mail', 'Overig'])
            ->map(fn (string $name) => Category::create(['name' => $name]));

        // --- Tickets ----------------------
        Ticket::factory(30)
            ->recycle($users)
            ->create()
            ->each(function (Ticket $ticket) use ($categories, $admins, $users) {
                // Attach 1-3 categories through the category_ticket pivot
                $ticket->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')
                );

                // Assign roughly half of the tickets to an admin
                if (rand(0, 1) === 1) {
                    $ticket->update(['assigned_to' => $admins->random()->id]);
                }

                // 0-4 comments from any user or admin
                TicketComment::factory(rand(0, 4))
                    ->recycle($users->merge($admins))
                    ->create(['ticket_id' => $ticket->id]);

                // 0-2 admin-only notes
                Note::factory(rand(0, 2))
                    ->recycle($admins)
                    ->create(['ticket_id' => $ticket->id]);
            });
    }
}