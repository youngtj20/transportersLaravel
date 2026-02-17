<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Members Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Team Members Management</h1>
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
                    <a href="{{ route('admin.team-members.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Add New Member
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">All Team Members</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Team Member Card 1 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">John Smith</h3>
                                    <p class="text-sm text-gray-500">Campaign Coordinator</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Experienced political strategist with over 10 years in campaign management and grassroots organizing.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
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

                    <!-- Team Member Card 2 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Sarah Johnson</h3>
                                    <p class="text-sm text-gray-500">Communications Director</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Media relations expert with extensive experience in political communications and public affairs.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
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

                    <!-- Team Member Card 3 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Michael Brown</h3>
                                    <p class="text-sm text-gray-500">Finance Manager</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Financial professional with expertise in campaign finance and budget management.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
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
    </main>
</body>
</html>