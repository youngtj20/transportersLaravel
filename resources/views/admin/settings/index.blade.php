<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Application Settings</h1>
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
                    <a href="{{ route('admin.dashboard') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Settings Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Settings Categories</h2>
                    </div>
                    <div class="p-4">
                        <nav class="space-y-1">
                            <a href="#general" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md">
                                <i class="fas fa-cog mr-3"></i>
                                General Settings
                            </a>
                            <a href="#seo" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                                <i class="fas fa-search mr-3"></i>
                                SEO Settings
                            </a>
                            <a href="#social" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                                <i class="fas fa-hashtag mr-3"></i>
                                Social Media
                            </a>
                            <a href="#appearance" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                                <i class="fas fa-palette mr-3"></i>
                                Appearance
                            </a>
                            <a href="#contact" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">
                                <i class="fas fa-address-card mr-3"></i>
                                Contact Info
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="lg:col-span-2">
                <!-- General Settings -->
                <div id="general" class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">General Settings</h2>
                    </div>
                    <form class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Site Name -->
                            <div class="md:col-span-2">
                                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-signature mr-2"></i>Site Name
                                </label>
                                <input type="text" 
                                       name="site_name" 
                                       id="site_name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="Transporters for Tinubu 2027"
                                       required>
                            </div>

                            <!-- Site Description -->
                            <div class="md:col-span-2">
                                <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2"></i>Site Description
                                </label>
                                <textarea name="site_description" 
                                          id="site_description" 
                                          rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Official website for the Transporters for Tinubu 2027 movement and campaign</textarea>
                            </div>

                            <!-- Site Keywords -->
                            <div class="md:col-span-2">
                                <label for="site_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tags mr-2"></i>Site Keywords
                                </label>
                                <input type="text" 
                                       name="site_keywords" 
                                       id="site_keywords" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="transporters, tinubu, 2027, nigeria, campaign, politics">
                                <p class="mt-1 text-sm text-gray-500">Comma-separated keywords for SEO</p>
                            </div>

                            <!-- Admin Email -->
                            <div>
                                <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2"></i>Admin Email
                                </label>
                                <input type="email" 
                                       name="admin_email" 
                                       id="admin_email" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="admin@transportersfortinubu.ng">
                            </div>

                            <!-- Site URL -->
                            <div>
                                <label for="site_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-link mr-2"></i>Site URL
                                </label>
                                <input type="url" 
                                       name="site_url" 
                                       id="site_url" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="https://transportersfortinubu.ng">
                            </div>

                            <!-- Site Status -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-toggle-on mr-2"></i>Site Status
                                </label>
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="site_active" 
                                           id="site_active" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           checked>
                                    <label for="site_active" class="ml-2 block text-sm text-gray-900">
                                        Site is currently active and accessible
                                    </label>
                                </div>
                            </div>

                            <!-- Maintenance Mode -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tools mr-2"></i>Maintenance Mode
                                </label>
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="maintenance_mode" 
                                           id="maintenance_mode" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="maintenance_mode" class="ml-2 block text-sm text-gray-900">
                                        Enable maintenance mode (visitors will see maintenance page)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-save mr-2"></i>Save General Settings
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SEO Settings -->
                <div id="seo" class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">SEO Settings</h2>
                    </div>
                    <form class="p-6">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Default Meta Title -->
                            <div>
                                <label for="default_meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2"></i>Default Meta Title
                                </label>
                                <input type="text" 
                                       name="default_meta_title" 
                                       id="default_meta_title" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Transporters for Tinubu 2027 - Official Campaign Website">
                            </div>

                            <!-- Default Meta Description -->
                            <div>
                                <label for="default_meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2"></i>Default Meta Description
                                </label>
                                <textarea name="default_meta_description" 
                                          id="default_meta_description" 
                                          rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Join the Transporters for Tinubu 2027 movement. Official campaign website for Nigeria's political transportation network."></textarea>
                            </div>

                            <!-- Google Analytics ID -->
                            <div>
                                <label for="google_analytics_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-google mr-2"></i>Google Analytics ID
                                </label>
                                <input type="text" 
                                       name="google_analytics_id" 
                                       id="google_analytics_id" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="GA-XXXXXXXXX">
                            </div>

                            <!-- Google Search Console -->
                            <div>
                                <label for="google_search_console" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-google mr-2"></i>Google Search Console Verification
                                </label>
                                <input type="text" 
                                       name="google_search_console" 
                                       id="google_search_console" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Verification code">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-save mr-2"></i>Save SEO Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>