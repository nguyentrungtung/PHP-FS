<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(CategoryTableSeeder::class);
        // $this->call(PromotionsTableSeeser::class);
        // $this->call(UnitTableSeeder::class);
        // $this->call(CustomersSeeder::class);
        // tao san pham
        // $this->call(ProductSeeder::class);
        // tao don vi cho san pham
        $this->call(UnitValueSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
