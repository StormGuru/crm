<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;
use App\Models\Customer;

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
        return [
            'customer_id' => Customer::factory(),
            'subject'     => $this->faker->sentence(4),
            'text'        => $this->faker->paragraph(3),
            'status'      => $this->faker->randomElement([
                TicketStatus::NEW,
                TicketStatus::IN_PROGRESS,
                TicketStatus::DONE,
            ]),
            'replied_at'  => null,
        ];
    }
}
