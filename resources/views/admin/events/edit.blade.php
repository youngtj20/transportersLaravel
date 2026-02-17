<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="event-id" content="{{ $id ?? '' }}">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
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
            <form id="eventForm" class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
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
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-2"></i>URL Slug
                        </label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="event-url-slug"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter event description..."></textarea>
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2"></i>Event Date & Time
                        </label>
                        <input type="datetime-local" 
                               name="event_date" 
                               id="event_date" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker mr-2"></i>Location
                        </label>
                        <input type="text" 
                               name="location" 
                               id="location" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter event location"
                               required>
                    </div>

                    <!-- Featured Image -->
                    <div>
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
                    <div>
                        <label for="speakers" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-2"></i>Speakers
                        </label>
                        <textarea name="speakers" 
                                  id="speakers" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Speaker 1
Speaker 2
Speaker 3"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter one speaker per line</p>
                    </div>

                    <!-- Agenda -->
                    <div>
                        <label for="agenda" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list mr-2"></i>Agenda
                        </label>
                        <textarea name="agenda" 
                                  id="agenda" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Session 1: Time - Topic
Session 2: Time - Topic
Session 3: Time - Topic"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter agenda items in format: 'Time - Topic' per line</p>
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
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Publish this event
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.events.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i>Update Event
                        </button>
                    </div>
                </div>
            </form>
            
            <!-- Success/Error Messages -->
            <div id="messageContainer" class="hidden fixed top-4 right-4 z-50 max-w-sm">
                <div id="messageContent" class="p-4 rounded-md shadow-lg"></div>
            </div>
        </div>
    </main>
    
    <script>
        // Get the API token from session via a meta tag or script variable
        const apiToken = "{{ session('api_token') }}";
        const eventId = document.querySelector('meta[name="event-id"]').getAttribute('content');
        
        // Debug: Log the token to console to verify it exists
        console.log('API Token:', apiToken ? 'Exists' : 'Missing');
        console.log('Event ID:', eventId);
        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('eventForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');

            // Load event data when page loads
            loadEventData();

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Validate that we have a token
                if (!apiToken) {
                    showMessage('Authentication error: No API token available. Please log in again.', 'error');
                    return;
                }
                
                // Get form data
                const formData = {
                    title: document.getElementById('title').value,
                    slug: document.getElementById('slug').value,
                    description: document.getElementById('description').value,
                    event_date: document.getElementById('event_date').value,
                    location: document.getElementById('location').value,
                    featured_image: document.getElementById('featured_image').value || null,
                    speakers: [],
                    agenda: [],
                    published: document.getElementById('published').checked
                };

                // Process speakers
                const speakersInput = document.getElementById('speakers').value;
                if (speakersInput.trim() !== '') {
                    formData.speakers = speakersInput.split('\n').map(speaker => speaker.trim()).filter(speaker => speaker !== '');
                }

                // Process agenda
                const agendaInput = document.getElementById('agenda').value;
                if (agendaInput.trim() !== '') {
                    formData.agenda = agendaInput.split('\n').map(item => item.trim()).filter(item => item !== '');
                }

                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';

                fetch(`/api/events/${eventId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(result => {
                    console.log('API Response:', result);

                    if (result.success) {
                        showMessage('Event updated successfully!', 'success');
                        
                        // Redirect to events list after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.events.index") }}';
                        }, 1500);
                    } else {
                        let errorMessage = 'Failed to update event.';
                        if (result.message) {
                            errorMessage = result.message;
                        } else if (result.errors) {
                            errorMessage = Object.values(result.errors).flat().join(', ');
                        } else if (result.code === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        }
                        showMessage(errorMessage, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('An error occurred while updating the event. Please check console for details.', 'error');
                })
                .finally(() => {
                    // Restore button state
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
            });

            function loadEventData() {
                if (!apiToken) {
                    showMessage('Authentication error: No API token available. Please log in again.', 'error');
                    return;
                }

                fetch(`/api/events/${eventId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw response;
                    }
                    return response.json();
                })
                .then(data => {
                    const event = data.data;
                    
                    // Populate form fields
                    document.getElementById('title').value = event.title || '';
                    document.getElementById('slug').value = event.slug || '';
                    document.getElementById('description').value = event.description || '';
                    
                    // Format date for datetime-local input (YYYY-MM-DDTHH:MM)
                    if (event.event_date) {
                        const date = new Date(event.event_date);
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const day = String(date.getDate()).padStart(2, '0');
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;
                        document.getElementById('event_date').value = formattedDate;
                    }
                    
                    document.getElementById('location').value = event.location || '';
                    document.getElementById('featured_image').value = event.featured_image || '';
                    document.getElementById('published').checked = event.published;
                    
                    // Set speakers
                    if (event.speakers && Array.isArray(event.speakers)) {
                        document.getElementById('speakers').value = event.speakers.join('\n');
                    }
                    
                    // Set agenda
                    if (event.agenda && Array.isArray(event.agenda)) {
                        document.getElementById('agenda').value = event.agenda.join('\n');
                    }
                    
                    console.log('Event data loaded successfully');
                })
                .catch(async error => {
                    let errorMessage = 'Failed to load event data.';
                    
                    if (error instanceof Response) {
                        try {
                            const errorData = await error.json();
                            if (errorData.message) {
                                errorMessage = errorData.message;
                            } else if (error.status === 401) {
                                errorMessage = 'Unauthorized access. Please log in again.';
                            } else if (error.status === 404) {
                                errorMessage = 'Event not found.';
                            }
                        } catch (e) {
                            if (error.status === 401) {
                                errorMessage = 'Unauthorized access. Please log in again.';
                            } else {
                                errorMessage = 'Network error occurred while loading event data.';
                            }
                        }
                    }
                    
                    showMessage(errorMessage, 'error');
                    console.error('Error loading event data:', error);
                });
            }

            function showMessage(message, type) {
                messageContainer.classList.remove('hidden');
                messageContainer.className = 'fixed top-4 right-4 z-50 max-w-sm ';
                
                if (type === 'success') {
                    messageContainer.classList.add('bg-green-100', 'border', 'border-green-400', 'text-green-700');
                } else {
                    messageContainer.classList.add('bg-red-100', 'border', 'border-red-400', 'text-red-700');
                }
                
                messageContent.textContent = message;
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    messageContainer.classList.add('hidden');
                }, 5000);
            }

            // Auto-generate slug from title
            document.getElementById('title').addEventListener('input', function() {
                if (!document.getElementById('slug').value) { // Only auto-generate if slug is empty
                    const title = this.value;
                    const slug = title.toLowerCase()
                        .replace(/[^\w\s-]/g, '') // Remove special characters
                        .replace(/\s+/g, '-'); // Replace spaces with hyphens
                    document.getElementById('slug').value = slug;
                }
            });
        });
    </script>
</body>
</html>