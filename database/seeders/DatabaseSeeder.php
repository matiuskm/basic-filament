<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        \App\Models\Hero::factory()->create([
            'title' => "We are a Arunika Digital serve#Online Marketing|Web Design|Mobile Apps|Brand Identity|Social Content",
            'subtitle' => 'We would direct you to limitless ideas and move your brand into a global landscape.',
            'link1' => 'http://basic-filament.test/#portfolio',
            'link2' => 'https://hianime.to/home',
            'image' => 'https://picsum.photos/400/300',
            'is_active' => true,
        ]);

        $this->call([
            GuestBookSeeder::class,
            HeroSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            ClientSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
