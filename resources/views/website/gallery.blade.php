@extends('website.layout')

@section('title', 'Gallery - Transporters for Tinubu 2027')
@section('description', 'View photos and videos from our events, rallies, and community activities showcasing the Transporters for Tinubu 2027 movement in action.')
@section('keywords', 'gallery, photos, videos, events gallery, tinubu photos, nigeria transportation')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Photo Gallery</h1>
        <p class="text-xl max-w-3xl mx-auto">
            A visual journey through our movement's activities, events, and community engagement across Nigeria
        </p>
    </div>
</div>

<!-- Gallery Filter -->
<div class="bg-gradient-to-r from-gray-50 to-gray-100 py-8 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Filter by Event</h2>
            <p class="text-gray-600">Browse our photo collections by specific events and activities</p>
        </div>
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('gallery') }}" 
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 {{ !request()->has('event') || request()->event === 'all' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
                <i class="fas fa-images mr-2"></i>All Photos
            </a>
            @foreach($uniqueEvents as $eventName)
                <a href="{{ route('gallery', ['event' => $eventName]) }}" 
                   class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 {{ request()->event === $eventName ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
                    <i class="fas fa-calendar mr-2"></i>{{ $eventName }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Gallery Counter -->
            <div class="col-span-full">
                <div class="text-center py-4">
                    <p class="text-gray-600 text-lg">
                        <i class="fas fa-camera mr-2"></i>
                        Showing {{ $eventGalleries->sum(function($gallery) { return is_array($gallery->images) ? count($gallery->images) : (is_string($gallery->images) ? count(json_decode($gallery->images, true) ?: []) : 0); }) }} photos 
                        @if(request()->has('event') && request()->event !== 'all')
                            from <span class="font-semibold text-blue-600">{{ request()->event }}</span>
                        @else
                            from all events
                        @endif
                    </p>
                </div>
            </div>
            @forelse($eventGalleries as $gallery)
                @if(!empty($gallery->images) && is_array($gallery->images))
                    @foreach($gallery->images as $image)
                        @php
                            // Handle different image path formats and check if file exists
                            $imagePath = $image;
                            $fullPath = '';
                            
                            if(Str::startsWith($image, 'http') || Str::startsWith($image, 'https')) {
                                $imageUrl = $image;
                                $isValid = true; // Assume external URLs are valid
                            } elseif(Str::startsWith($image, 'data:')) {
                                $imageUrl = $image;
                                $isValid = true; // Data URLs are valid
                            } else {
                                // Clean the path and check if file exists
                                $cleanPath = ltrim(str_replace(['\\', '/'], '/', $image), '/');
                                $fullPath = public_path($cleanPath);
                                    
                                    // Make sure the path starts with 'images/' for security
                                    if(strpos($cleanPath, 'images/') === 0) {
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    } else {
                                        // For backward compatibility, prepend 'images/'
                                        $cleanPath = 'images/' . $cleanPath;
                                        $fullPath = public_path($cleanPath);
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    }
                                }
                        @endphp
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-white" 
                             onclick="openLightbox('{{ $imageUrl }}', '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->description ?? '') }}', '{{ $gallery->event_date ? $gallery->event_date->format('M d, Y') : '' }}', '{{ addslashes($gallery->event_name) }}')">
                            <div class="aspect-square overflow-hidden">
                                
                                @if($isValid)
                                    <img src="{{ $imageUrl }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/hero-transport.jpg') }}'; this.alt='Image not available';">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-gray-500 text-sm">Image not available</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="text-white text-center">
                                    <i class="fas fa-expand-arrows-alt text-3xl mb-2"></i>
                                    <p class="font-medium text-sm">View Full Size</p>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                <h3 class="text-white font-bold text-lg">{{ $gallery->title }}</h3>
                                <p class="text-gray-200 text-sm mt-1">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $gallery->event_date ? $gallery->event_date->format('M d, Y') : '' }}
                                    @if($gallery->event_name)
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $gallery->event_name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                @elseif(!empty($gallery->images) && is_string($gallery->images))
                    @php
                        $images = json_decode($gallery->images, true);
                    @endphp
                    @if(is_array($images))
                        @foreach($images as $image)
                            @php
                                // Handle different image path formats and check if file exists
                                $imagePath = $image;
                                $fullPath = '';
                                
                                if(Str::startsWith($image, 'http') || Str::startsWith($image, 'https')) {
                                    $imageUrl = $image;
                                    $isValid = true; // Assume external URLs are valid
                                } elseif(Str::startsWith($image, 'data:')) {
                                    $imageUrl = $image;
                                    $isValid = true; // Data URLs are valid
                                } else {
                                    // Clean the path and check if file exists
                                    $cleanPath = ltrim(str_replace(['\\', '/'], '/', $image), '/');
                                    $fullPath = public_path($cleanPath);
                                    
                                    // Make sure the path starts with 'images/' for security
                                    if(strpos($cleanPath, 'images/') === 0) {
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    } else {
                                        // For backward compatibility, prepend 'images/'
                                        $cleanPath = 'images/' . $cleanPath;
                                        $fullPath = public_path($cleanPath);
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    }
                                }
                            @endphp
                            <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-white" 
                                 onclick="openLightbox('{{ $imageUrl }}', '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->description ?? '') }}', '{{ $gallery->event_date ? $gallery->event_date->format('M d, Y') : '' }}', '{{ addslashes($gallery->event_name) }}')">
                                <div class="aspect-square overflow-hidden">
                                    
                                    @if($isValid)
                                        <img src="{{ $imageUrl }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/hero-transport.jpg') }}'; this.alt='Image not available';">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                                <p class="text-gray-500 text-sm">Image not available</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <div class="text-white text-center">
                                        <i class="fas fa-expand-arrows-alt text-3xl mb-2"></i>
                                        <p class="font-medium text-sm">View Full Size</p>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                    <h3 class="text-white font-bold text-lg">{{ $gallery->title }}</h3>
                                    <p class="text-gray-200 text-sm mt-1">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $gallery->event_date ? $gallery->event_date->format('M d, Y') : '' }}
                                        @if($gallery->event_name)
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ $gallery->event_name }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-500">No gallery items found</h3>
                    <p class="text-gray-400 mt-2">Check back later for new photos and events</p>
                </div>
            @endforelse
        </div>
        
        @if($eventGalleries->count() > 0)
        <!-- Load More -->
        <div class="text-center">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                <i class="fas fa-sync-alt mr-2"></i>Load More Photos
            </button>
        </div>
        @endif
    </div>
