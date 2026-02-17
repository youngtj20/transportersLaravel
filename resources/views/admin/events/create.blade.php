<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Create New Event</h1>
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
                    <a href="{{ route('admin.events.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Events
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Event Details</h2>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2"></i>Event Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter event title"
                               required>
                    </div>

                    <!-- Slug -->
                    <div class="md:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-2"></i>URL Slug
                        </label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="event-url-slug"
                               required>
                        <p class="mt-1 text-sm text-gray-500">This will be used in the URL (e.g., yoursite.com/events/slug)</p>
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>Event Date
                        </label>
                        <input type="date" 
                               name="event_date" 
                               id="event_date" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <!-- Time -->
                    <div>
                        <label for="event_time" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-2"></i>Event Time
                        </label>
                        <input type="time" 
                               name="event_time" 
                               id="event_time" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Location -->
                    <div class="md:col-span-2">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>Location
                        </label>
                        <input type="text" 
                               name="location" 
                               id="location" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter event location"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter event description..."></textarea>
                    </div>

                    <!-- Featured Image -->
                    <div class="md:col-span-2">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2"></i>Featured Image URL
                        </label>
                        <input type="url" 
                               name="featured_image" 
                               id="featured_image" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="https://example.com/image.jpg">
                    </div>

                    <!-- Speakers -->
                    <div class="md:col-span-2">
                        <label for="speakers" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-2"></i>Speakers/Key Participants
                        </label>
                        <textarea name="speakers" 
                                  id="speakers" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Speaker Name - Title/Position
Speaker Name - Title/Position"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter one speaker per line with their title/position</p>
                    </div>

                    <!-- Agenda -->
                    <div class="md:col-span-2">
                        <label for="agenda" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list mr-2"></i>Event Agenda
                        </label>
                        <textarea name="agenda" 
                                  id="agenda" 
                                  rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Time - Activity Description
Time - Activity Description"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter agenda items, one per line with time and description</p>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>Status
                        </label>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="published" 
                                   id="published" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Publish this event
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
                            <i class="fas fa-save mr-2"></i>Save Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>