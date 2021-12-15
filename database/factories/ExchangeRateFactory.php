<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ExchangeRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $to = $this->faker->numberBetween(1, 3);

        return [
            'currency_id' => rand(1,5),
            'buy_price' => $this->faker->randomFloat(5,0.5,400),
            'sell_price' => $this->faker->randomFloat(5, 0.1,400),
            'office_id' => $to == 2 ? null : 'A'.rand(2,10),
            'begins_at' => $this->faker->dateTime()
        ];
    }

}
