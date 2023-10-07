<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = count(Storage::files('public/images/printer'));

        for ($i = 1; $i <= $count; $i++) {
            DB::table('products')->insert([
                'title' => fake()->unique()->word(),
                'country'=> fake()->country(),
                'year'=> fake()->year(),
                'model'=> fake()->numerify(),
                'price' => fake()->numberBetween('1000', '5000'),
                'amount' => fake()->numberBetween('1', '10'),
                'image' => $i . '.webp',
                'category_id' => fake()->numberBetween('1', '3'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
