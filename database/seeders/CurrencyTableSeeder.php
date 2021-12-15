<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies_data = [];
        $currencies = [
            'EUR' =>    'Евро',
            'RUB' =>    'Российский рубль',
            'USD' =>    'Доллар Сша',
            'UAH' =>    'Украинская гривна',
            'GBR' =>    'Английский фунт'
        ];

        $date = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($currencies as $code => $currency) {
            $currencies_data[] = [
                'name' => $currency,
                'code' => $code,
                'active' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ];
        }
        \DB::table('currencies')->insert($currencies_data);
    }
}
