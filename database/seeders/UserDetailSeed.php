<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserDetailSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory(10)
                ->create()
                ->each(function ($user) {
                    $user->roles()->sync(2);
                    UserDetail::factory(1)
                                ->create(['user_code_id' => $user->id]);
                });
    }
}
