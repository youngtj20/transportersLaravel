<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@transportersfortinubu.ng')->first();
        
        if ($admin) {
            Post::create([
                'title' => 'Launching the Transporters for Tinubu 2027 Movement',
                'slug' => 'launching-transporters-for-tinubu-2027',
                'content' => '<p>We are proud to announce the official launch of the Transporters for Tinubu 2027 movement. This strategic initiative aims to mobilize Nigeria\'s transportation sector to support continued good governance and development.</p><p>Our movement represents thousands of transport workers across road transport, public transit, aviation support, and logistics who believe in progress, accountability, and prosperity for all Nigerians.</p>',
                'excerpt' => 'Official launch of Transporters for Tinubu 2027 - Mobilizing Nigeria\'s transportation sector for continued progress and good governance.',
                'featured_image' => '/images/hero-transport.jpg',
                'published' => true,
                'category' => 'Announcement',
                'tags' => ['launch', 'movement', 'transportation', '2027'],
                'author_id' => $admin->id,
            ]);
            
            Post::create([
                'title' => 'Infrastructure Development Plans for Nigeria\'s Transport Sector',
                'slug' => 'infrastructure-development-plans',
                'content' => '<p>Our comprehensive plan focuses on modernizing Nigeria\'s transportation infrastructure. Key priorities include road network improvements, public transit expansion, and technology integration for better efficiency.</p><p>We believe that investing in transportation infrastructure is investing in Nigeria\'s future. Better roads mean better business, improved connectivity, and enhanced quality of life for all citizens.</p>',
                'excerpt' => 'Comprehensive infrastructure development plans for Nigeria\'s transportation sector focusing on road networks and public transit improvements.',
                'featured_image' => '/images/campaign-logo.jpg',
                'published' => true,
                'category' => 'Policy',
                'tags' => ['infrastructure', 'roads', 'public transit', 'development'],
                'author_id' => $admin->id,
            ]);
            
            Post::create([
                'title' => 'Building Unity Among Transport Workers Nationwide',
                'slug' => 'building-unity-among-transport-workers',
                'content' => '<p>Unity is our strength. We are bringing together transport workers from every corner of Nigeria - truck drivers, bus operators, taxi drivers, and logistics professionals. Our goal is to create a unified voice that speaks with authority on issues affecting our sector.</p><p>Through our network of state coordinators, we are organizing workshops, training programs, and community engagement initiatives to strengthen our movement from the grassroots level.</p>',
                'excerpt' => 'Building national unity among transport workers to create a powerful voice for positive change in Nigeria\'s transportation sector.',
                'featured_image' => '/images/team.jpg',
                'published' => true,
                'category' => 'Community',
                'tags' => ['unity', 'workers', 'community', 'organization'],
                'author_id' => $admin->id,
            ]);
        }
    }
}
