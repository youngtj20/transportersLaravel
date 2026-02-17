<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Transporters for Tinubu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar Navigation -->
        <nav class="w-64 bg-white shadow h-screen fixed">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Admin Panel</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-file-alt mr-3"></i>
                            Pages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-blog mr-3"></i>
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-images mr-3"></i>
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.team-members.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Team Members
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.menu-items.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-bars mr-3"></i>
                            Menu Items
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-blue-100 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="flex-1 ml-64">
            <!-- Admin Header -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-6">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
                            <span class="ml-4 text-sm text-gray-500">Transporters for Tinubu 2027</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Welcome, {{ auth()->user()->name }}</span>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-file-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Pages</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['pages'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-blog text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Posts</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['posts'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Events</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['events'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Team Members</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['team_members'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['users'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.pages.create') }}" 
                       class="flex flex-col items-center justify-center p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                        <i class="fas fa-file-alt text-3xl text-blue-600 mb-2"></i>
                        <span class="text-sm font-medium text-gray-700">Create Page</span>
                    </a>
                    <a href="{{ route('admin.posts.create') }}" 
                       class="flex flex-col items-center justify-center p-6 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                        <i class="fas fa-blog text-3xl text-green-600 mb-2"></i>
                        <span class="text-sm font-medium text-gray-700">Create Post</span>
                    </a>
                    <a href="{{ route('admin.events.create') }}" 
                       class="flex flex-col items-center justify-center p-6 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition duration-300">
                        <i class="fas fa-calendar-plus text-3xl text-yellow-600 mb-2"></i>
                        <span class="text-sm font-medium text-gray-700">Create Event</span>
                    </a>
                    <a href="{{ route('admin.team-members.create') }}" 
                       class="flex flex-col items-center justify-center p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                        <i class="fas fa-user-plus text-3xl text-purple-600 mb-2"></i>
                        <span class="text-sm font-medium text-gray-700">Add Team Member</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Pages -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Pages</h3>
                </div>
                <div class="p-6">
                    @if($recentPages->count() > 0)
                        <ul class="space-y-3">
                            @foreach($recentPages as $page)
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $page->title }}</p>
                                        <p class="text-xs text-gray-500">by {{ $page->author->name }}</p>
                                    </div>
                                    <span class="text-xs px-2 py-1 bg-{{ $page->published ? 'green' : 'red' }}-100 text-{{ $page->published ? 'green' : 'red' }}-800 rounded-full">
                                        {{ $page->published ? 'Published' : 'Draft' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center py-4">No pages created yet</p>
                    @endif
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Posts</h3>
                </div>
                <div class="p-6">
                    @if($recentPosts->count() > 0)
                        <ul class="space-y-3">
                            @foreach($recentPosts as $post)
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $post->title }}</p>
                                        <p class="text-xs text-gray-500">by {{ $post->author->name }}</p>
                                    </div>
                                    <span class="text-xs px-2 py-1 bg-{{ $post->published ? 'green' : 'red' }}-100 text-{{ $post->published ? 'green' : 'red' }}-800 rounded-full">
                                        {{ $post->published ? 'Published' : 'Draft' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center py-4">No posts created yet</p>
                    @endif
                </div>
            </div>

            <!-- Recent Events -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Events</h3>
                </div>
                <div class="p-6">
                    @if($recentEvents->count() > 0)
                        <ul class="space-y-3">
                            @foreach($recentEvents as $event)
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $event->title }}</p>
                                        <p class="text-xs text-gray-500">by {{ $event->author->name }}</p>
                                    </div>
                                    <span class="text-xs px-2 py-1 bg-{{ $event->published ? 'green' : 'red' }}-100 text-{{ $event->published ? 'green' : 'red' }}-800 rounded-full">
                                        {{ $event->published ? 'Published' : 'Draft' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center py-4">No events created yet</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
        </div>
    </div>
</body>
</html>