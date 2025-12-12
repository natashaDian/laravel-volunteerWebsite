<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            // company_code & name akan dioverride di seeder
            'company_code' => null,
            'name' => $this->faker->company(),

            // field yang random dari faker
            'email' => $this->faker->unique()->companyEmail(),
            'password' => bcrypt('password'), // default password untuk seed
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }

    /**
     * Optional: state helper supaya bisa dipanggil seperti:
     * Company::factory()->company('COO1','Caring Hands')->create();
     */
    public function company(string $code, string $name)
    {
        return $this->state(fn() => [
            'company_code' => $code,
            'name' => $name,
        ]);
    }
}
