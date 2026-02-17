<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="page-id" content="{{ $id ?? '' }}">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Page</h1>
                </div>
                <div class="flex items-center space-x-4">
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
            <div id="loadingIndicator" class="p-6 text-center">
                <i class="fas fa-spinner fa-spin text-2xl"></i>
                <p class="mt-2">Loading page...</p>
            </div>
            <form id="pageForm" class="p-6 hidden">
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
                                  rows="10"
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
                            <i class="fas fa-save mr-2"></i>Update Page
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
        
        document.addEventListener('DOMContentLoaded', function() {
            const pageId = document.querySelector('meta[name="page-id"]').getAttribute('content');
            loadPage(pageId);
            
            const form = document.getElementById('pageForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const pageId = document.querySelector('meta[name="page-id"]').getAttribute('content');
                
                // Get form data
                const formData = {
                    title: document.getElementById('title').value,
                    slug: document.getElementById('slug').value,
                    content: document.getElementById('content').value,
                    meta_title: document.getElementById('meta_title').value || null,
                    meta_description: document.getElementById('meta_description').value || null,
                    featured_image: document.getElementById('featured_image').value || null,
                    page_type: document.getElementById('page_type').value || 'static',
                    template: document.getElementById('template').value || 'default',
                    published: document.getElementById('published').checked,
                };

                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';

                try {
                    const response = await fetch(`/api/pages/${pageId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Authorization': 'Bearer ' + apiToken
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showMessage('Page updated successfully!', 'success');
                        
                        // Redirect to pages list after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.pages.index") }}';
                        }, 1500);
                    } else {
                        let errorMessage = 'Failed to update page.';
                        if (result.message) {
                            errorMessage = result.message;
                        } else if (result.errors) {
                            errorMessage = Object.values(result.errors).flat().join(', ');
                        }
                        showMessage(errorMessage, 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An error occurred while updating the page.', 'error');
                } finally {
                    // Restore button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
            });

            function loadPage(id) {
                fetch(`/api/pages/${id}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Failed to load page');
                })
                .then(data => {
                    populateForm(data.data);
                    document.getElementById('loadingIndicator').classList.add('hidden');
                    document.getElementById('pageForm').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error loading page:', error);
                    showMessage('Failed to load page. Please try again.', 'error');
                    document.getElementById('loadingIndicator').innerHTML = '<p class="text-red-500">Failed to load page. Please refresh the page.</p>';
                });
            }

            function populateForm(page) {
                document.getElementById('title').value = page.title || '';
                document.getElementById('slug').value = page.slug || '';
                document.getElementById('content').value = page.content || '';
                
                if (page.meta_title) {
                    document.getElementById('meta_title').value = page.meta_title;
                }
                
                if (page.meta_description) {
                    document.getElementById('meta_description').value = page.meta_description;
                }
                
                if (page.featured_image) {
                    document.getElementById('featured_image').value = page.featured_image;
                }
                
                if (page.page_type) {
                    document.getElementById('page_type').value = page.page_type;
                }
                
                if (page.template) {
                    document.getElementById('template').value = page.template;
                }
                
                document.getElementById('published').checked = page.published;
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
                // Only auto-generate if slug is empty initially (for edit, we may want to preserve the existing slug)
                if (!document.getElementById('slug').dataset.modified) {
                    const title = this.value;
                    const slug = title.toLowerCase()
                        .replace(/[^\w\s-]/g, '') // Remove special characters
                        .replace(/\s+/g, '-'); // Replace spaces with hyphens
                    document.getElementById('slug').value = slug;
                }
            });
            
            document.getElementById('slug').addEventListener('input', function() {
                // Mark slug as modified to prevent auto-generation
                this.dataset.modified = 'true';
            });
        });
    </script>
</body>
</html>