<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientSchedule>
 */
class PatientScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => 1,
            'doctor_id' => 1,
            'schedule_time' => $this->faker->dateTimeBetween('now','+1 year'),
            'complaint' => $this->faker->text,
            'status' => 'waiting',
            'no_antrian' => 1,
            'payment_method' => 'cash',
            'total_price' => 150000,
        ];
    }
}
