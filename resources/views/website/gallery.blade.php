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
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition duration-300 active">
                    <i class="fas fa-images mr-2"></i>All Photos
                </button>
                @php
                    $uniqueEvents = $eventGalleries->pluck('event_name')->unique()->filter();
                @endphp
                @foreach($uniqueEvents as $eventName)
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                        <i class="fas fa-calendar mr-2"></i>{{ $eventName }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($eventGalleries as $gallery)
                @if(!empty($gallery->images) && is_array($gallery->images))
                    @foreach($gallery->images as $image)
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="aspect-square">
                                <img src="{{ asset($image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white text-center">
                                    <i class="fas fa-search-plus text-3xl mb-2"></i>
                                    <p class="font-medium">View Photo</p>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                <h3 class="text-white font-bold">{{ $gallery->title }}</h3>
                                <p class="text-gray-200 text-sm">{{ $gallery->event_date ? $gallery->event_date->format('M d, Y') : '' }} • {{ $gallery->event_name }}</p>
                            </div>
                        </div>
                    @endforeach
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
@endsection