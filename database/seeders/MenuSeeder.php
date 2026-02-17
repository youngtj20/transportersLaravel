<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::create([
            'title' => 'Home',
            'url' => '/',
            'type' => 'custom',
            'order' => 1,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'About',
            'url' => '/about',
            'type' => 'custom',
            'order' => 2,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Vision',
            'url' => '/vision',
            'type' => 'custom',
            'order' => 3,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Mission',
            'url' => '/mission',
            'type' => 'custom',
            'order' => 4,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Events',
            'url' => '/events',
            'type' => 'custom',
            'order' => 5,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Blog',
            'url' => '/blog',
            'type' => 'custom',
            'order' => 6,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Gallery',
            'url' => '/gallery',
            'type' => 'custom',
            'order' => 7,
            'enabled' => true,
        ]);
        
        MenuItem::create([
            'title' => 'Contact',
            'url' => '/contact',
            'type' => 'custom',
            'order' => 8,
            'enabled' => true,
        ]);
    }
}
