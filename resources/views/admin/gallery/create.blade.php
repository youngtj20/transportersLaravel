<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Gallery - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

    <!-- Admin Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <h1 class="text-2xl font-bold text-gray-900">Create New Gallery</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-gray-700 text-sm">Welcome, {{ auth()->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                    <a href="{{ route('admin.gallery.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Galleries
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

            <form id="galleryForm" class="p-6" novalidate>
                <div class="grid grid-cols-1 gap-6">

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2 text-gray-400"></i>Gallery Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter gallery title" required>
                    </div>

                    <!-- Event Name -->
                    <div>
                        <label for="event_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2 text-gray-400"></i>Event Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="event_name" id="event_name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="e.g. Lagos Rally 2027" required>
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-day mr-2 text-gray-400"></i>Event Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="event_date" id="event_date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <!-- Gallery Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-images mr-2 text-gray-400"></i>Gallery Images
                            <span id="imageCounter" class="ml-2 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full hidden">0 selected</span>
                        </label>

                        <!-- Drop Zone -->
                        <div id="dropZone"
                             class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-md transition-colors duration-200 cursor-pointer hover:border-blue-400 hover:bg-blue-50">
                            <div class="space-y-2 text-center pointer-events-none">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-300"></i>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload"
                                           class="relative cursor-pointer pointer-events-auto bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500">
                                        <span>Choose files</span>
                                        <input id="file-upload" name="file-upload" type="file"
                                               class="sr-only" multiple accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag &amp; drop here</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF — up to 5 MB each</p>
                            </div>
                        </div>

                        <!-- Preview Grid -->
                        <div id="imagePreviewContainer"
                             class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <!-- previews injected by JS -->
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Describe this gallery or event…"></textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-gray-400"></i>Status
                        </label>
                        <div class="flex items-center">
                            <input type="checkbox" name="published" id="published"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="published" class="ml-2 text-sm text-gray-700">
                                Publish this gallery (visible on the public website)
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.gallery.index') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </a>
                        <button type="submit" id="createGalleryBtn"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-save mr-1"></i>Create Gallery
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Toast container -->
    <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none"></div>

    <script>
        // Auth guard
        if (!{{ auth()->check() ? 'true' : 'false' }}) {
            window.location.href = '{{ route('admin.login') }}';
        }

        const MAX_FILE_SIZE_MB = 5;
        const previewContainer = document.getElementById('imagePreviewContainer');
        const fileUpload       = document.getElementById('file-upload');
        const dropZone         = document.getElementById('dropZone');
        const counter          = document.getElementById('imageCounter');

        // ── Image count helper ───────────────────────────────────────────
        function updateCounter() {
            const count = previewContainer.querySelectorAll('.preview-item').length;
            if (count > 0) {
                counter.textContent = `${count} image${count !== 1 ? 's' : ''} selected`;
                counter.classList.remove('hidden');
            } else {
                counter.classList.add('hidden');
            }
        }

        // ── Process selected / dropped files ────────────────────────────
        function processFiles(files) {
            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                if (file.size > MAX_FILE_SIZE_MB * 1024 * 1024) {
                    showToast(`"${file.name}" exceeds ${MAX_FILE_SIZE_MB} MB and was skipped.`, 'error');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'preview-item relative group aspect-square';
                    wrapper.innerHTML = `
                        <img src="${e.target.result}" alt="Preview"
                             class="w-full h-full object-cover rounded-md border border-gray-200">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100
                                    transition-opacity flex items-center justify-center rounded-md">
                            <button type="button" onclick="removeImage(this)"
                                    class="text-white bg-red-600 hover:bg-red-700 rounded-full w-8 h-8 flex items-center justify-center shadow">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </div>
                        <input type="hidden" name="image_data[]" value="${e.target.result}">
                        <input type="hidden" name="image_name[]" value="${file.name}">`;
                    previewContainer.appendChild(wrapper);
                    updateCounter();
                };
                reader.readAsDataURL(file);
            });
        }

        // ── File input change ────────────────────────────────────────────
        fileUpload.addEventListener('change', function () {
            processFiles(this.files);
            this.value = ''; // reset so same file can be re-added after remove
        });

        // ── Drag & Drop ──────────────────────────────────────────────────
        dropZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('dragenter', function (e) {
            e.preventDefault();
            this.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', function () {
            this.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
            const files = e.dataTransfer.files;
            if (files && files.length > 0) processFiles(files);
        });

        // ── Remove preview ───────────────────────────────────────────────
        function removeImage(btn) {
            btn.closest('.preview-item').remove();
            updateCounter();
        }

        // ── Form submission ──────────────────────────────────────────────
        document.getElementById('galleryForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const title      = document.getElementById('title').value.trim();
            const event_name = document.getElementById('event_name').value.trim();
            const event_date = document.getElementById('event_date').value;

            if (!title || !event_name || !event_date) {
                showToast('Please fill in all required fields.', 'error');
                return;
            }

            const imageDataInputs = previewContainer.querySelectorAll('input[name="image_data[]"]');
            const images = Array.from(imageDataInputs).map(i => i.value);

            const formData = {
                title,
                event_name,
                event_date,
                description: document.getElementById('description').value,
                images,
                published: document.getElementById('published').checked,
            };

            const btn = document.getElementById('createGalleryBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating…';

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/api/event-galleries', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(formData),
                });

                const result = await response.json();

                if (result.success) {
                    showToast('Gallery created successfully! Redirecting…', 'success');
                    setTimeout(() => { window.location.href = '{{ route("admin.gallery.index") }}'; }, 1500);
                } else {
                    const msg = result.message
                        || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Failed to create gallery.');
                    showToast(msg, 'error');
                }
            } catch (err) {
                console.error('Submit error:', err);
                showToast('A network error occurred. Please try again.', 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-save mr-1"></i>Create Gallery';
            }
        });

        // ── Toast notification ───────────────────────────────────────────
        function showToast(message, type) {
            const toast = document.createElement('div');
            const colorClass = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            toast.className = `pointer-events-auto flex items-center gap-2 px-4 py-3 rounded-md shadow-lg text-white text-sm ${colorClass}`;
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i><span>${message}</span>`;
            document.getElementById('toastContainer').appendChild(toast);
            setTimeout(() => {
                toast.style.transition = 'opacity 0.4s';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 5000);
        }
    </script>
</body>
</html>
