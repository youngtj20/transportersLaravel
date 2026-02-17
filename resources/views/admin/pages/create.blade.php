<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- TinyMCE WYSIWYG Editor (Self-hosted) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Create New Page</h1>
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
                    <a href="{{ route('admin.pages.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Pages
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Page Details</h2>
            </div>
            <form id="pageForm" class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2"></i>Page Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter page title"
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
                               placeholder="page-url-slug"
                               required>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file-alt mr-2"></i>Content
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter page content..."></textarea>
                    </div>

                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2"></i>Meta Title (SEO)
                        </label>
                        <input type="text" 
                               name="meta_title" 
                               id="meta_title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter meta title for SEO">
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Meta Description (SEO)
                        </label>
                        <textarea name="meta_description" 
                                  id="meta_description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter meta description for SEO"></textarea>
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

                    <!-- Page Type -->
                    <div>
                        <label for="page_type" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file mr-2"></i>Page Type
                        </label>
                        <select name="page_type" 
                                id="page_type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="static">Static Page</option>
                            <option value="blog">Blog Page</option>
                            <option value="landing">Landing Page</option>
                        </select>
                    </div>

                    <!-- Template -->
                    <div>
                        <label for="template" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-paint-brush mr-2"></i>Template
                        </label>
                        <select name="template" 
                                id="template" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="default">Default Template</option>
                            <option value="full-width">Full Width</option>
                            <option value="sidebar">With Sidebar</option>
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
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Publish this page
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.pages.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i>Save Page
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
        
        // Debug: Log the token to console to verify it exists
        console.log('API Token:', apiToken ? 'Exists' : 'Missing');
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize TinyMCE WYSIWYG Editor
            tinymce.init({
                selector: '#content',
                height: 500,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        
            const form = document.getElementById('pageForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');
        
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
                    content: tinymce.get('content').getContent(), // Get content from TinyMCE
                    meta_title: document.getElementById('meta_title').value || null,
                    meta_description: document.getElementById('meta_description').value || null,
                    featured_image: document.getElementById('featured_image').value || null,
                    page_type: document.getElementById('page_type').value || 'static',
                    template: document.getElementById('template').value || 'default',
                    published: document.getElementById('published').checked
                };

                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

                try {
                    const response = await fetch('/api/pages', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Authorization': 'Bearer ' + apiToken
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();
                    
                    console.log('API Response:', response.status, result);

                    if (response.ok) {
                        showMessage('Page created successfully!', 'success');
                                            
                        // Reset form
                        form.reset();
                        tinymce.get('content').setContent(''); // Reset TinyMCE content
                        tinymce.get('content').setContent(''); // Reset TinyMCE content
                        
                        // Redirect to pages list after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.pages.index") }}';
                        }, 1500);
                    } else {
                        let errorMessage = 'Failed to create page.';
                        if (result.message) {
                            errorMessage = result.message;
                        } else if (result.errors) {
                            errorMessage = Object.values(result.errors).flat().join(', ');
                        } else if (response.status === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        } else if (response.status === 404) {
                            errorMessage = 'API endpoint not found. Please contact administrator.';
                        }
                        showMessage(errorMessage, 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An error occurred while saving the page. Please check console for details.', 'error');
                } finally {
                    // Restore button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
            });

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