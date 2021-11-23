<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $companies = (int) $this->command->ask('How many companies do you need?', 100);
        $customers = (int) $this->command->ask('How many customers per company do you need?', 15);

        $this->command->info("Creating $companies companies.");
        $this->command->info("Creating $customers customers per company.");

        Company::factory($companies)
            ->has(Customer::factory()->count($customers))
            ->create();
    }
}
