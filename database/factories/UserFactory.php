<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
namespace Database\Factories;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
/**
$factory->define(User::class, function (Faker $faker) {

});
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $usercode= $this->faker->unique()->randomElement(['G168','C168','HMR17','HMV03','K168','M243','AR1375','AR1376','T059','L032',]);
        return [
        'name'              => $this->faker->name,
        'email'             => $this->faker->unique()->safeEmail,
        //'email_verified_at' => now(),
        //'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'password'            => $usercode,
        'remember_token'    => Str::random(10),
        'two_factor_code'    => '',
        'user_code'         => $usercode,
        'phone_number_1'    => '',
    ];
    }
}
