<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- TinyMCE WYSIWYG Editor (Self-hosted) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <meta name="post-id" content="{{ $id ?? '' }}">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Post</h1>
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
                    <a href="{{ route('admin.posts.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Posts
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Post Details</h2>
            </div>
            <form id="postForm" class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2"></i>Post Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter post title"
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
                               placeholder="post-url-slug"
                               required>
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2"></i>Excerpt
                        </label>
                        <textarea name="excerpt" 
                                  id="excerpt" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Brief excerpt for post preview..."></textarea>
                        <p class="mt-1 text-sm text-gray-500">Short summary that appears in post listings</p>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-file-alt mr-2"></i>Content
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="12"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Enter post content..."></textarea>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-2"></i>Category
                        </label>
                        <select name="category" 
                                id="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            <option value="announcement">Announcement</option>
                            <option value="updates">Updates</option>
                            <option value="events">Events</option>
                            <option value="news">News</option>
                            <option value="opinion">Opinion</option>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2"></i>Tags
                        </label>
                        <input type="text" 
                               name="tags" 
                               id="tags" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="tag1, tag2, tag3">
                        <p class="mt-1 text-sm text-gray-500">Separate tags with commas</p>
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

                    <!-- Gallery Images -->
                    <div>
                        <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-images mr-2"></i>Gallery Images (URLs)
                        </label>
                        <textarea name="gallery_images" 
                                  id="gallery_images" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="https://example.com/image1.jpg
https://example.com/image2.jpg
https://example.com/image3.jpg"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter image URLs, one per line</p>
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
                                Publish this post
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.posts.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-2"></i>Update Post
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
        const postId = document.querySelector('meta[name="post-id"]').getAttribute('content');
        
        // Debug: Log the token to console to verify it exists
        console.log('API Token:', apiToken ? 'Exists' : 'Missing');
        console.log('Post ID:', postId);
        
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

            const form = document.getElementById('postForm');
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');

            // Load post data when page loads
            loadPostData();

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
                    excerpt: document.getElementById('excerpt').value,
                    content: tinymce.get('content').getContent(), // Get content from TinyMCE
                    category: document.getElementById('category').value || null,
                    featured_image: document.getElementById('featured_image').value || null,
                    published: document.getElementById('published').checked,
                    tags: [],
                    gallery_images: []
                };

                // Process tags
                const tagsInput = document.getElementById('tags').value;
                if (tagsInput.trim() !== '') {
                    formData.tags = tagsInput.split(',').map(tag => tag.trim()).filter(tag => tag !== '');
                }

                // Process gallery images
                const galleryInput = document.getElementById('gallery_images').value;
                if (galleryInput.trim() !== '') {
                    formData.gallery_images = galleryInput.split('\n').map(url => url.trim()).filter(url => url !== '');
                }

                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';

                try {
                    const response = await fetch(`/api/posts/${postId}`, {
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
                    
                    console.log('API Response:', response.status, result);

                    if (response.ok) {
                        showMessage('Post updated successfully!', 'success');
                        
                        // Redirect to posts list after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.posts.index") }}';
                        }, 1500);
                    } else {
                        let errorMessage = 'Failed to update post.';
                        if (result.message) {
                            errorMessage = result.message;
                        } else if (result.errors) {
                            errorMessage = Object.values(result.errors).flat().join(', ');
                        } else if (response.status === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        } else if (response.status === 404) {
                            errorMessage = 'Post not found.';
                        }
                        showMessage(errorMessage, 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An error occurred while updating the post. Please check console for details.', 'error');
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

            async function loadPostData() {
                if (!apiToken) {
                    showMessage('Authentication error: No API token available. Please log in again.', 'error');
                    return;
                }

                try {
                    const response = await fetch(`/api/posts/${postId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Authorization': 'Bearer ' + apiToken
                        }
                    });

                    const result = await response.json();
                    
                    if (response.ok) {
                        const post = result.data;
                        
                        // Populate form fields
                        document.getElementById('title').value = post.title;
                        document.getElementById('slug').value = post.slug;
                        document.getElementById('excerpt').value = post.excerpt || '';
                        document.getElementById('category').value = post.category || '';
                        document.getElementById('featured_image').value = post.featured_image || '';
                        document.getElementById('published').checked = post.published;
                        
                        // Set content in TinyMCE after it's initialized
                        setTimeout(() => {
                            if (tinymce.get('content')) {
                                tinymce.get('content').setContent(post.content || '');
                            }
                        }, 100);
                        
                        // Set tags
                        if (post.tags && Array.isArray(post.tags)) {
                            document.getElementById('tags').value = post.tags.join(', ');
                        }
                        
                        // Set gallery images
                        if (post.gallery_images && Array.isArray(post.gallery_images)) {
                            document.getElementById('gallery_images').value = post.gallery_images.join('\n');
                        }
                        
                        console.log('Post data loaded successfully');
                    } else {
                        let errorMessage = 'Failed to load post data.';
                        if (result.message) {
                            errorMessage = result.message;
                        } else if (response.status === 401) {
                            errorMessage = 'Unauthorized access. Please log in again.';
                        } else if (response.status === 404) {
                            errorMessage = 'Post not found.';
                        }
                        showMessage(errorMessage, 'error');
                    }
                } catch (error) {
                    console.error('Error loading post data:', error);
                    showMessage('An error occurred while loading the post data. Please check console for details.', 'error');
                }
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