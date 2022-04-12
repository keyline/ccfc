<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use App\Helpers\CsvLoader;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'              => 1,
                'name'            => 'Admin',
                'email'           => 'admin@admin.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
                'user_code'       => '',
                'phone_number_1'  => '',
                'status' => 'ACTIVE',
            ],
        ];

        //User::insert($users);
        //Rest of Users
        
        $file = public_path() . "//csv//member-data.csv";

        $csv_reader = new CsvLoader($file, ",");

        foreach ($csv_reader->csvToArray() as $record) {
            foreach ($record as $key => $entry) {
                $user= User::create([
                    'name' => $entry['MEMBER_NAME'],
                    'email' => (isset($entry['EMAIL']) && $entry['EMAIL'] !== '') ? $entry['EMAIL'] : null,
                    'password'=> bcrypt($entry['MEMBER_CODE']),
                    'remember_token'  => null,
                    'two_factor_code' => '',
                    'phone_number_1'  => '',
                    'user_code'     => $entry["MEMBER_CODE"],
                    'status'     => $entry['CURENTSTATUS'] ,
                ]);
                //$userDetails = new UserDetail;
                $user->roles()->sync(2);
                $user->userCodeUserDetails()->create()->id;
            }
        }
    }
}
