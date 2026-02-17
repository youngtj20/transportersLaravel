<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Menu Items Management</h1>
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
                    <a href="{{ route('admin.menu-items.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Add Menu Item
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Menu Structure</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Top Level Menu Items -->
                    <div class="border border-gray-200 rounded-lg">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-md font-medium text-gray-900">Main Menu</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <!-- Menu Item 1 -->
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-md bg-blue-100 text-blue-600">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Home</div>
                                        <div class="text-sm text-gray-500">/</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                    <span class="text-xs text-gray-500">Order: 1</span>
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Item 2 with Submenu -->
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-md bg-green-100 text-green-600">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">About</div>
                                        <div class="text-sm text-gray-500">/about</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                    <span class="text-xs text-gray-500">Order: 2</span>
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Submenu Items (indented) -->
                            <div class="bg-gray-50">
                                <div class="flex items-center justify-between p-4 pl-12 hover:bg-gray-100 border-l-4 border-blue-200">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-md bg-blue-50 text-blue-500">
                                            <i class="fas fa-bullseye text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Our Vision</div>
                                            <div class="text-sm text-gray-500">/vision</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                        <span class="text-xs text-gray-500">Order: 1</span>
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-4 pl-12 hover:bg-gray-100 border-l-4 border-blue-200">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-md bg-blue-50 text-blue-500">
                                            <i class="fas fa-bullseye text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Our Mission</div>
                                            <div class="text-sm text-gray-500">/mission</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                        <span class="text-xs text-gray-500">Order: 2</span>
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Item 3 -->
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-md bg-yellow-100 text-yellow-600">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Events</div>
                                        <div class="text-sm text-gray-500">/events</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                    <span class="text-xs text-gray-500">Order: 3</span>
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Item 4 -->
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-md bg-purple-100 text-purple-600">
                                        <i class="fas fa-images"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Gallery</div>
                                        <div class="text-sm text-gray-500">/gallery</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                    <span class="text-xs text-gray-500">Order: 4</span>
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>