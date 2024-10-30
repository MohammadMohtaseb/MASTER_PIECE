<?php

namespace Database\Factories;

use App\Models\ParentStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParentStudent>
 */
class ParentStudentFactory extends Factory
{
    protected $model = ParentStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cid' => $this->faker->phoneNumber(),
            'password' => '123'
            // Add any additional fields required for the ParentStudent model
        ];
    }
}
