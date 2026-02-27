<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between items-center py-4 gap-3">
            <div class="flex items-center gap-3">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Events Management</h1>
                    <p class="text-xs text-gray-500">Create and manage events</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name }}</span>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
                <a href="{{ route('admin.events.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>New Event</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Stats Row -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Total</p>
                    <p id="stat-total" class="text-2xl font-bold text-gray-900 mt-1">—</p>
                </div>
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-gray-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Published</p>
                    <p id="stat-published" class="text-2xl font-bold text-green-600 mt-1">—</p>
                </div>
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Upcoming</p>
                    <p id="stat-upcoming" class="text-2xl font-bold text-blue-600 mt-1">—</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Draft</p>
                    <p id="stat-draft" class="text-2xl font-bold text-yellow-600 mt-1">—</p>
                </div>
                <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- Search & Filter Bar -->
        <div class="p-5 border-b border-gray-100 bg-gray-50">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input id="searchInput" type="text" placeholder="Search events..."
                        class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                </div>
                <select id="statusFilter"
                    class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">All Statuses</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <select id="timeFilter"
                    class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">All Times</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="past">Past</option>
                </select>
                <button onclick="loadEvents()" class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-sync-alt mr-1"></i>Refresh
                </button>
            </div>
        </div>

        <!-- Loading state -->
        <div id="loadingState" class="p-16 text-center">
            <i class="fas fa-spinner fa-spin text-3xl text-green-600 mb-4"></i>
            <p class="text-gray-500">Loading events...</p>
        </div>

        <!-- Empty state -->
        <div id="emptyState" class="hidden p-16 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-times text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-1">No Events Found</h3>
            <p class="text-gray-500 mb-6">No events match your current filters.</p>
            <a href="{{ route('admin.events.create') }}"
               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium">
                <i class="fas fa-plus"></i> Create First Event
            </a>
        </div>

        <!-- Table -->
        <div id="tableContainer" class="hidden overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="eventsTableBody" class="bg-white divide-y divide-gray-100"></tbody>
            </table>
        </div>

    </div>
</main>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Delete Event</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone.</p>
                </div>
            </div>
            <p class="text-gray-700 mb-6">Are you sure you want to delete <strong id="deleteEventName"></strong>?</p>
            <div class="flex gap-3 justify-end">
                <button onclick="closeDeleteModal()" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">Cancel</button>
                <button onclick="confirmDelete()" id="confirmDeleteBtn"
                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 hidden">
    <div id="toastMsg" class="px-6 py-3 rounded-full shadow-xl text-sm font-semibold text-white"></div>
</div>

<script>
const apiToken = "{{ session('api_token') }}";
let allEvents = [];
let deleteTargetId = null;
const now = new Date();

function showToast(msg, type) {
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMsg');
    toastMsg.textContent = msg;
    toastMsg.className = 'px-6 py-3 rounded-full shadow-xl text-sm font-semibold text-white '
        + (type === 'success' ? 'bg-green-600' : 'bg-red-600');
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}

function loadEvents() {
    document.getElementById('loadingState').classList.remove('hidden');
    document.getElementById('tableContainer').classList.add('hidden');
    document.getElementById('emptyState').classList.add('hidden');

    fetch('/api/events', {
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + apiToken
        }
    })
    .then(r => r.json())
    .then(res => {
        allEvents = res.data || [];
        renderTable();
        updateStats();
    })
    .catch(() => {
        document.getElementById('loadingState').classList.add('hidden');
        showToast('Failed to load events. Check your connection.', 'error');
    });
}

function updateStats() {
    const published = allEvents.filter(e => e.published).length;
    const upcoming  = allEvents.filter(e => new Date(e.event_date) >= now).length;
    document.getElementById('stat-total').textContent     = allEvents.length;
    document.getElementById('stat-published').textContent = published;
    document.getElementById('stat-upcoming').textContent  = upcoming;
    document.getElementById('stat-draft').textContent     = allEvents.filter(e => !e.published).length;
}

