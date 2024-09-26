<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('customers')->insert([
                'customer_name' => $faker->name,
                'customer_email' => $faker->unique()->safeEmail,
                'customer_phone' => $faker->phoneNumber,
                'password'=>Hash::make('00000000')
            ]);
        }
    }
}
