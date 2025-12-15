<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;
use App\Models\Customer;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
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
        $status = $this->faker->randomElement([
            TicketStatus::NEW,
            TicketStatus::IN_PROGRESS,
            TicketStatus::DONE,
        ]);

        $createdAt = Carbon::now()->subDays(rand(0, 30));

        return [
            'customer_id' => Customer::factory(),
            'subject'     => $this->faker->sentence(4),
            'text'        => $this->faker->paragraph(3),
            'status'      => $status,
            'created_at'  => $createdAt,
            'updated_at'  => $createdAt,
            'replied_at'  => $status === TicketStatus::DONE ? $createdAt->copy()->addDays(rand(0,5)) : null,
        ];
    }
}
