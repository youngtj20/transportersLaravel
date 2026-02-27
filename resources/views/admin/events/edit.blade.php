<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between items-center py-4 gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.events.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Edit Event</h1>
                    <p id="headerSubtitle" class="text-xs text-gray-500">Loading...</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name }}</span>
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

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 z-30 bg-white flex items-center justify-center">
    <div class="text-center">
        <i class="fas fa-spinner fa-spin text-4xl text-green-600 mb-4"></i>
        <p class="text-gray-500 font-medium">Loading event data...</p>
    </div>
</div>

<main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left: Main Form -->
        <div class="lg:col-span-2 space-y-5">

            <!-- Basic Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-info-circle text-green-600"></i> Event Details
                </h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Event Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" placeholder="Enter event title"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <p id="title-error" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            URL Slug <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="slug" placeholder="event-url-slug"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent pr-10">
                            <button type="button" onclick="regenerateSlug()" title="Generate from title"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600 transition-colors">
                                <i class="fas fa-sync-alt text-xs"></i>
                            </button>
                        </div>
                        <p id="slug-error" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                        <textarea id="description" rows="6" placeholder="Describe the event..."
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 resize-y"></textarea>
                    </div>
                </div>
            </div>

            <!-- Date, Time, Location -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-green-600"></i> When & Where
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Event Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="event_date"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p id="date-error" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Event Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="event_time"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p id="time-error" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                        <input type="text" id="location" placeholder="e.g., Abuja, Nigeria"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image URL</label>
                        <input type="url" id="featured_image" placeholder="https://..."
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>

            <!-- Speakers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-microphone text-green-600"></i> Speakers
                        <span class="text-xs text-gray-400 font-normal">(optional)</span>
                    </h2>
                    <button type="button" onclick="addSpeaker()"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i> Add Speaker
                    </button>
                </div>
                <div id="speakersContainer" class="space-y-3"></div>
                <p id="speakers-empty" class="text-sm text-gray-400 text-center py-4">No speakers added yet.</p>
            </div>

            <!-- Agenda -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-list-alt text-green-600"></i> Agenda
                        <span class="text-xs text-gray-400 font-normal">(optional)</span>
                    </h2>
                    <button type="button" onclick="addAgendaItem()"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i> Add Item
                    </button>
                </div>
                <div id="agendaContainer" class="space-y-3"></div>
                <p id="agenda-empty" class="text-sm text-gray-400 text-center py-4">No agenda items added yet.</p>
            </div>

        </div>

        <!-- Right: Sidebar -->
        <div class="lg:col-span-1 space-y-5">

            <!-- Publish Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Publish</h3>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg mb-4">
                    <span class="text-sm text-gray-700">Status</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="published" class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
                        <span id="publishLabel" class="ml-2 text-sm font-medium text-gray-500">Draft</span>
                    </label>
                </div>
                <button type="button" id="saveBtn" onclick="submitForm()"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg text-sm transition-colors">
                    <i class="fas fa-save"></i> Update Event
                </button>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-xl shadow-sm border border-red-100 p-5">
                <h3 class="text-base font-semibold text-red-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i> Danger Zone
                </h3>
                <p class="text-xs text-gray-500 mb-3">Permanently delete this event. This cannot be undone.</p>
                <button type="button" onclick="openDeleteModal()"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-lg text-sm border border-red-200 transition-colors">
                    <i class="fas fa-trash"></i> Delete Event
                </button>
            </div>

        </div>
    </div>
</main>

<!-- Delete Modal -->
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
                <button onclick="closeDeleteModal()" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium">Cancel</button>
                <button onclick="confirmDelete()" id="confirmDeleteBtn"
                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium">
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
const eventId  = {{ $id ?? 'null' }};
let currentSlug = '';

/* ── Load event on page ready ──────────────────────── */
document.addEventListener('DOMContentLoaded', function() {
    if (!eventId) {
        showToast('No event ID provided.', 'error');
        return;
    }
    loadEventData();
});

