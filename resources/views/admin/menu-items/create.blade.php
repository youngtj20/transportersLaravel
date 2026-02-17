<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Add New Menu Item</h1>
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
                    <a href="{{ route('admin.menu-items.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Menu
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Menu Item Details</h2>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2"></i>Menu Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter menu item title"
                               required>
                    </div>

                    <!-- URL -->
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-2"></i>URL/Link
                        </label>
                        <input type="text" 
                               name="url" 
                               id="url" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="/page-url or https://external.com"
                               required>
                        <p class="mt-1 text-sm text-gray-500">Internal links start with /, external links with http:// or https://</p>
                    </div>

                    <!-- Parent Menu Item -->
                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sitemap mr-2"></i>Parent Menu (Optional)
                        </label>
                        <select name="parent_id" 
                                id="parent_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">None (Top Level)</option>
                            <option value="1">Home</option>
                            <option value="2">About</option>
                            <option value="3">Events</option>
                            <option value="4">Gallery</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Select parent to create a submenu item</p>
                    </div>

                    <!-- Menu Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-bars mr-2"></i>Menu Type
                        </label>
                        <select name="type" 
                                id="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="main">Main Menu</option>
                            <option value="footer">Footer Menu</option>
                            <option value="mobile">Mobile Menu</option>
                            <option value="social">Social Media</option>
                        </select>
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sort-numeric-up mr-2"></i>Display Order
                        </label>
                        <input type="number" 
                               name="order" 
                               id="order" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="0"
                               min="0"
                               value="0">
                        <p class="mt-1 text-sm text-gray-500">Lower numbers appear first in the menu</p>
                    </div>

                    <!-- Icon -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-icons mr-2"></i>Icon Class (Optional)
                        </label>
                        <input type="text" 
                               name="icon" 
                               id="icon" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="fas fa-home">
                        <p class="mt-1 text-sm text-gray-500">Font Awesome icon class (e.g., fas fa-home)</p>
                    </div>

                    <!-- Link Target -->
                    <div>
                        <label for="target" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-external-link-alt mr-2"></i>Link Target
                        </label>
                        <select name="target" 
                                id="target" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="_self">Same Window</option>
                            <option value="_blank">New Window</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>Status
                        </label>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="published" 
                                   id="published" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   checked>
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Make this menu item visible
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="md:col-span-2 flex justify-end space-x-4 pt-6">
                        <button type="button" 
                                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i>Save Menu Item
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="mt-8 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Menu Preview</h2>
            </div>
            <div class="p-6">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-md bg-gray-100 text-gray-400">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">Menu Item Title</div>
                            <div class="text-sm text-gray-500">/menu-url</div>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-500">This is how your menu item will appear in the navigation menu.</p>
            </div>
        </div>
    </main>
</body>
</html>