</div>

<!-- Video Gallery Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Video Gallery</h2>
            <p class="text-xl text-gray-600">Watch our events and activities in motion</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Video 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="aspect-video bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div class="relative z-10 text-center text-white">
                        <i class="fas fa-play-circle text-6xl mb-4"></i>
                        <p class="font-bold text-lg">Play Video</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tinubu 2027 Official Launch</h3>
                    <p class="text-gray-700 mb-4">Official launch ceremony with key speakers and community participation</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-2"></i>
                        <span>15:30 minutes</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar mr-2"></i>
                        <span>March 15, 2026</span>
                    </div>
                </div>
            </div>
            
            <!-- Video 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="aspect-video bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div class="relative z-10 text-center text-white">
                        <i class="fas fa-play-circle text-6xl mb-4"></i>
                        <p class="font-bold text-lg">Play Video</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Community Impact Stories</h3>
                    <p class="text-gray-700 mb-4">Hear from community members about how our movement has made a difference</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-2"></i>
                        <span>12:45 minutes</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar mr-2"></i>
                        <span>March 10, 2026</span>
                    </div>
                </div>
            </div>
            
            <!-- Video 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="aspect-video bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div class="relative z-10 text-center text-white">
                        <i class="fas fa-play-circle text-6xl mb-4"></i>
                        <p class="font-bold text-lg">Play Video</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Transportation Network Overview</h3>
                    <p class="text-gray-700 mb-4">Learn about our comprehensive transportation network across Nigeria</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-2"></i>
                        <span>18:20 minutes</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar mr-2"></i>
                        <span>March 5, 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="py-16 bg-gradient-to-r from-purple-600 to-pink-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Our Impact in Photos</h2>
            <p class="text-xl text-purple-100">Thousands of moments captured across Nigeria</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">500+</div>
                <div class="text-purple-100">Events Documented</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">2,500+</div>
                <div class="text-purple-100">Photos Taken</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">50+</div>
                <div class="text-purple-100">Video Recordings</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">36</div>
                <div class="text-purple-100">States Covered</div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
    <div class="relative max-w-6xl w-full max-h-full flex flex-col">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-4 right-4 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 transition-all duration-200">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        <!-- Navigation Buttons -->
        <button id="prevBtn" onclick="navigateLightbox(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-3 transition-all duration-200">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        
        <button id="nextBtn" onclick="navigateLightbox(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-3 transition-all duration-200">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
        
        <!-- Image Container -->
        <div class="flex-1 flex items-center justify-center relative">
            <img id="lightboxImage" src="" alt="" class="max-h-full max-w-full object-contain">
        </div>
        
        <!-- Image Info -->
        <div class="bg-black bg-opacity-80 text-white p-6 mt-4 rounded-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 id="lightboxTitle" class="text-xl font-bold mb-2"></h3>
                    <p id="lightboxDescription" class="text-gray-300 mb-3"></p>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-400">
                        <span id="lightboxDate" class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                        </span>
                        <span id="lightboxEvent" class="flex items-center">
                            <i class="fas fa-tag mr-2"></i>
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="downloadImage()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-download mr-2"></i>Download
                    </button>
                    <button onclick="shareImage()" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-share-alt mr-2"></i>Share
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentImageIndex = 0;
    let galleryImages = [];
    
    function openLightbox(imageSrc, title, description, date, event) {
        // Collect all gallery images
        galleryImages = [];
        document.querySelectorAll('.group.cursor-pointer').forEach((element, index) => {
            const img = element.querySelector('img');
            if (img && img.src) {
                galleryImages.push({
                    src: img.src,
                    title: element.getAttribute('data-title') || title,
                    description: element.getAttribute('data-description') || description,
                    date: element.getAttribute('data-date') || date,
                    event: element.getAttribute('data-event') || event
                });
                
                // Mark the clicked image
                if (img.src === imageSrc) {
                    currentImageIndex = index;
                }
            }
        });
        
        // Set current image
        document.getElementById('lightboxImage').src = imageSrc;
        document.getElementById('lightboxTitle').textContent = title;
        document.getElementById('lightboxDescription').textContent = description;
        document.getElementById('lightboxDate').innerHTML = `<i class="fas fa-calendar mr-2"></i>${date}`;
        document.getElementById('lightboxEvent').innerHTML = `<i class="fas fa-tag mr-2"></i>${event}`;
        
        // Show/hide navigation buttons
        document.getElementById('prevBtn').classList.toggle('hidden', galleryImages.length <= 1);
        document.getElementById('nextBtn').classList.toggle('hidden', galleryImages.length <= 1);
        
        // Show modal
        document.getElementById('lightboxModal').classList.remove('hidden');
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        document.getElementById('lightboxModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    function navigateLightbox(direction) {
        if (galleryImages.length <= 1) return;
        
        currentImageIndex += direction;
        
        // Handle boundaries
        if (currentImageIndex < 0) {
            currentImageIndex = galleryImages.length - 1;
        } else if (currentImageIndex >= galleryImages.length) {
            currentImageIndex = 0;
        }
        
        const currentImage = galleryImages[currentImageIndex];
        document.getElementById('lightboxImage').src = currentImage.src;
        document.getElementById('lightboxTitle').textContent = currentImage.title;
        document.getElementById('lightboxDescription').textContent = currentImage.description;
        document.getElementById('lightboxDate').innerHTML = `<i class="fas fa-calendar mr-2"></i>${currentImage.date}`;
        document.getElementById('lightboxEvent').innerHTML = `<i class="fas fa-tag mr-2"></i>${currentImage.event}`;
    }
    
    function downloadImage() {
        const imgSrc = document.getElementById('lightboxImage').src;
        const link = document.createElement('a');
        link.href = imgSrc;
        link.download = 'gallery-image.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    
    function shareImage() {
        const imgSrc = document.getElementById('lightboxImage').src;
        if (navigator.share) {
            navigator.share({
                title: document.getElementById('lightboxTitle').textContent,
                text: document.getElementById('lightboxDescription').textContent,
                url: imgSrc
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(imgSrc).then(() => {
                alert('Image URL copied to clipboard!');
            });
        }
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('lightboxModal').classList.contains('hidden')) {
            closeLightbox();
        }
        
        // Navigation with arrow keys
        if (!document.getElementById('lightboxModal').classList.contains('hidden')) {
            if (e.key === 'ArrowLeft') {
                navigateLightbox(-1);
            } else if (e.key === 'ArrowRight') {
                navigateLightbox(1);
            }
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('lightboxModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>
@endsection