function loadEventData() {
    fetch('/api/events/' + eventId, {
        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + apiToken }
    })
    .then(r => {
        if (!r.ok) throw r;
        return r.json();
    })
    .then(res => {
        const ev = res.data;
        document.getElementById('loadingOverlay').style.display = 'none';
        document.getElementById('headerSubtitle').textContent = ev.title || 'Edit event';

        document.getElementById('title').value       = ev.title || '';
        document.getElementById('slug').value        = ev.slug  || '';
        document.getElementById('description').value = ev.description || '';
        document.getElementById('location').value    = ev.location || '';
        document.getElementById('featured_image').value = ev.featured_image || '';

        currentSlug = ev.slug || '';

        // Date + time split
        if (ev.event_date) {
            const d = new Date(ev.event_date);
            const y = d.getFullYear();
            const m = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            const h = String(d.getHours()).padStart(2, '0');
            const min = String(d.getMinutes()).padStart(2, '0');
            document.getElementById('event_date').value = `${y}-${m}-${day}`;
            document.getElementById('event_time').value = `${h}:${min}`;
        }

        // Publish toggle
        document.getElementById('published').checked = !!ev.published;
        updatePublishLabel();

        // Speakers — handle both string[] and object[] formats
        if (ev.speakers && Array.isArray(ev.speakers) && ev.speakers.length) {
            ev.speakers.forEach(function(s) {
                const name = typeof s === 'object' ? (s.name || '') : String(s || '');
                const role = typeof s === 'object' ? (s.role || '') : '';
                addSpeaker(name, role);
            });
        }

        // Agenda — handle both string[] and object[] formats
        if (ev.agenda && Array.isArray(ev.agenda) && ev.agenda.length) {
            ev.agenda.forEach(function(a) {
                const time  = typeof a === 'object' ? (a.time  || '') : '';
                const title = typeof a === 'object' ? (a.title || a.text || '') : String(a || '');
                addAgendaItem(time, title);
            });
        }
    })
    .catch(async function(err) {
        document.getElementById('loadingOverlay').style.display = 'none';
        let msg = 'Failed to load event data.';
        if (err instanceof Response) {
            try {
                const body = await err.json();
                msg = body.message || (err.status === 404 ? 'Event not found.' : 'Unauthorized.');
            } catch(e) {}
        }
        showToast(msg, 'error');
    });
}

