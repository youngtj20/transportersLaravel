<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="gallery-id" content="{{ $id ?? '' }}">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Gallery</h1>
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
                    <a href="{{ route('admin.gallery.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Galleries
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Gallery Details</h2>
            </div>
            <form id="galleryForm" class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2"></i>Gallery Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter gallery title"
                               required>
                    </div>

                    <!-- Event Name -->
                    <div>
                        <label for="event_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2"></i>Event Name
                        </label>
                        <input type="text" 
                               name="event_name" 
                               id="event_name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Event name"
                               required>
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-day mr-2"></i>Event Date
                        </label>
                        <input type="date" 
                               name="event_date" 
                               id="event_date" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <!-- Gallery Images -->
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-images mr-2"></i>Gallery Images
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload files</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                        </div>
                        <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <!-- Existing images will be loaded here -->
                        </div>
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
                                Publish this gallery
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.gallery.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i>Update Gallery
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
        const galleryId = document.querySelector('meta[name="gallery-id"]').getAttribute('content');
        
        // Debug: Log the token to console to verify it exists
        console.log('API Token:', apiToken ? 'Exists' : 'Missing');
        console.log('Gallery ID:', galleryId);
        
        // Check if token exists, if not, show error message
        if (!apiToken) {
            document.addEventListener('DOMContentLoaded', function() {
                showMessage('Authentication error: No API token available. Please log in again.', 'error');
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('galleryForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');
            const fileUpload = document.getElementById('file-upload');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');

            // Load gallery data when page loads
            loadGalleryData();

            // Handle file upload
            fileUpload.addEventListener('change', function(e) {
                const files = e.target.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'relative group';
                            
                            imgContainer.innerHTML = `
                                <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover rounded-md">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-md">
                                    <i class="fas fa-trash text-white cursor-pointer" onclick="removeImage(this)"></i>
                                </div>
                            `;
                            
                            imagePreviewContainer.appendChild(imgContainer);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                }
            });

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
                    event_name: document.getElementById('event_name').value,
                    event_date: document.getElementById('event_date').value,
                    images: [], // This would be populated from uploaded images
                    published: document.getElementById('published').checked
                };

                // Get selected files
                const files = fileUpload.files;
                const imageUrls = [];
                
                // In a real implementation, we would upload the files first and get URLs
                // For now, we'll simulate this by using the preview URLs
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imageUrls.push(e.target.result);
                        
                        if (imageUrls.length === files.length) {
                            // All files processed, now send the request
                            submitGalleryUpdate(formData, imageUrls);
                        }
                    };
                    
                    reader.readAsDataURL(file);
                }
                
                // If no files selected, submit anyway
                if (files.length === 0) {
                    submitGalleryUpdate(formData, []);
                }
            });

            function loadGalleryData() {
                if (!apiToken) {
                    showMessage('Authentication error: No API token available. Please log in again.', 'error');
                    return;
                }

                fetch(`/api/event-galleries/${galleryId}`, {
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
                    const gallery = data.data;
                    
                    // Populate form fields
                    document.getElementById('title').value = gallery.title || '';
                    document.getElementById('event_name').value = gallery.event_name || '';
                    document.getElementById('event_date').value = gallery.event_date ? gallery.event_date.substring(0, 10) : '';
                    document.getElementById('published').checked = gallery.published;
                    
                    // Display existing images
                    if (gallery.images && Array.isArray(gallery.images)) {
                        imagePreviewContainer.innerHTML = '';
                        gallery.images.forEach(imageUrl => {
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'relative group';
                            
                            imgContainer.innerHTML = `
                                <img src="${imageUrl}" alt="Gallery Image" class="w-full h-32 object-cover rounded-md">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-md">
                                    <i class="fas fa-trash text-white cursor-pointer" onclick="removeExistingImage(this, '${imageUrl}')"></i>
                                </div>
                            `;
                            
                            imagePreviewContainer.appendChild(imgContainer);
                        });
                    }
                    
                    console.log('Gallery data loaded successfully');
                })
                .catch(async error => {
                    let errorMessage = 'Failed to load gallery data.';
                    
                    if (error instanceof Response) {
                        try {
                            const errorData = await error.json();
                            if (errorData.message) {
                                errorMessage = errorData.message;
                            } else if (error.status === 401) {
                                errorMessage = 'Unauthorized access. Please log in again.';
                            } else if (error.status === 404) {
                                errorMessage = 'Gallery not found.';
                            }
                        } catch (e) {
                            if (error.status === 401) {
                                errorMessage = 'Unauthorized access. Please log in again.';
                            } else {
                                errorMessage = 'Network error occurred while loading gallery data.';
                            }
                        }
                    }
                    
                    showMessage(errorMessage, 'error');
                    console.error('Error loading gallery data:', error);
                });
            }

            function submitGalleryUpdate(formData, imageUrls) {
                // In a real implementation, we would upload images first and get URLs
                // For now, we'll send the form data with existing images + new ones
                formData.images = imageUrls; // In reality, we'd combine existing and new images
                
                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';

                fetch(`/api/event-galleries/${galleryId}`, {
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
                        showMessage('Gallery updated successfully!', 'success');
                        
                        // Redirect to galleries list after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.gallery.index") }}';
                        }, 1500);
                    } else {
                        let errorMessage = 'Failed to update gallery.';
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
                    showMessage('An error occurred while updating the gallery. Please check console for details.', 'error');
                })
                .finally(() => {
                    // Restore button state
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
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
        });
        
        function removeImage(element) {
            const imgContainer = element.closest('.relative');
            imgContainer.remove();
        }
        
        function removeExistingImage(element, imageUrl) {
            // In a real implementation, this would remove the image from the server
            const imgContainer = element.closest('.relative');
            imgContainer.remove();
        }
    </script>
</body>
</html>