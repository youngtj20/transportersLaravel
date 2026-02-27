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
        <!-- Gallery Counter -->
        <div class="text-center py-4 mb-8">
            <p class="text-gray-600 text-lg">
                <i class="fas fa-camera mr-2"></i>
                Showing {{ $eventGalleries->count() }} events with {{ $eventGalleries->sum(function($gallery) { return is_array($gallery->images) ? count($gallery->images) : (is_string($gallery->images) ? count(json_decode($gallery->images, true) ?: []) : 0); }) }} total photos
                @if(request()->has('event') && request()->event !== 'all')
                    from <span class="font-semibold text-blue-600">{{ request()->event }}</span>
                @else
                    from all events
                @endif
            </p>
        </div>
        
        <!-- Grouped Event Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-12">
            @forelse($eventGalleries as $gallery)
                @php
                    // Handle different image path formats and check if file exists
                    $firstImageUrl = '';
                    $firstValidImage = null;
                    $imageCount = 0;
                    
                    if(!empty($gallery->images) && is_array($gallery->images)) {
                        $imageCount = count($gallery->images);
                        foreach($gallery->images as $image) {
                            $imagePath = $image;
                            $fullPath = '';
                            
                            if(Str::startsWith($image, 'http') || Str::startsWith($image, 'https')) {
                                $imageUrl = $image;
                                $isValid = true;
                            } elseif(Str::startsWith($image, 'data:')) {
                                $imageUrl = $image;
                                $isValid = true;
                            } else {
                                $cleanPath = ltrim(str_replace(['\\', '/'], '/', $image), '/');
                                $fullPath = public_path($cleanPath);
                                
                                if(strpos($cleanPath, 'images/') === 0) {
                                    $imageUrl = asset($cleanPath);
                                    $isValid = file_exists($fullPath);
                                } else {
                                    $cleanPath = 'images/' . $cleanPath;
                                    $fullPath = public_path($cleanPath);
                                    $imageUrl = asset($cleanPath);
                                    $isValid = file_exists($fullPath);
                                }
                            }
                            
                            if($isValid) {
                                $firstImageUrl = $imageUrl;
                                $firstValidImage = $image;
                                break;
                            }
                        }
                    } elseif(!empty($gallery->images) && is_string($gallery->images)) {
                        $decodedImages = json_decode($gallery->images, true);
                        if(is_array($decodedImages)) {
                            $imageCount = count($decodedImages);
                            foreach($decodedImages as $image) {
                                $imagePath = $image;
                                $fullPath = '';
                                
                                if(Str::startsWith($image, 'http') || Str::startsWith($image, 'https')) {
                                    $imageUrl = $image;
                                    $isValid = true;
                                } elseif(Str::startsWith($image, 'data:')) {
                                    $imageUrl = $image;
                                    $isValid = true;
                                } else {
                                    $cleanPath = ltrim(str_replace(['\\', '/'], '/', $image), '/');
                                    $fullPath = public_path($cleanPath);
                                    
                                    if(strpos($cleanPath, 'images/') === 0) {
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    } else {
                                        $cleanPath = 'images/' . $cleanPath;
                                        $fullPath = public_path($cleanPath);
                                        $imageUrl = asset($cleanPath);
                                        $isValid = file_exists($fullPath);
                                    }
                                }
                                
                                if($isValid) {
                                    $firstImageUrl = $imageUrl;
                                    $firstValidImage = $image;
                                    break;
                                }
                            }
                        }
                    }
                    
                    // If no valid images found, use fallback
                    if(empty($firstImageUrl)) {
                        $firstImageUrl = asset('images/hero-transport.jpg');
                    }
                @endphp
                
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-white border border-gray-200" 
                     onclick="openEventLightbox({{ json_encode($gallery->toArray()) }})">
                    <!-- Event Image Preview -->
                    <div class="aspect-square overflow-hidden relative">
                        <img src="{{ $firstImageUrl }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/hero-transport.jpg') }}'; this.alt='Image not available';">
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Event Badge -->
                        <div class="absolute top-2 left-2 bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-medium shadow">
                            <i class="fas fa-image mr-1"></i>{{ $imageCount }}
                        </div>
                        
                        <!-- Expand Icon -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white bg-opacity-30 backdrop-blur-sm rounded-full p-3 transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <i class="fas fa-expand-arrows-alt text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Details -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $gallery->title }}</h3>
                        
                        <div class="space-y-1 text-xs text-gray-600 mb-2">
                            @if($gallery->event_name)
                                <div class="flex items-center truncate">
                                    <i class="fas fa-calendar text-blue-500 mr-1 text-xs"></i>
                                    <span class="truncate">{{ $gallery->event_name }}</span>
                                </div>
                            @endif
                            
                            @if($gallery->event_date)
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-green-500 mr-1 text-xs"></i>
                                    <span>{{ $gallery->event_date->format('M d, Y') }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center">
                                <i class="fas fa-image text-purple-500 mr-1 text-xs"></i>
                                <span>{{ $imageCount }} photos</span>
                            </div>
                        </div>
                        
                        @if($gallery->description)
                            <p class="text-gray-500 text-xs line-clamp-2">{{ $gallery->description }}</p>
                        @endif
                        
                        <!-- Social Sharing for Gallery -->
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <x-social-share 
                                :url="url()->current()" 
                                :title="$gallery->title" 
                                :description="$gallery->description ?? 'Check out these amazing photos from our event!'" 
                                :image="$firstImageUrl" 
                                type="gallery" />
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-500">No gallery items found</h3>
                    <p class="text-gray-400 mt-2">Check back later for new photos and events</p>
                </div>
            @endforelse
        </div>
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

<!-- Event Lightbox Modal -->
<div id="eventLightboxModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95 flex items-center justify-center p-4">
    <div class="relative max-w-7xl w-full max-h-full flex flex-col">
        <!-- Close Button -->
        <button onclick="closeEventLightbox()" class="absolute top-4 right-4 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 transition-all duration-200 z-20">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        <!-- Navigation Buttons (will be enabled if there are multiple events to navigate) -->
        <button id="prevEventBtn" onclick="navigateEvent(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-3 transition-all duration-200 hidden">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button id="nextEventBtn" onclick="navigateEvent(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 text-white bg-black bg-opacity-50 hover:bg-opacity-75 rounded-full p-3 transition-all duration-200 hidden">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
        
        <!-- Event Header -->
        <div class="bg-black bg-opacity-80 text-white p-6 rounded-t-lg z-10 sticky top-0 backdrop-blur-sm">
            <h2 id="eventLightboxTitle" class="text-2xl font-bold mb-2"></h2>
            <div class="flex flex-wrap gap-4 text-sm text-gray-300">
                <span id="eventLightboxDate" class="flex items-center"></span>
                <span id="eventLightboxName" class="flex items-center"></span>
                <span id="eventLightboxCount" class="flex items-center"></span>
            </div>
        </div>
        
        <!-- Event Images Container -->
        <div id="eventLightboxImagesContainer" class="flex-1 overflow-y-auto p-4 bg-black bg-opacity-20 backdrop-blur-sm rounded-b-lg">
            <div id="eventLightboxImagesGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"></div>
        </div>
    </div>
</div>

<script>
    let currentEvent = {};
    let allEvents = [];
    let currentEventIndex = 0;
    
    function openEventLightbox(eventData) {
        // Set current event data
        currentEvent = eventData;
        document.getElementById('eventLightboxTitle').textContent = eventData.title || 'Untitled Event';
        document.getElementById('eventLightboxDate').innerHTML = `<i class="fas fa-calendar mr-2"></i>${eventData.event_date ? new Date(eventData.event_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : 'No date'}`;
        document.getElementById('eventLightboxName').innerHTML = `<i class="fas fa-tag mr-2"></i>${eventData.event_name || 'No event name'}`;
        document.getElementById('eventLightboxCount').innerHTML = `<i class="fas fa-image mr-2"></i>${Array.isArray(eventData.images) ? eventData.images.length : (typeof eventData.images === 'string' ? JSON.parse(eventData.images || '[]').length : 0)} photos`;
        
        // Process and display images
        let images = [];
        if (Array.isArray(eventData.images)) {
            images = eventData.images;
        } else if (typeof eventData.images === 'string') {
            images = JSON.parse(eventData.images || '[]');
        }
        
        const imagesGrid = document.getElementById('eventLightboxImagesGrid');
        imagesGrid.innerHTML = '';
        
        images.forEach((image, index) => {
            // Handle different image formats
            let imageUrl = image;
            let isValid = true;
            
            if (image.startsWith('http') || image.startsWith('https')) {
                imageUrl = image;
                isValid = true;
            } else if (image.startsWith('data:')) {
                imageUrl = image;
                isValid = true;
            } else {
                // Handle local paths
                let cleanPath = image.replace(/^[/\\]+|[/\\]+$/g, '');
                if (!cleanPath.startsWith('images/')) {
                    cleanPath = 'images/' + cleanPath;
                }
                imageUrl = `{{ asset('') }}${cleanPath}`;
            }
            
            const imageDiv = document.createElement('div');
            imageDiv.className = 'group relative aspect-square overflow-hidden rounded-lg shadow-lg cursor-pointer hover:shadow-xl transition-all duration-300';
            imageDiv.onclick = (e) => {
                // Only trigger if clicking directly on the image, not the overlay
                if (e.target.tagName === 'IMG' || e.target.classList.contains('fa-plus')) {
                    openIndividualImageLightbox(imageUrl, eventData.title, index, images);
                }
            };
            
            imageDiv.innerHTML = `
                <img src="${imageUrl}" alt="${eventData.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/hero-transport.jpg') }}'; this.alt='Image not available';">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center cursor-pointer" onclick="event.stopPropagation(); openIndividualImageLightbox('${imageUrl.replace(/'/g, "\\'").replace(/"/g, '&quot;')}', '${eventData.title.replace(/'/g, "\\'")}', ${index}, JSON.parse('${JSON.stringify(images).replace(/'/g, "\\'")}'))">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white text-center transform scale-75 group-hover:scale-100">
                        <i class="fas fa-plus text-2xl"></i>
                    </div>
                </div>
            `;
            
            imagesGrid.appendChild(imageDiv);
        });
        
        // Show modal
        document.getElementById('eventLightboxModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function openIndividualImageLightbox(imageSrc, title, currentIndex, allImages) {
        // Close the event lightbox first
        closeEventLightbox();
        // Then open the individual image lightbox
        openLightbox(imageSrc, title, '', '', '', currentIndex, allImages);
    }
    
    // Update the openLightbox function to handle the event gallery images properly
    function openLightbox(imageSrc, title, description, date, event, startIndex = 0, allImages = []) {
        // If we have a list of all images from the event, use them
        if (allImages && allImages.length > 0) {
            galleryImages = allImages.map(img => {
                let imageUrl = img;
                if (img.startsWith('http') || img.startsWith('https')) {
                    imageUrl = img;
                } else if (img.startsWith('data:')) {
                    imageUrl = img;
                } else {
                    let cleanPath = img.replace(/^[/\\]+|[/\\]+$/g, '');
                    if (!cleanPath.startsWith('images/')) {
                        cleanPath = 'images/' + cleanPath;
                    }
                    imageUrl = `{{ asset('') }}${cleanPath}`;
                }
                return {
                    src: imageUrl,
                    title: title,
                    description: description,
                    date: date,
                    event: event
                };
            });
            currentImageIndex = startIndex;
        } else {
            // Fallback to collecting from page (for single image clicks)
            galleryImages = [{
                src: imageSrc,
                title: title,
                description: description,
                date: date,
                event: event
            }];
            currentImageIndex = 0;
        }
        
        // Set current image
        document.getElementById('lightboxImage').src = galleryImages[currentImageIndex].src;
        document.getElementById('lightboxTitle').textContent = galleryImages[currentImageIndex].title;
        document.getElementById('lightboxDescription').textContent = galleryImages[currentImageIndex].description;
        document.getElementById('lightboxDate').innerHTML = `<i class="fas fa-calendar mr-2"></i>${galleryImages[currentImageIndex].date}`;
        document.getElementById('lightboxEvent').innerHTML = `<i class="fas fa-tag mr-2"></i>${galleryImages[currentImageIndex].event}`;
        
        // Show/hide navigation buttons
        document.getElementById('prevBtn').classList.toggle('hidden', galleryImages.length <= 1);
        document.getElementById('nextBtn').classList.toggle('hidden', galleryImages.length <= 1);
        
        // Show modal
        document.getElementById('lightboxModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeEventLightbox() {
        document.getElementById('eventLightboxModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    function navigateEvent(direction) {
        // Navigation between events (if needed in future)
    }

    // Individual image lightbox for when viewing images within an event
    let currentImageIndex = 0;
    let galleryImages = [];
    
    function openLightbox(imageSrc, title, description, date, event, startIndex = 0, allImages = []) {
        // If we have a list of all images from the event, use them
        if (allImages && allImages.length > 0) {
            galleryImages = allImages.map(img => {
                let imageUrl = img;
                if (img.startsWith('http') || img.startsWith('https')) {
                    imageUrl = img;
                } else if (img.startsWith('data:')) {
                    imageUrl = img;
                } else {
                    let cleanPath = img.replace(/^[/\\]+|[/\\]+$/g, '');
                    if (!cleanPath.startsWith('images/')) {
                        cleanPath = 'images/' + cleanPath;
                    }
                    imageUrl = `{{ asset('') }}${cleanPath}`;
                }
                return {
                    src: imageUrl,
                    title: title,
                    description: description,
                    date: date,
                    event: event
                };
            });
            currentImageIndex = startIndex;
        } else {
            // Fallback to collecting from page (for single image clicks)
            galleryImages = [{
                src: imageSrc,
                title: title,
                description: description,
                date: date,
                event: event
            }];
            currentImageIndex = 0;
        }
        
        // Set current image
        document.getElementById('lightboxImage').src = galleryImages[currentImageIndex].src;
        document.getElementById('lightboxTitle').textContent = galleryImages[currentImageIndex].title;
        document.getElementById('lightboxDescription').textContent = galleryImages[currentImageIndex].description;
        document.getElementById('lightboxDate').innerHTML = `<i class="fas fa-calendar mr-2"></i>${galleryImages[currentImageIndex].date}`;
        document.getElementById('lightboxEvent').innerHTML = `<i class="fas fa-tag mr-2"></i>${galleryImages[currentImageIndex].event}`;
        
        // Show/hide navigation buttons
        document.getElementById('prevBtn').classList.toggle('hidden', galleryImages.length <= 1);
        document.getElementById('nextBtn').classList.toggle('hidden', galleryImages.length <= 1);
        
        // Show modal
        document.getElementById('lightboxModal').classList.remove('hidden');
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
    
    function shareCurrentImage() {
        const imgSrc = document.getElementById('lightboxImage').src;
        const title = document.getElementById('lightboxTitle').textContent;
        const description = document.getElementById('lightboxDescription').textContent;
        
        // Use the enhanced social sharing component
        const socialUrls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(imgSrc)}&t=${encodeURIComponent(title)}`,
            twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(imgSrc)}&text=${encodeURIComponent(title)}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(imgSrc)}`,
            whatsapp: `https://wa.me/?text=${encodeURIComponent(title + " " + imgSrc)}`,
            telegram: `https://t.me/share/url?url=${encodeURIComponent(imgSrc)}&text=${encodeURIComponent(title)}`,
            email: `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(description + " " + imgSrc)}`
        };
        
        // Show share options dialog
        showShareOptionsDialog(imgSrc, title, description, socialUrls);
    }
    
    function showShareOptionsDialog(imageSrc, title, description, urls) {
        const shareHTML = `
            <div id="imageShareModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Share Image</h3>
                        <button onclick="closeImageShareModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <a href="${urls.facebook}" target="_blank" class="flex flex-col items-center p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f text-xl mb-1"></i>
                            <span class="text-xs">Facebook</span>
                        </a>
                        <a href="${urls.twitter}" target="_blank" class="flex flex-col items-center p-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                            <i class="fab fa-twitter text-xl mb-1"></i>
                            <span class="text-xs">Twitter</span>
                        </a>
                        <a href="${urls.linkedin}" target="_blank" class="flex flex-col items-center p-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                            <i class="fab fa-linkedin-in text-xl mb-1"></i>
                            <span class="text-xs">LinkedIn</span>
                        </a>
                        <a href="${urls.whatsapp}" target="_blank" class="flex flex-col items-center p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp text-xl mb-1"></i>
                            <span class="text-xs">WhatsApp</span>
                        </a>
                        <a href="${urls.telegram}" target="_blank" class="flex flex-col items-center p-3 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">
                            <i class="fab fa-telegram text-xl mb-1"></i>
                            <span class="text-xs">Telegram</span>
                        </a>
                        <a href="${urls.email}" class="flex flex-col items-center p-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-envelope text-xl mb-1"></i>
                            <span class="text-xs">Email</span>
                        </a>
                    </div>
                    
                    <button onclick="copyToClipboard('${imageSrc}')" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                        <i class="fas fa-link mr-2"></i>Copy Image Link
                    </button>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', shareHTML);
        document.body.style.overflow = 'hidden';
    }
    
    function closeImageShareModal() {
        const modal = document.getElementById('imageShareModal');
        if (modal) {
            modal.remove();
            document.body.style.overflow = '';
        }
    }
    
    function shareImage() {
        // Fallback to the original function for compatibility
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
        if (e.key === 'Escape' && !document.getElementById('eventLightboxModal').classList.contains('hidden')) {
            closeEventLightbox();
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