/* ── Slug ──────────────────────────────────────────── */
document.getElementById('title').addEventListener('input', function() {
    if (!currentSlug || document.getElementById('slug').value === currentSlug) {
        document.getElementById('slug').value = slugify(this.value);
        currentSlug = document.getElementById('slug').value;
    }
});
function regenerateSlug() {
    document.getElementById('slug').value = slugify(document.getElementById('title').value);
    currentSlug = document.getElementById('slug').value;
}
function slugify(str) {
    return str.toLowerCase().trim()
        .replace(/[^\w\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
}

/* ── Publish toggle ────────────────────────────────── */
document.getElementById('published').addEventListener('change', updatePublishLabel);
function updatePublishLabel() {
    const checked = document.getElementById('published').checked;
    const label = document.getElementById('publishLabel');
    label.textContent = checked ? 'Published' : 'Draft';
    label.className = 'ml-2 text-sm font-medium ' + (checked ? 'text-green-600' : 'text-gray-500');
}

/* ── Speakers ──────────────────────────────────────── */
let speakerCount = 0;
function addSpeaker(name, role) {
    speakerCount++;
    const id = 'sp-' + speakerCount;
    document.getElementById('speakers-empty').style.display = 'none';
    const div = document.createElement('div');
    div.id = id;
    div.className = 'flex gap-2 items-start bg-gray-50 p-3 rounded-lg border border-gray-100';
    div.innerHTML = `
        <div class="flex-1 grid grid-cols-2 gap-2">
            <input type="text" placeholder="Speaker name" value="${escAttr(name || '')}"
                class="col-span-2 sm:col-span-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 speaker-name bg-white">
            <input type="text" placeholder="Title/Role (optional)" value="${escAttr(role || '')}"
                class="col-span-2 sm:col-span-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 speaker-role bg-white">
        </div>
        <button type="button" onclick="removeRow('${id}', 'speakersContainer', 'speakers-empty')"
            class="text-red-400 hover:text-red-600 p-2 mt-0.5 transition-colors flex-shrink-0">
            <i class="fas fa-times"></i>
        </button>`;
    document.getElementById('speakersContainer').appendChild(div);
}

/* ── Agenda ────────────────────────────────────────── */
let agendaCount = 0;
function addAgendaItem(time, title) {
    agendaCount++;
    const id = 'ag-' + agendaCount;
    document.getElementById('agenda-empty').style.display = 'none';
    const div = document.createElement('div');
    div.id = id;
    div.className = 'flex gap-2 items-start bg-gray-50 p-3 rounded-lg border border-gray-100';
    div.innerHTML = `
        <div class="flex-1 grid grid-cols-3 gap-2">
            <input type="text" placeholder="e.g. 10:00 AM" value="${escAttr(time || '')}"
                class="col-span-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 agenda-time bg-white">
            <input type="text" placeholder="Activity / session title" value="${escAttr(title || '')}"
                class="col-span-2 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 agenda-title bg-white">
        </div>
        <button type="button" onclick="removeRow('${id}', 'agendaContainer', 'agenda-empty')"
            class="text-red-400 hover:text-red-600 p-2 mt-0.5 transition-colors flex-shrink-0">
            <i class="fas fa-times"></i>
        </button>`;
    document.getElementById('agendaContainer').appendChild(div);
}

function removeRow(id, containerId, emptyId) {
    document.getElementById(id).remove();
    if (!document.getElementById(containerId).children.length) {
        document.getElementById(emptyId).style.display = '';
    }
}

/* ── Collect ───────────────────────────────────────── */
function getSpeakers() {
    return Array.from(document.querySelectorAll('#speakersContainer > div')).map(row => ({
        name: row.querySelector('.speaker-name').value.trim(),
        role: row.querySelector('.speaker-role').value.trim()
    })).filter(s => s.name);
}
function getAgenda() {
    return Array.from(document.querySelectorAll('#agendaContainer > div')).map(row => ({
        time:  row.querySelector('.agenda-time').value.trim(),
        title: row.querySelector('.agenda-title').value.trim()
    })).filter(a => a.title);
}

/* ── Validation ────────────────────────────────────── */
function clearErrors() {
    ['title','slug','date','time'].forEach(function(f) {
        const el = document.getElementById(f + '-error');
        if (el) { el.classList.add('hidden'); el.textContent = ''; }
    });
}
function showFieldError(field, msg) {
    const el = document.getElementById(field + '-error');
    if (el) { el.textContent = msg; el.classList.remove('hidden'); }
}
function validate() {
    clearErrors();
    let valid = true;
    if (!document.getElementById('title').value.trim()) {
        showFieldError('title', 'Event title is required.'); valid = false;
    }
    if (!document.getElementById('slug').value.trim()) {
        showFieldError('slug', 'URL slug is required.'); valid = false;
    }
    if (!document.getElementById('event_date').value) {
        showFieldError('date', 'Event date is required.'); valid = false;
    }
    if (!document.getElementById('event_time').value) {
        showFieldError('time', 'Event time is required.'); valid = false;
    }
    return valid;
}

/* ── Submit ────────────────────────────────────────── */
function submitForm() {
    if (!validate()) {
        showToast('Please fix the errors above.', 'error');
        return;
    }

    const dateVal = document.getElementById('event_date').value;
    const timeVal = document.getElementById('event_time').value;

    const payload = {
        title:          document.getElementById('title').value.trim(),
        slug:           document.getElementById('slug').value.trim(),
        description:    document.getElementById('description').value.trim() || null,
        event_date:     dateVal + 'T' + timeVal + ':00',
        location:       document.getElementById('location').value.trim() || null,
        featured_image: document.getElementById('featured_image').value.trim() || null,
        speakers:       getSpeakers(),
        agenda:         getAgenda(),
        published:      document.getElementById('published').checked
    };

    const btn = document.getElementById('saveBtn');
    const origHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

    fetch('/api/events/' + eventId, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + apiToken
        },
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            showToast('Event updated successfully!', 'success');
            setTimeout(() => { window.location.href = '{{ route("admin.events.index") }}'; }, 1200);
        } else {
            let msg = res.message || 'Failed to update event.';
            if (res.errors) {
                if (res.errors.title) showFieldError('title', res.errors.title[0]);
                if (res.errors.slug)  showFieldError('slug',  res.errors.slug[0]);
                msg = Object.values(res.errors).flat().join(' ');
            }
            showToast(msg, 'error');
        }
    })
    .catch(() => showToast('Network error. Please try again.', 'error'))
    .finally(() => { btn.disabled = false; btn.innerHTML = origHTML; });
}

/* ── Delete ────────────────────────────────────────── */
function openDeleteModal() {
    document.getElementById('deleteEventName').textContent = document.getElementById('title').value || 'this event';
    document.getElementById('deleteModal').classList.remove('hidden');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
function confirmDelete() {
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';

    fetch('/api/events/' + eventId, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + apiToken }
    })
    .then(r => r.json())
    .then(res => {
        closeDeleteModal();
        if (res.success) {
            showToast('Event deleted.', 'success');
            setTimeout(() => { window.location.href = '{{ route("admin.events.index") }}'; }, 1200);
        } else {
            showToast(res.message || 'Failed to delete event.', 'error');
        }
    })
    .catch(() => { closeDeleteModal(); showToast('Network error.', 'error'); })
    .finally(() => { btn.disabled = false; btn.innerHTML = '<i class="fas fa-trash mr-2"></i>Delete'; });
}

/* ── Helpers ───────────────────────────────────────── */
function showToast(msg, type) {
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMsg');
    toastMsg.textContent = msg;
    toastMsg.className = 'px-6 py-3 rounded-full shadow-xl text-sm font-semibold text-white '
        + (type === 'success' ? 'bg-green-600' : 'bg-red-600');
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3500);
}
function escAttr(str) {
    return String(str||'').replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});
</script>
</body>
</html>
