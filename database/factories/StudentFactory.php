<?php

namespace Database\Factories;

use App\CivilStatus;
use App\GenderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            // 'school_id' => count([00001]),
            'grade_level' => rand(7, 12),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'birthdate' => fake()->date('Y M D'),
            'gender' => 'Male',
            'civil_status' => CivilStatus::SINGLE,
            'contact_number' => fake()->phoneNumber(),
            'religion' => fake()->word(),
        ];
    }
}
