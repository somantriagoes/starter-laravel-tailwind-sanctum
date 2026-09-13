<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Agus Somantri',
            'email' => 'somantriagoes@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('bismillah123'),
        ]);

        $this->call([
            BlogSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

    }
}
