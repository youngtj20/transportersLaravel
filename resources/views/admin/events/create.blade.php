<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Admin Panel</title>
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
                    <h1 class="text-xl font-bold text-gray-900">Create New Event</h1>
                    <p class="text-xs text-gray-500">Fill in the details below</p>
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
                        <p class="text-xs text-gray-400 mt-1">Auto-generated from title. Used in URLs.</p>
                        <p id="slug-error" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Description
                        </label>
                        <textarea id="description" rows="6" placeholder="Describe the event, what to expect, who should attend..."
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
                        <p class="text-xs text-gray-400 mt-1">Optional. Full URL to an image for this event.</p>
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
                <div id="speakersContainer" class="space-y-3">
                    <!-- rows injected by JS -->
                </div>
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
                <div id="agendaContainer" class="space-y-3">
                    <!-- rows injected by JS -->
                </div>
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
                <div class="space-y-2.5">
                    <button type="button" onclick="submitForm(false)"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition-colors">
                        <i class="fas fa-save"></i> Save as Draft
                    </button>
                    <button type="button" onclick="submitForm(true)"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg text-sm transition-colors">
                        <i class="fas fa-paper-plane"></i> Publish Event
                    </button>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-blue-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-blue-600"></i> Tips
                </h3>
                <ul class="text-xs text-blue-700 space-y-2">
                    <li class="flex items-start gap-1.5"><i class="fas fa-dot-circle mt-0.5 text-blue-400 flex-shrink-0"></i> Add speakers to boost engagement</li>
                    <li class="flex items-start gap-1.5"><i class="fas fa-dot-circle mt-0.5 text-blue-400 flex-shrink-0"></i> Use the agenda to set attendee expectations</li>
                    <li class="flex items-start gap-1.5"><i class="fas fa-dot-circle mt-0.5 text-blue-400 flex-shrink-0"></i> Published events appear on the public website</li>
                    <li class="flex items-start gap-1.5"><i class="fas fa-dot-circle mt-0.5 text-blue-400 flex-shrink-0"></i> Drafts are only visible in admin</li>
                </ul>
            </div>

        </div>
    </div>
</main>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 hidden">
    <div id="toastMsg" class="px-6 py-3 rounded-full shadow-xl text-sm font-semibold text-white"></div>
</div>

<script>
const apiToken = "{{ session('api_token') }}";

/* ── Slug generation ───────────────────────────────── */
document.getElementById('title').addEventListener('input', function() {
    document.getElementById('slug').value = slugify(this.value);
});
function regenerateSlug() {
    document.getElementById('slug').value = slugify(document.getElementById('title').value);
}
function slugify(str) {
    return str.toLowerCase().trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
}

/* ── Publish toggle label ──────────────────────────── */
document.getElementById('published').addEventListener('change', function() {
    document.getElementById('publishLabel').textContent = this.checked ? 'Published' : 'Draft';
    document.getElementById('publishLabel').className = 'ml-2 text-sm font-medium ' + (this.checked ? 'text-green-600' : 'text-gray-500');
});

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

/* ── Collect speakers/agenda ───────────────────────── */
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
    ['title','slug','date','time'].forEach(f => {
        document.getElementById(f + '-error').classList.add('hidden');
        document.getElementById(f + '-error').textContent = '';
    });
}
function showFieldError(field, msg) {
    const el = document.getElementById(field + '-error');
    el.textContent = msg;
    el.classList.remove('hidden');
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
function submitForm(publish) {
    if (!validate()) {
        showToast('Please fix the errors above.', 'error');
        return;
    }

    const dateVal = document.getElementById('event_date').value;
    const timeVal = document.getElementById('event_time').value;
    const eventDateTime = dateVal + 'T' + timeVal + ':00';

    const payload = {
        title:          document.getElementById('title').value.trim(),
        slug:           document.getElementById('slug').value.trim(),
        description:    document.getElementById('description').value.trim() || null,
        event_date:     eventDateTime,
        location:       document.getElementById('location').value.trim() || null,
        featured_image: document.getElementById('featured_image').value.trim() || null,
        speakers:       getSpeakers(),
        agenda:         getAgenda(),
        published:      publish
    };

    const btn = publish
        ? document.querySelector('button[onclick="submitForm(true)"]')
        : document.querySelector('button[onclick="submitForm(false)"]');
    const origHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

    fetch('/api/events', {
        method: 'POST',
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
            showToast('Event created successfully!', 'success');
            setTimeout(() => { window.location.href = '{{ route("admin.events.index") }}'; }, 1200);
        } else {
            let msg = res.message || 'Failed to create event.';
            if (res.errors) {
                const errs = Object.entries(res.errors);
                msg = errs.map(([k,v]) => v).flat().join(' ');
                // Try to highlight specific fields
                if (res.errors.title) showFieldError('title', res.errors.title[0]);
                if (res.errors.slug)  showFieldError('slug',  res.errors.slug[0]);
            }
            showToast(msg, 'error');
        }
    })
    .catch(() => showToast('Network error. Please try again.', 'error'))
    .finally(() => { btn.disabled = false; btn.innerHTML = origHTML; });
}

/* ── Toast ─────────────────────────────────────────── */
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
    return String(str || '').replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
</script>
</body>
</html>
