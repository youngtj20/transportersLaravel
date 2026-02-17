<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Gallery Management</h1>
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
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium mr-2">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                    <a href="{{ route('admin.gallery.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Add New Gallery
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Gallery Albums</h2>
            </div>
            
            <!-- Search and Filter Controls -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="w-full md:w-1/3">
                        <input type="text" 
                               id="searchInput" 
                               placeholder="Search galleries..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex space-x-4">
                        <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        <select id="eventFilter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Events</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Loading indicator -->
            <div id="loadingIndicator" class="hidden p-6 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                <p class="mt-2 text-gray-600">Loading galleries...</p>
            </div>
            
            <!-- Galleries Grid -->
            <div id="galleriesGridContainer">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-images text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Event Photos 2027</h3>
                                    <p class="text-sm text-gray-500">January 15, 2027</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Collection of photos from the Transporters for Tinubu 2027 launch event.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                                <div class="flex space-x-2">
                                    <a href="/admin/gallery/1/edit" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900 delete-gallery" data-gallery-id="1" data-gallery-title="Event Photos 2027">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-images text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Meeting Photos</h3>
                                    <p class="text-sm text-gray-500">December 10, 2026</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Photos from monthly coordination meeting with stakeholders.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
                                <div class="flex space-x-2">
                                    <a href="/admin/gallery/2/edit" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900 delete-gallery" data-gallery-id="2" data-gallery-title="Meeting Photos">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center mb-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-images text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Campaign Rally</h3>
                                    <p class="text-sm text-gray-500">November 5, 2026</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Photos from the major campaign rally in Lagos State.</p>
                            <div class="flex justify-between items-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                                <div class="flex space-x-2">
                                    <a href="/admin/gallery/3/edit" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900 delete-gallery" data-gallery-id="3" data-gallery-title="Campaign Rally">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- No Data Message -->
            <div id="noDataMessage" class="hidden p-12 text-center">
                <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No galleries found</h3>
                <p class="text-gray-500 mb-4">Get started by creating a new gallery album.</p>
                <a href="{{ route('admin.gallery.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>Add New Gallery
                </a>
            </div>
        </div>
    </main>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Delete Gallery</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this gallery? This action cannot be undone.
                    </p>
                </div>
                <div class="items-center px-4 py-3 mt-5 border-t border-gray-200">
                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-3">
                        Delete
                    </button>
                    <button id="cancelDeleteBtn" class="px-4 py-2 bg-gray-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Get the API token from session via a meta tag or script variable
        const apiToken = "{{ session('api_token') }}";
        
        // Debug: Log the token to console to verify it exists
        console.log('API Token:', apiToken ? 'Exists' : 'Missing');
        
        // Global variables for pagination
        let currentPage = 1;
        let totalPages = 1;
        let currentFilters = {
            search: '',
            status: '',
            event: ''
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            // Load galleries on page load
            loadGalleries();
            
            // Set up event listeners
            document.getElementById('searchInput').addEventListener('input', handleSearch);
            document.getElementById('statusFilter').addEventListener('change', handleFilterChange);
            document.getElementById('eventFilter').addEventListener('change', handleFilterChange);
            document.getElementById('cancelDeleteBtn').addEventListener('click', hideDeleteModal);
            
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', performDelete);
            }
        });
        
        function loadGalleries(page = 1) {
            // Validate that we have a token
            if (!apiToken) {
                showNotification('Authentication error: No API token available. Please log in again.', 'error');
                return;
            }
            
            // Show loading indicator
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('galleriesGridContainer').classList.add('hidden');
            document.getElementById('noDataMessage').classList.add('hidden');
            
            // Prepare query parameters
            const params = new URLSearchParams({
                page: page,
                search: currentFilters.search,
                status: currentFilters.status,
                event: currentFilters.event
            });
            
            fetch(`/api/event-galleries?${params}`, {
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
                renderGalleries(data.data);
            })
            .catch(async error => {
                let errorMessage = 'Failed to load galleries.';
                
                if (error instanceof Response) {
                    try {
                        const errorData = await error.json();
                        if (errorData.message) {
                            errorMessage = errorData.message;
                        } else if (error.status === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        } else if (error.status === 404) {
                            errorMessage = 'API endpoint not found.';
                        }
                    } catch (e) {
                        if (error.status === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        } else {
                            errorMessage = 'Network error occurred while loading galleries.';
                        }
                    }
                }
                
                showNotification(errorMessage, 'error');
                console.error('Error loading galleries:', error);
            })
            .finally(() => {
                // Hide loading indicator
                document.getElementById('loadingIndicator').classList.add('hidden');
                document.getElementById('galleriesGridContainer').classList.remove('hidden');
            });
        }
        
        function renderGalleries(galleries) {
            const container = document.getElementById('galleriesGridContainer');
            const grid = container.querySelector('.grid');
            
            if (galleries.length === 0) {
                document.getElementById('galleriesGridContainer').classList.add('hidden');
                document.getElementById('noDataMessage').classList.remove('hidden');
                return;
            }
            
            document.getElementById('galleriesGridContainer').classList.remove('hidden');
            document.getElementById('noDataMessage').classList.add('hidden');
            
            grid.innerHTML = '';
            
            galleries.forEach(gallery => {
                const galleryCard = document.createElement('div');
                galleryCard.className = 'bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden';
                
                galleryCard.innerHTML = `
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                <i class="fas fa-images text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">\${escapeHtml(gallery.title)}</h3>
                                <p class="text-sm text-gray-500">\${gallery.event_date ? formatDate(gallery.event_date) : 'No date'}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">\${gallery.description || 'No description available'}</p>
                        <div class="flex justify-between items-center">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full \${gallery.published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                \${gallery.published ? 'Published' : 'Draft'}
                            </span>
                            <div class="flex space-x-2">
                                <a href="/admin/gallery/\${gallery.id}/edit" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-900 delete-gallery" data-gallery-id="\${gallery.id}" data-gallery-title="\${escapeHtml(gallery.title)}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                
                grid.appendChild(galleryCard);
            });
            
            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-gallery').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const galleryId = this.getAttribute('data-gallery-id');
                    const galleryTitle = this.getAttribute('data-gallery-title');
                    showDeleteModal(galleryId, galleryTitle);
                });
            });
        }
        
        function handleSearch(e) {
            currentFilters.search = e.target.value.trim();
            currentPage = 1; // Reset to first page when searching
            loadGalleries(currentPage);
        }
        
        function handleFilterChange() {
            currentFilters.status = document.getElementById('statusFilter').value;
            currentFilters.event = document.getElementById('eventFilter').value;
            currentPage = 1; // Reset to first page when filtering
            loadGalleries(currentPage);
        }
        
        function showDeleteModal(galleryId, galleryTitle) {
            document.getElementById('confirmDeleteBtn').dataset.galleryId = galleryId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
        
        async function performDelete() {
            const galleryId = document.getElementById('confirmDeleteBtn').dataset.galleryId;
            
            if (!galleryId) {
                showNotification('Invalid gallery ID.', 'error');
                return;
            }
            
            try {
                const response = await fetch(`/api/event-galleries/\${galleryId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    showNotification('Gallery deleted successfully!', 'success');
                    hideDeleteModal();
                    loadGalleries(currentPage); // Reload current page
                } else {
                    let errorMessage = 'Failed to delete gallery.';
                    if (result.message) {
                        errorMessage = result.message;
                    } else if (response.status === 401) {
                        errorMessage = 'Unauthorized access. Please log in again.';
                    } else if (response.status === 404) {
                        errorMessage = 'Gallery not found.';
                    }
                    showNotification(errorMessage, 'error');
                }
            } catch (error) {
                console.error('Error deleting gallery:', error);
                showNotification('An error occurred while deleting the gallery.', 'error');
            }
        }
        
        function showNotification(message, type) {
            // Remove any existing notification
            const existingNotification = document.querySelector('.notification-toast');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.className = `notification-toast fixed top-4 right-4 z-50 px-6 py-4 rounded-md shadow-lg text-white \${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
        
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString();
        }
    </script>
</body>
</html>