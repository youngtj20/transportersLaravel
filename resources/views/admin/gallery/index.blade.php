<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <h1 class="text-2xl font-bold text-gray-900">Gallery Management</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-gray-700 text-sm">Welcome, {{ auth()->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-1"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.gallery.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i>Add New Gallery
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

            <!-- Search & Filters -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="w-full md:w-1/3">
                        <input type="text" id="searchInput" placeholder="Search galleries..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex gap-4">
                        <select id="statusFilter"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        <select id="eventFilter"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Events</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Loading -->
            <div id="loadingIndicator" class="p-12 text-center">
                <div class="inline-block animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500 mb-3"></div>
                <p class="text-gray-500">Loading galleries…</p>
            </div>

            <!-- Galleries Grid (starts empty; JS fills it) -->
            <div id="galleriesGridContainer" class="hidden">
                <div id="galleriesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    <!-- cards injected by JS -->
                </div>
            </div>

            <!-- No Data -->
            <div id="noDataMessage" class="hidden p-12 text-center">
                <i class="fas fa-images text-5xl text-gray-300 mb-4 block"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No galleries found</h3>
                <p class="text-gray-500 mb-4">Get started by creating a new gallery album.</p>
                <a href="{{ route('admin.gallery.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm">
                    <i class="fas fa-plus mr-2"></i>Add New Gallery
                </a>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600/50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Delete Gallery</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Are you sure you want to delete <strong id="deleteGalleryTitle"></strong>? This action cannot be undone.</p>
                </div>
                <div class="flex justify-center gap-3 px-4 py-3 mt-5 border-t border-gray-200">
                    <button id="confirmDeleteBtn"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md shadow-sm">
                        Delete
                    </button>
                    <button id="cancelDeleteBtn"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-md shadow-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const apiBaseUrl = '/api';
        let currentPage    = 1;
        let currentFilters = { search: '', status: '', event: '' };

        document.addEventListener('DOMContentLoaded', function () {
            loadGalleries();

            document.getElementById('searchInput').addEventListener('input', debounce(function () {
                currentFilters.search = this.value.trim();
                currentPage = 1;
                loadGalleries();
            }, 300));

            document.getElementById('statusFilter').addEventListener('change', function () {
                currentFilters.status = this.value;
                currentPage = 1;
                loadGalleries();
            });

            document.getElementById('eventFilter').addEventListener('change', function () {
                currentFilters.event = this.value;
                currentPage = 1;
                loadGalleries();
            });

            document.getElementById('cancelDeleteBtn').addEventListener('click', hideDeleteModal);
            document.getElementById('confirmDeleteBtn').addEventListener('click', performDelete);
        });

        function debounce(fn, delay) {
            let t;
            return function (...args) { clearTimeout(t); t = setTimeout(() => fn.apply(this, args), delay); };
        }

        function loadGalleries(page = 1) {
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('galleriesGridContainer').classList.add('hidden');
            document.getElementById('noDataMessage').classList.add('hidden');

            const params = new URLSearchParams({
                page: page,
                search: currentFilters.search,
                status: currentFilters.status,
                event: currentFilters.event,
            });

            fetch(`/api/event-galleries?${params}`, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => { if (!r.ok) throw r; return r.json(); })
            .then(data => {
                renderGalleries(data.data || []);
                populateEventFilter(data.data || []);
            })
            .catch(async err => {
                let msg = 'Failed to load galleries.';
                if (err instanceof Response) {
                    try { const d = await err.json(); if (d.message) msg = d.message; } catch (_) {}
                }
                showNotification(msg, 'error');
                document.getElementById('galleriesGridContainer').classList.remove('hidden');
            })
            .finally(() => {
                document.getElementById('loadingIndicator').classList.add('hidden');
            });
        }

        function resolveFirstImage(images) {
            if (!Array.isArray(images) || images.length === 0) return null;
            const img = images[0];
            if (img.startsWith('http') || img.startsWith('data:')) return img;
            const clean = img.replace(/^[/\\]+/, '');
            return clean.startsWith('images/') ? `/${clean}` : `/images/${clean}`;
        }

        function renderGalleries(galleries) {
            const grid = document.getElementById('galleriesGrid');
            grid.innerHTML = '';

            if (galleries.length === 0) {
                document.getElementById('noDataMessage').classList.remove('hidden');
                return;
            }

            document.getElementById('galleriesGridContainer').classList.remove('hidden');

            galleries.forEach(gallery => {
                const title       = escapeHtml(gallery.title || 'Untitled');
                const description = escapeHtml(gallery.description || 'No description available');
                const eventDate   = gallery.event_date ? formatDate(gallery.event_date) : 'No date';
                const statusClass = gallery.published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                const statusText  = gallery.published ? 'Published' : 'Draft';
                const imgCount    = Array.isArray(gallery.images) ? gallery.images.length : 0;
                const firstImg    = resolveFirstImage(gallery.images);

                const thumbHtml = firstImg
                    ? `<img src="${escapeHtml(firstImg)}" alt="${title}"
                            class="w-16 h-16 object-cover rounded-xl border border-gray-200"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">`
                    : '';
                const iconFallback = `<div class="w-16 h-16 bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center text-gray-400${firstImg ? ' hidden' : ''}">
                    <i class="fas fa-images text-2xl"></i></div>`;

                const card = document.createElement('div');
                card.className = 'bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200';
                card.innerHTML = `
                    <div class="p-4">
                        <div class="flex items-center mb-3 gap-3">
                            ${thumbHtml}${iconFallback}
                            <div class="min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 truncate">${title}</h3>
                                <p class="text-sm text-gray-500">${eventDate}</p>
                                <p class="text-xs text-gray-400 mt-0.5">${imgCount} photo${imgCount !== 1 ? 's' : ''}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">${description}</p>
                        <div class="flex justify-between items-center">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${statusClass}">${statusText}</span>
                            <div class="flex gap-3">
                                <a href="/admin/gallery/${gallery.id}/edit"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <button class="delete-gallery text-red-600 hover:text-red-800 text-sm font-medium"
                                        data-gallery-id="${gallery.id}" data-gallery-title="${title}">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>`;
                grid.appendChild(card);
            });

            // Bind delete buttons
            grid.querySelectorAll('.delete-gallery').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    showDeleteModal(this.dataset.galleryId, this.dataset.galleryTitle);
                });
            });
        }

        function populateEventFilter(galleries) {
            const select = document.getElementById('eventFilter');
            const current = select.value;
            const events = [...new Set(galleries.map(g => g.event_name).filter(Boolean))];
            select.innerHTML = '<option value="">All Events</option>';
            events.forEach(ev => {
                const opt = document.createElement('option');
                opt.value = ev; opt.textContent = ev;
                if (ev === current) opt.selected = true;
                select.appendChild(opt);
            });
        }

        function showDeleteModal(id, title) {
            document.getElementById('confirmDeleteBtn').dataset.galleryId = id;
            document.getElementById('deleteGalleryTitle').textContent = title;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        async function performDelete() {
            const id = document.getElementById('confirmDeleteBtn').dataset.galleryId;
            if (!id) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/api/event-galleries/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                    }
                });
                const result = await response.json();

                if (response.ok) {
                    showNotification('Gallery deleted successfully!', 'success');
                    hideDeleteModal();
                    loadGalleries(currentPage);
                } else {
                    showNotification(result.message || 'Failed to delete gallery.', 'error');
                }
            } catch (err) {
                console.error('Delete error:', err);
                showNotification('An error occurred while deleting the gallery.', 'error');
            }
        }

        function showNotification(message, type) {
            document.querySelectorAll('.notification-toast').forEach(n => n.remove());
            const n = document.createElement('div');
            const colorClass = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            n.className = `notification-toast fixed top-4 right-4 z-50 px-6 py-4 rounded-md shadow-lg text-white text-sm ${colorClass}`;
            n.textContent = message;
            document.body.appendChild(n);
            setTimeout(() => { n.style.opacity = '0'; n.style.transition = 'opacity 0.3s'; setTimeout(() => n.remove(), 400); }, 5000);
        }

        function escapeHtml(text) {
            const d = document.createElement('div');
            d.textContent = String(text);
            return d.innerHTML;
        }

        function formatDate(dateString) {
            try {
                return new Date(dateString).toLocaleDateString('en-NG', { year: 'numeric', month: 'short', day: 'numeric' });
            } catch (_) { return dateString; }
        }
    </script>
</body>
</html>
