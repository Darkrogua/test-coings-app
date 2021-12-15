<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [];
        $date = Carbon::now()->format('Y-m-d H:i:s');

        for ($i = 1; $i <= 10; $i++) {
            $office_name = 'A'.$i;

            $offices[] = [
                'name' => ($i == 1) ? 'Главный офис': $office_name,
                'active' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ];
        }
        \DB::table('offices')->insert($offices);
    }
}
