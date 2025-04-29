<?php

namespace Database\Factories;

use App\Models\Company;
use App\Enums\CompanySize;
use App\Enums\CompanyStatus;
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
            'size' => CompanySize::random(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'status' => CompanyStatus::random(),
        ];
    }
}