function renderTable() {
    const search  = document.getElementById('searchInput').value.toLowerCase();
    const status  = document.getElementById('statusFilter').value;
    const timeFil = document.getElementById('timeFilter').value;

    let filtered = allEvents.filter(e => {
        const matchSearch = !search ||
            (e.title  || '').toLowerCase().includes(search) ||
            (e.location || '').toLowerCase().includes(search);
        const matchStatus = !status ||
            (status === 'published' ? e.published : !e.published);
        const evDate = new Date(e.event_date);
        const matchTime = !timeFil ||
            (timeFil === 'upcoming' ? evDate >= now : evDate < now);
        return matchSearch && matchStatus && matchTime;
    });

    document.getElementById('loadingState').classList.add('hidden');

    if (filtered.length === 0) {
        document.getElementById('tableContainer').classList.add('hidden');
        document.getElementById('emptyState').classList.remove('hidden');
        return;
    }

    document.getElementById('emptyState').classList.add('hidden');
    document.getElementById('tableContainer').classList.remove('hidden');

    const tbody = document.getElementById('eventsTableBody');
    tbody.innerHTML = filtered.map(function(ev) {
        const evDate  = new Date(ev.event_date);
        const isPast  = evDate < now;
        const dateStr = evDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
        const timeStr = evDate.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', hour12: true });

        const statusBadge = ev.published
            ? '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Published</span>'
            : '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700"><span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>Draft</span>';

        const timeBadge = isPast
            ? '<span class="ml-1 text-xs text-gray-400">(Past)</span>'
            : '<span class="ml-1 text-xs text-blue-500">(Upcoming)</span>';

        const desc = (ev.description || '').replace(/<[^>]+>/g, '').substring(0, 80);

        return `<tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4">
                <div class="font-semibold text-gray-900 text-sm leading-tight">${escHtml(ev.title || '')}</div>
                ${desc ? `<div class="text-xs text-gray-400 mt-0.5 leading-relaxed max-w-xs truncate">${escHtml(desc)}</div>` : ''}
                ${ev.speakers && ev.speakers.length ? `<div class="text-xs text-green-600 mt-1"><i class="fas fa-microphone mr-1"></i>${ev.speakers.length} speaker${ev.speakers.length > 1 ? 's' : ''}</div>` : ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-800">${dateStr} ${timeBadge}</div>
                <div class="text-xs text-gray-500 mt-0.5"><i class="fas fa-clock mr-1"></i>${timeStr}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                ${ev.location ? `<i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>${escHtml(ev.location)}` : '<span class="text-gray-300">—</span>'}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${ev.author ? escHtml(ev.author.name || '') : '<span class="text-gray-300">—</span>'}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right">
                <div class="flex items-center justify-end gap-2">
                    <button onclick="togglePublish(${ev.id}, ${ev.published})"
                        title="${ev.published ? 'Unpublish' : 'Publish'}"
                        class="w-8 h-8 flex items-center justify-center rounded-lg border transition-colors ${ev.published ? 'border-yellow-200 bg-yellow-50 text-yellow-600 hover:bg-yellow-100' : 'border-green-200 bg-green-50 text-green-600 hover:bg-green-100'}">
                        <i class="fas ${ev.published ? 'fa-eye-slash' : 'fa-eye'} text-xs"></i>
                    </button>
                    <a href="/admin/events/${ev.id}/edit"
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                        <i class="fas fa-edit text-xs"></i>
                    </a>
                    <button onclick="openDeleteModal(${ev.id}, '${escHtml(ev.title || '').replace(/'/g, "\\'")}')"
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

function togglePublish(id, currentlyPublished) {
    const ev = allEvents.find(e => e.id === id);
    if (!ev) return;

    fetch(`/api/events/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + apiToken
        },
        body: JSON.stringify({
            title: ev.title,
            slug: ev.slug,
            description: ev.description,
            event_date: ev.event_date,
            location: ev.location,
            featured_image: ev.featured_image,
            speakers: ev.speakers || [],
            agenda: ev.agenda || [],
            published: !currentlyPublished
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const idx = allEvents.findIndex(e => e.id === id);
            if (idx !== -1) allEvents[idx].published = !currentlyPublished;
            renderTable();
            updateStats();
            showToast((!currentlyPublished ? 'Published' : 'Unpublished') + ' successfully!', 'success');
        } else {
            showToast(res.message || 'Failed to update status.', 'error');
        }
    })
    .catch(() => showToast('Network error. Please try again.', 'error'));
}

function openDeleteModal(id, name) {
    deleteTargetId = id;
    document.getElementById('deleteEventName').textContent = name;
    document.getElementById('deleteModal').classList.remove('hidden');
}
function closeDeleteModal() {
    deleteTargetId = null;
    document.getElementById('deleteModal').classList.add('hidden');
}
function confirmDelete() {
    if (!deleteTargetId) return;
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';

    fetch(`/api/events/${deleteTargetId}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + apiToken
        }
    })
    .then(r => r.json())
    .then(res => {
        closeDeleteModal();
        if (res.success) {
            allEvents = allEvents.filter(e => e.id !== deleteTargetId);
            renderTable();
            updateStats();
            showToast('Event deleted successfully.', 'success');
        } else {
            showToast(res.message || 'Failed to delete event.', 'error');
        }
    })
    .catch(() => {
        closeDeleteModal();
        showToast('Network error. Please try again.', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-trash mr-2"></i>Delete';
    });
}

function escHtml(str) {
    return String(str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// Debounced search/filter
let debounceTimer;
['searchInput','statusFilter','timeFilter'].forEach(function(id) {
    document.getElementById(id).addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(renderTable, 250);
    });
});

// Close modal on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});

// Load on page ready
loadEvents();
</script>
</body>
</html>
