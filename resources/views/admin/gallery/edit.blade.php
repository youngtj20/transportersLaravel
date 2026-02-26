<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="gallery-id" content="{{ $gallery->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter gallery description"></textarea>
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
        // Use session-based authentication for gallery management
        const apiBaseUrl = '/api';
        const galleryId = {{ $gallery->id }};
        
        // Check if user is authenticated
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        if (!isAuthenticated) {
            window.location.href = '{{ route('admin.login') }}';
        }
        
        // Debug: Log the gallery ID to console
        console.log('Gallery ID:', galleryId);
        
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('galleryForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');
            const fileUpload = document.getElementById('file-upload');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');

            // Load gallery data when page loads
            loadGalleryData();

            // Handle file upload for new images
            fileUpload.addEventListener('change', function(e) {
                const files = e.target.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    
                    // Check file size (limit to 2MB to prevent packet size issues)
                    if (file.size > 2 * 1024 * 1024) {
                        showMessage('File size exceeds 2MB limit. Please choose a smaller image.', 'error');
                        continue;
                    }
                    
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
                                <input type="hidden" name="new_image_data[]" value="${e.target.result}">
                                <input type="hidden" name="new_image_name[]" value="${file.name}">
                            `;
                            
                            imagePreviewContainer.appendChild(imgContainer);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                }
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Show loading state immediately
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                
                // Get form data
                const formData = {
                    title: document.getElementById('title').value,
                    event_name: document.getElementById('event_name').value,
                    event_date: document.getElementById('event_date').value,
                    description: document.getElementById('description').value,
                    images: [], // This will be populated properly
                    published: document.getElementById('published').checked
                };

                // Get existing images from the preview container (that weren't deleted)
                const existingImages = [];
                const imgElements = imagePreviewContainer.querySelectorAll('img');
                imgElements.forEach(img => {
                    const src = img.src;
                    // If it's a data URL, keep it as is (will be processed by backend)
                    if (src.startsWith('data:')) {
                        existingImages.push(src);
                    } else if (src.startsWith('http')) {
                        // For HTTP URLs, extract the path
                        try {
                            const url = new URL(src);
                            existingImages.push(url.pathname);
                        } catch (e) {
                            existingImages.push(src);
                        }
                    } else {
                        // For relative paths, keep as is
                        existingImages.push(src);
                    }
                });
                
                // Get new uploaded images (with size limitation)
                const newImageDataInputs = document.querySelectorAll('input[name="new_image_data[]"]');
                const newImageNameInputs = document.querySelectorAll('input[name="new_image_name[]"]');
                
                // Add placeholders for new images (in production, these would be actual uploaded files)
                for (let i = 0; i < newImageDataInputs.length; i++) {
                    const newImageName = newImageNameInputs[i].value;
                    // Store placeholder path instead of data URL
                    existingImages.push(`/images/${newImageName}`);
                }
                
                formData.images = existingImages;
                
                // Submit the update immediately
                submitGalleryUpdate(formData);
            });

            function loadGalleryData() {
                // First get the gallery data from the API using session authentication
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                fetch(`/api/event-galleries/${galleryId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(async response => {
                    if (!response.ok) {
                        // If authorized API fails, fall back to public API
                        throw new Error('Authentication failed or gallery not found');
                    }
                    return response.json();
                })
                .catch(async () => {
                    // Fall back to public API
                    console.log('Trying public API...'); 
                    const publicResponse = await fetch(`/api/event-galleries/${galleryId}`);
                    if (!publicResponse.ok) {
                        throw new Error('Gallery not found');
                    }
                    return publicResponse.json();
                })
                .then(data => {
                    if (data.success && data.data) {
                        const gallery = data.data;
                        
                        // Populate form fields
                        document.getElementById('title').value = gallery.title || '';
                        document.getElementById('event_name').value = gallery.event_name || '';
                        document.getElementById('event_date').value = gallery.event_date || '';
                        document.getElementById('description').value = gallery.description || '';
                        document.getElementById('published').checked = gallery.published || false;
                        
                        // Load existing images
                        if (gallery.images && Array.isArray(gallery.images)) {
                            gallery.images.forEach(imagePath => {
                                const imgContainer = document.createElement('div');
                                imgContainer.className = 'relative group';
                                
                                // Handle different image path formats
                                let imageUrl;
                                if (imagePath.startsWith('http')) {
                                    imageUrl = imagePath;
                                } else if (imagePath.startsWith('/')) {
                                    imageUrl = imagePath;
                                } else {
                                    imageUrl = `/images/${imagePath}`;
                                }
                                
                                imgContainer.innerHTML = `
                                    <img src="${imageUrl}" alt="Gallery Image" class="w-full h-32 object-cover rounded-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-md">
                                        <i class="fas fa-trash text-white cursor-pointer" onclick="removeImage(this)"></i>
                                    </div>
                                `;
                                
                                imagePreviewContainer.appendChild(imgContainer);
                            });
                        }
                    } else {
                        throw new Error('Gallery data not found');
                    }
                })
                .catch(async error => {
                    let errorMessage = 'Failed to load gallery data.';
                    
                    if (error instanceof Response) {
                        try {
                            const errorData = await error.json();
                            if (errorData.message) {
                                errorMessage = errorData.message;
                            } else if (error.status === 404) {
                                errorMessage = 'Gallery not found.';
                            }
                        } catch (e) {
                            errorMessage = 'Network error occurred while loading gallery data.';
                        }
                    }
                    
                    showMessage(errorMessage, 'error');
                    console.error('Error loading gallery data:', error);
                });
            }

            function submitGalleryUpdate(formData) {
                // Add CSRF token for session-based authentication
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/api/event-galleries/${galleryId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
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