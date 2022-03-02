<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
                'member_type_code'=> 'A',
                'date_of_birth' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')
                                    ->format('d-m-Y'), // outputs something like 17/09/2001
                'member_since'  => $this->faker->year('2017'),
                'address_1'     => $this->faker->address,
                'address_2'     => $this->faker->address,
                'address_3'     => $this->faker->address,
                'city'          => $this->faker->city,
                'state'         => $this->faker->state,
                'pin'           => $this->faker->numerify('######'),
                'mobile_no'     => $this->faker->numerify('######'),

        

        ];
    }
}
