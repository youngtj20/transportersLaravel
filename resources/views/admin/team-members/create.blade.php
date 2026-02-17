<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team Member - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Add New Team Member</h1>
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
                    <a href="{{ route('admin.team-members.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Team
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Team Member Details</h2>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Full Name
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter full name"
                               required>
                    </div>

                    <!-- Position -->
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase mr-2"></i>Position/Title
                        </label>
                        <input type="text" 
                               name="position" 
                               id="position" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter position or title"
                               required>
                    </div>

                    <!-- Bio -->
                    <div class="md:col-span-2">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Bio/Description
                        </label>
                        <textarea name="bio" 
                                  id="bio" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter team member bio or description..."></textarea>
                    </div>

                    <!-- Image URL -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2"></i>Profile Image URL
                        </label>
                        <input type="url" 
                               name="image" 
                               id="image" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="https://example.com/image.jpg">
                        <p class="mt-1 text-sm text-gray-500">Enter the URL of the team member's profile image</p>
                    </div>

                    <!-- Social Media Links -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Social Media Links</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Facebook -->
                            <div>
                                <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-facebook mr-2"></i>Facebook Profile
                                </label>
                                <input type="url" 
                                       name="facebook" 
                                       id="facebook" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="https://facebook.com/username">
                            </div>

                            <!-- Twitter -->
                            <div>
                                <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-twitter mr-2"></i>Twitter Profile
                                </label>
                                <input type="url" 
                                       name="twitter" 
                                       id="twitter" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="https://twitter.com/username">
                            </div>

                            <!-- Instagram -->
                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-instagram mr-2"></i>Instagram Profile
                                </label>
                                <input type="url" 
                                       name="instagram" 
                                       id="instagram" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="https://instagram.com/username">
                            </div>

                            <!-- LinkedIn -->
                            <div>
                                <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-linkedin mr-2"></i>LinkedIn Profile
                                </label>
                                <input type="url" 
                                       name="linkedin" 
                                       id="linkedin" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>Visibility Status
                        </label>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="published" 
                                   id="published" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   checked>
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Make this team member visible on the website
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
                            <i class="fas fa-save mr-2"></i>Save Team Member
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>