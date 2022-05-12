<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        $data = array();
        $data['email'] = $faker->email;
        // $data['password'] = Hash::make($faker->password);
        $data['password'] = Hash::make('12345678');
        AddNewRecord('admin', $data);
    }
}
