<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Manage Posts</h1>
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
                    <a href="{{ route('admin.posts.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Create New Post
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Posts List</h2>
            </div>
            
            <!-- Search and Filter Controls -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="w-full md:w-1/3">
                        <input type="text" 
                               id="searchInput" 
                               placeholder="Search posts..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex space-x-4">
                        <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        <select id="categoryFilter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            <option value="announcement">Announcement</option>
                            <option value="updates">Updates</option>
                            <option value="events">Events</option>
                            <option value="news">News</option>
                            <option value="opinion">Opinion</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Loading indicator -->
            <div id="loadingIndicator" class="hidden p-6 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                <p class="mt-2 text-gray-600">Loading posts...</p>
            </div>
            
            <!-- Posts Table -->
            <div id="postsTableContainer">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="postsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Posts will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div id="paginationContainer" class="px-6 py-4 bg-white border-t border-gray-200 hidden">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span id="paginationFrom">0</span> to <span id="paginationTo">0</span> of <span id="paginationTotal">0</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button id="prevPage" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Previous
                            </button>
                            <span id="currentPage" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md"></span>
                            <button id="nextPage" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- No Data Message -->
            <div id="noDataMessage" class="hidden p-12 text-center">
                <i class="fas fa-file-alt text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No posts found</h3>
                <p class="text-gray-500 mb-4">Get started by creating a new post.</p>
                <a href="{{ route('admin.posts.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>Create New Post
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
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Delete Post</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this post? This action cannot be undone.
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
            category: ''
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            // Load posts on page load
            loadPosts();
            
            // Set up event listeners
            document.getElementById('searchInput').addEventListener('input', handleSearch);
            document.getElementById('statusFilter').addEventListener('change', handleFilterChange);
            document.getElementById('categoryFilter').addEventListener('change', handleFilterChange);
            document.getElementById('prevPage').addEventListener('click', goToPreviousPage);
            document.getElementById('nextPage').addEventListener('click', goToNextPage);
            document.getElementById('cancelDeleteBtn').addEventListener('click', hideDeleteModal);
            
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', performDelete);
            }
        });
        
        function loadPosts(page = 1) {
            // Show loading indicator
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('postsTableContainer').classList.add('hidden');
            document.getElementById('noDataMessage').classList.add('hidden');
            
            // Prepare query parameters
            const params = new URLSearchParams({
                page: page,
                search: currentFilters.search,
                status: currentFilters.status,
                category: currentFilters.category
            });
            
            fetch(`/api/posts?${params}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw response;
                }
                return response.json();
            })
            .then(data => {
                renderPosts(data.data.data);
                updatePagination(data.data);
            })
            .catch(async error => {
                let errorMessage = 'Failed to load posts.';
                
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
                            errorMessage = 'Network error occurred while loading posts.';
                        }
                    }
                }
                
                showNotification(errorMessage, 'error');
                console.error('Error loading posts:', error);
            })
            .finally(() => {
                // Hide loading indicator
                document.getElementById('loadingIndicator').classList.add('hidden');
                document.getElementById('postsTableContainer').classList.remove('hidden');
            });
        }
        
        function renderPosts(posts) {
            const tbody = document.getElementById('postsTableBody');
            
            if (posts.length === 0) {
                document.getElementById('postsTableContainer').classList.add('hidden');
                document.getElementById('noDataMessage').classList.remove('hidden');
                return;
            }
            
            document.getElementById('postsTableContainer').classList.remove('hidden');
            document.getElementById('noDataMessage').classList.add('hidden');
            
            tbody.innerHTML = '';
            
            posts.forEach(post => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${escapeHtml(post.title)}</div>
                        <div class="text-sm text-gray-500">${escapeHtml(post.slug)}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${escapeHtml(post.author?.name || 'Unknown')}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            ${escapeHtml(post.category || 'Uncategorized')}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                            post.published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                        }">
                            ${post.published ? 'Published' : 'Draft'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${formatDate(post.created_at)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="/admin/posts/${post.id}/edit" 
                           class="text-indigo-600 hover:text-indigo-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" 
                           class="text-red-600 hover:text-red-900 delete-post" 
                           data-post-id="${post.id}" 
                           data-post-title="${escapeHtml(post.title)}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                `;
                
                tbody.appendChild(row);
            });
            
            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-post').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.getAttribute('data-post-id');
                    const postTitle = this.getAttribute('data-post-title');
                    showDeleteModal(postId, postTitle);
                });
            });
        }
        
        function updatePagination(meta) {
            currentPage = meta.current_page;
            totalPages = meta.last_page;
            
            document.getElementById('paginationFrom').textContent = meta.from || 0;
            document.getElementById('paginationTo').textContent = meta.to || 0;
            document.getElementById('paginationTotal').textContent = meta.total || 0;
            document.getElementById('currentPage').textContent = currentPage;
            
            document.getElementById('prevPage').disabled = currentPage <= 1;
            document.getElementById('nextPage').disabled = currentPage >= totalPages;
            
            document.getElementById('paginationContainer').classList.toggle('hidden', meta.total === 0);
        }
        
        function handleSearch(e) {
            currentFilters.search = e.target.value.trim();
            currentPage = 1; // Reset to first page when searching
            loadPosts(currentPage);
        }
        
        function handleFilterChange() {
            currentFilters.status = document.getElementById('statusFilter').value;
            currentFilters.category = document.getElementById('categoryFilter').value;
            currentPage = 1; // Reset to first page when filtering
            loadPosts(currentPage);
        }
        
        function goToPreviousPage() {
            if (currentPage > 1) {
                loadPosts(--currentPage);
            }
        }
        
        function goToNextPage() {
            if (currentPage < totalPages) {
                loadPosts(++currentPage);
            }
        }
        
        function showDeleteModal(postId, postTitle) {
            document.getElementById('confirmDeleteBtn').dataset.postId = postId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
        
        async function performDelete() {
            const postId = document.getElementById('confirmDeleteBtn').dataset.postId;
            
            if (!postId) {
                showNotification('Invalid post ID.', 'error');
                return;
            }
            
            try {
                const response = await fetch(`/api/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    showNotification('Post deleted successfully!', 'success');
                    hideDeleteModal();
                    loadPosts(currentPage); // Reload current page
                } else {
                    let errorMessage = 'Failed to delete post.';
                    if (result.message) {
                        errorMessage = result.message;
                    } else if (response.status === 401) {
                        errorMessage = 'Unauthorized access. Please log in again.';
                    } else if (response.status === 404) {
                        errorMessage = 'Post not found.';
                    }
                    showNotification(errorMessage, 'error');
                }
            } catch (error) {
                console.error('Error deleting post:', error);
                showNotification('An error occurred while deleting the post.', 'error');
            }
        }
        
        function showNotification(message, type) {
            // Remove any existing notification
            const existingNotification = document.querySelector('.notification-toast');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.className = `notification-toast fixed top-4 right-4 z-50 px-6 py-4 rounded-md shadow-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
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
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
    </script>
</body>
</html>