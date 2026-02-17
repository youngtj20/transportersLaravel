<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Pages Management</h1>
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
                    <a href="{{ route('admin.pages.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Create New Page
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">All Pages</h2>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="pagesTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="pagesList">
                            <!-- Loading indicator -->
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>Loading pages...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- No pages message -->
                    <div id="noPagesMessage" class="hidden text-center py-8 text-gray-500">
                        <i class="fas fa-file-alt text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium">No pages yet</h3>
                        <p class="mt-1">Get started by creating a new page.</p>
                        <a href="{{ route('admin.pages.create') }}" 
                           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Create Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Confirm Deletion</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this page? This action cannot be undone.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none mr-2">
                        Delete
                    </button>
                    <button id="cancelDeleteBtn" class="px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Success/Error Messages -->
    <div id="messageContainer" class="hidden fixed top-4 right-4 z-50 max-w-sm">
        <div id="messageContent" class="p-4 rounded-md shadow-lg"></div>
    </div>
    
    <script>
        // Get the API token from session via a meta tag or script variable
        const apiToken = "{{ session('api_token') }}";
        
        let currentPageId = null;

        document.addEventListener('DOMContentLoaded', function() {
            loadPages();
            
            // Setup modal event listeners
            document.getElementById('cancelDeleteBtn').addEventListener('click', hideConfirmationModal);
            document.getElementById('confirmDeleteBtn').addEventListener('click', deletePage);
        });

        async function loadPages() {
            try {
                const response = await fetch('/api/pages', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    displayPages(result.data);
                } else {
                    throw new Error('Failed to load pages');
                }
            } catch (error) {
                console.error('Error loading pages:', error);
                showMessage('Failed to load pages. Please refresh the page.', 'error');
                
                // Show empty state
                document.getElementById('pagesList').innerHTML = '';
                document.getElementById('noPagesMessage').classList.remove('hidden');
            }
        }

        function displayPages(pages) {
            const pagesList = document.getElementById('pagesList');
            
            if (pages.length === 0) {
                pagesList.innerHTML = '';
                document.getElementById('noPagesMessage').classList.remove('hidden');
                return;
            }
            
            document.getElementById('noPagesMessage').classList.add('hidden');
            
            let html = '';
            pages.forEach(page => {
                const statusClass = page.published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                const statusText = page.published ? 'Published' : 'Draft';
                
                html += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${page.title}</div>
                            <div class="text-sm text-gray-500">${page.slug}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                ${page.page_type || 'static'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                                ${statusText}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${page.author?.name || 'Unknown'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${formatDate(page.created_at)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="/admin/pages/${page.id}/edit" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" class="text-red-600 hover:text-red-900" onclick="showConfirmationModal('${page.id}', '${page.title}')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                `;
            });
            
            pagesList.innerHTML = html;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function showConfirmationModal(pageId, pageTitle) {
            currentPageId = pageId;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
            currentPageId = null;
        }

        async function deletePage() {
            if (!currentPageId) return;
            
            try {
                const response = await fetch(`/api/pages/${currentPageId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + apiToken
                    }
                });

                if (response.ok) {
                    showMessage('Page deleted successfully!', 'success');
                    loadPages(); // Reload the pages list
                } else {
                    const result = await response.json();
                    let errorMessage = 'Failed to delete page.';
                    if (result.message) {
                        errorMessage = result.message;
                    }
                    showMessage(errorMessage, 'error');
                }
            } catch (error) {
                console.error('Error deleting page:', error);
                showMessage('An error occurred while deleting the page.', 'error');
            } finally {
                hideConfirmationModal();
            }
        }

        function showMessage(message, type) {
            const messageContainer = document.getElementById('messageContainer');
            const messageContent = document.getElementById('messageContent');
            
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
    </script>
</body>
</html>