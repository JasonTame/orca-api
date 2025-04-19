<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'logo_url' => $this->faker->imageUrl(),
            'website' => $this->faker->url(),
            'industry' => $this->faker->word(),
            'size' => $this->faker->randomElement(['small', 'medium', 'large', 'enterprise']),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
