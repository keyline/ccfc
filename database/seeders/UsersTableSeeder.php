<?php

namespace Database\Seeders;

use App\Models\User;
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
                'is_active' => '1',
            ],
        ];

        //User::insert($users);
        //Rest of Users
        
        $file = public_path() . "//csv//member-data.csv";

        $csv_reader = new CsvLoader($file, ",");

        

        foreach ($csv_reader->csvToArray() as $record) {
            foreach($record as $key => $entry)
            {
                User::create([
                    'name' => $entry['MEMBER_NAME'],
                    'email' => (isset($entry['EMAIL']) && $entry['EMAIL'] !== '') ? $entry['EMAIL'] : "",
                    'password'=> bcrypt($entry['MEMBER_CODE']),
                    'remember_token'  => null,
                    'two_factor_code' => '',
                    'phone_number_1'  => '',
                    'user_code'     => $entry["MEMBER_CODE"],
                    'is_active'     => ($entry['CURENTSTATUS'] == 'ACTIVE' ) ? '1' : '0',
                ])->each(function($user){
                    User::findOrFail($user->id)->roles()->sync(2);
                });
                
            }
            
        }

         
        
        
    }
}
