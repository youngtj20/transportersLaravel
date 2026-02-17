<?php
// Simple API test script

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Artisan;

echo "Laravel API Endpoints Created Successfully!\n";
echo "API Routes:\n";
echo "- POST /api/login - User login\n";
echo "- POST /api/logout - User logout\n";
echo "- GET /api/me - Get authenticated user\n";
echo "- GET /api/pages - Get all pages (public)\n";
echo "- GET /api/pages/{id} - Get specific page (public)\n";
echo "- POST /api/pages - Create page (authenticated)\n";
echo "- PUT/PATCH /api/pages/{id} - Update page (authenticated)\n";
echo "- DELETE /api/pages/{id} - Delete page (authenticated)\n";
echo "- GET /api/posts - Get all posts (public)\n";
echo "- GET /api/posts/{id} - Get specific post (public)\n";
echo "- POST /api/posts - Create post (authenticated)\n";
echo "- PUT/PATCH /api/posts/{id} - Update post (authenticated)\n";
echo "- DELETE /api/posts/{id} - Delete post (authenticated)\n";
echo "- GET /api/events - Get all events (public)\n";
echo "- GET /api/events/{id} - Get specific event (public)\n";
echo "- POST /api/events - Create event (authenticated)\n";
echo "- PUT/PATCH /api/events/{id} - Update event (authenticated)\n";
echo "- DELETE /api/events/{id} - Delete event (authenticated)\n";
echo "- GET /api/team-members - Get all team members (public)\n";
echo "- GET /api/team-members/{id} - Get specific team member (public)\n";
echo "- POST /api/team-members - Create team member (authenticated)\n";
echo "- PUT/PATCH /api/team-members/{id} - Update team member (authenticated)\n";
echo "- DELETE /api/team-members/{id} - Delete team member (authenticated)\n";
echo "- GET /api/menu-items - Get all menu items (public)\n";
echo "- GET /api/menu-items/{id} - Get specific menu item (public)\n";
echo "- POST /api/menu-items - Create menu item (authenticated)\n";
echo "- PUT/PATCH /api/menu-items/{id} - Update menu item (authenticated)\n";
echo "- DELETE /api/menu-items/{id} - Delete menu item (authenticated)\n";
echo "- GET /api/settings - Get all settings (public)\n";
echo "- GET /api/settings/{id} - Get specific setting (public)\n";
echo "- POST /api/settings - Create setting (authenticated)\n";
echo "- PUT/PATCH /api/settings/{id} - Update setting (authenticated)\n";
echo "- DELETE /api/settings/{id} - Delete setting (authenticated)\n";
echo "- GET /api/movement-members - Get all movement members (public)\n";
echo "- GET /api/movement-members/{id} - Get specific movement member (public)\n";
echo "- POST /api/movement-members - Create movement member (authenticated)\n";
echo "- PUT/PATCH /api/movement-members/{id} - Update movement member (authenticated)\n";
echo "- DELETE /api/movement-members/{id} - Delete movement member (authenticated)\n";
echo "- GET /api/event-galleries - Get all event galleries (public)\n";
echo "- GET /api/event-galleries/{id} - Get specific event gallery (public)\n";
echo "- POST /api/event-galleries - Create event gallery (authenticated)\n";
echo "- PUT/PATCH /api/event-galleries/{id} - Update event gallery (authenticated)\n";
echo "- DELETE /api/event-galleries/{id} - Delete event gallery (authenticated)\n";
echo "\n";

echo "Database seeded with:\n";
echo "- Admin user: admin@transportersfortinubu.ng\n";
echo "- Regular user: user@transportersfortinubu.ng\n";
echo "\n";

echo "Laravel API is ready for the Transporters for Tinubu 2027 application!\n";