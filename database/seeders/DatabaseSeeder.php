<?php

namespace Database\Seeders;

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
        $this->call(CurrencyTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        \App\Models\ExchangeRate::factory(30)->create();
    }
}
