@extends('website.layout')

@section('title', 'Transporters for Tinubu 2027 - Campaign for Good Governance')
@section('description', 'Transporters for Tinubu 2027 - A strategic initiative to mobilize Nigeria\'s transportation sector for continued good governance and development.')
@section('keywords', 'Transporters for Tinubu 2027, Nigeria, Transportation, Good Governance, Campaign, 2027 Elections')

@section('content')
<!-- Sticky Latest Posts Sidebar -->
<div id="sticky-posts-sidebar" class="fixed right-4 top-1/2 transform -translate-y-1/2 z-50 w-80 hidden lg:block">
    <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-200 max-h-[70vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4 bg-[#008e39] p-4 rounded-lg -m-2">
            <div>
                <h3 class="text-lg font-bold text-white">Trending Now</h3>
                <p class="text-sm text-white/90">Latest updates from our movement</p>
            </div>
            <button id="close-sticky-posts" class="text-white/80 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-4">
            @if(isset($sidebarPosts) && $sidebarPosts->count() > 0)
                @foreach($sidebarPosts as $post)
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 truncate">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-green-600 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->excerpt ?? $post->content), 80) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-newspaper text-gray-300 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-500">No recent posts</p>
                </div>
            @endif
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('blog') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                View All Posts
                <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</div>

<!-- Add CSS for sticky sidebar -->
<style>
    #sticky-posts-sidebar {
        max-height: calc(100vh - 2rem);
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 1024px) {
        #sticky-posts-sidebar {
            height: calc(100vh - 4rem);
        }
    }
</style>

<!-- Add JavaScript for sticky sidebar functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stickySidebar = document.getElementById('sticky-posts-sidebar');
    const closeButton = document.getElementById('close-sticky-posts');
    
    // Always show the sidebar on homepage
    stickySidebar.style.display = 'block';
    
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            stickySidebar.style.display = 'none';
            // Don't store in localStorage - sidebar will reappear on next visit
        });
    }
});
</script>

<!-- Hero Section with Image -->
<section class="relative pt-20 pb-0 px-0 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img 
            src="/images/hero-transport.jpg" 
            alt="Transportation Network" 
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/60 to-black/50"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 pr-0 lg:pr-80">
        <div class="text-center">
            <div class="mb-6 inline-block">
                <div class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 inline-flex items-center">
                    <i class="fas fa-star w-4 h-4 mr-2"></i>
                    Supporting Progressive Leadership
                </div>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                Transporters for
                <span class="block text-green-400">Tinubu 2027</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-100 mb-8 max-w-3xl mx-auto leading-relaxed drop-shadow-md">
                United in supporting President Bola Ahmed Tinubu's vision for a transformed 
                transportation sector that drives Nigeria's economic growth and development.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="{{ url('/about') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 text-lg shadow-lg rounded-lg font-medium transition-colors duration-300 inline-flex items-center">
                    Learn More <i class="fas fa-arrow-right ml-2 h-5 w-5"></i>
                </a>
                <a href="{{ url('/contact') }}" class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 text-lg shadow-lg rounded-lg font-semibold transition-colors duration-300">
                    Join Us Today
                </a>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-20">
            <div class="text-center p-6 bg-white/95 backdrop-blur-sm rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">
                    50,000<span class="text-lg">+</span>
                </div>
                <div class="text-sm text-gray-700 font-medium">Transport Workers</div>
            </div>
            
            <div class="text-center p-6 bg-white/95 backdrop-blur-sm rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">
                    25<span class="text-lg">+</span>
                </div>
                <div class="text-sm text-gray-700 font-medium">States Covered</div>
            </div>
            
            <div class="text-center p-6 bg-white/95 backdrop-blur-sm rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">
                    774<span class="text-lg">+</span>
                </div>
                <div class="text-sm text-gray-700 font-medium">Support Centers</div>
            </div>
            
            <div class="text-center p-6 bg-white/95 backdrop-blur-sm rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-3xl sm:text-4xl font-bold text-green-600 mb-2">
                    2027
                </div>
                <div class="text-sm text-gray-700 font-medium">Years of Excellence</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto pr-0 lg:pr-80">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Why We Stand Together
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Our collective strength lies in our shared vision for Nigeria's transportation future
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg border border-green-100">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-users h-8 w-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">United Voice</h3>
                    <p class="text-gray-600">Bringing together transport workers from across Nigeria for a common cause.</p>
                </div>
            </div>
            
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg border border-green-100">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-bullseye h-8 w-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Clear Vision</h3>
                    <p class="text-gray-600">Supporting progressive leadership that understands transportation needs.</p>
                </div>
            </div>
            
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg border border-green-100">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-handshake h-8 w-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Strong Partnerships</h3>
                    <p class="text-gray-600">Building alliances with stakeholders and government agencies.</p>
                </div>
            </div>
            
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg border border-green-100">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-chart-line h-8 w-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Economic Growth</h3>
                    <p class="text-gray-600">Driving economic development through improved transportation systems.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transport Sectors -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-7xl mx-auto pr-0 lg:pr-80">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Across All Transport Sectors
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Representing every facet of Nigeria's diverse transportation industry
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1 rounded-lg bg-white">
                <div class="flex justify-center text-green-600 mb-4">
                    <i class="fas fa-truck h-12 w-12"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Road Transport</h3>
                <p class="text-2xl font-bold text-green-600">25,000+</p>
                <p class="text-sm text-gray-600">Workers</p>
            </div>
            
            <div class="p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1 rounded-lg bg-white">
                <div class="flex justify-center text-green-600 mb-4">
                    <i class="fas fa-bus h-12 w-12"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Public Transit</h3>
                <p class="text-2xl font-bold text-green-600">15,000+</p>
                <p class="text-sm text-gray-600">Workers</p>
            </div>
            
            <div class="p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1 rounded-lg bg-white">
                <div class="flex justify-center text-green-600 mb-4">
                    <i class="fas fa-plane h-12 w-12"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Aviation Support</h3>
                <p class="text-2xl font-bold text-green-600">5,000+</p>
                <p class="text-sm text-gray-600">Workers</p>
            </div>
            
            <div class="p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1 rounded-lg bg-white">
                <div class="flex justify-center text-green-600 mb-4">
                    <i class="fas fa-map-marker-alt h-12 w-12"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Logistics</h3>
                <p class="text-2xl font-bold text-green-600">10,000+</p>
                <p class="text-sm text-gray-600">Workers</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-green-600 to-green-700">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Be Part of the Movement
        </h2>
        <p class="text-xl text-green-50 mb-8 leading-relaxed">
            Join thousands of transport workers across Nigeria in supporting a vision 
            that promises progress, development, and prosperity for all.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/contact') }}" class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 text-lg rounded-lg font-medium transition-colors duration-300">
                Get Involved
            </a>
            <a href="{{ url('/timeline') }}" class="border border-white text-white hover:bg-white hover:text-green-600 px-8 py-4 text-lg rounded-lg font-medium transition-colors duration-300">
                View Our Journey
            </a>
        </div>
    </div>
</section>

<!-- Latest Blog Posts -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-7xl mx-auto pr-0 lg:pr-80">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Latest News & Updates
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Stay informed with the latest developments, announcements, and insights from our movement
            </p>
        </div>
        
        @if(isset($latestPosts) && $latestPosts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestPosts as $post)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        @if($post->featured_image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="far fa-calendar mr-2"></i>
                                {{ $post->created_at->format('M d, Y') }}
                                @if($post->author)
                                    <span class="mx-2">•</span>
                                    <i class="far fa-user mr-2"></i>
                                    {{ $post->author->name }}
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                                Read More
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('blog') }}" class="inline-flex items-center px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                    View All Posts
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Posts Yet</h3>
                <p class="text-gray-600">Check back soon for the latest updates from our movement.</p>
            </div>
        @endif
    </div>
</section>

<!-- Testimonials -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto pr-0 lg:pr-80">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Voices from the Community
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Hear what transport workers and leaders are saying about our movement
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg">
                <div class="flex mb-4">
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                </div>
                <p class="text-gray-700 mb-6 italic">"This initiative represents the future of transportation in Nigeria. We are proud to be part of this movement."</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-users h-6 w-6 text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Ahmed Ibrahim</p>
                        <p class="text-sm text-gray-600">Transport Union Leader</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg">
                <div class="flex mb-4">
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                </div>
                <p class="text-gray-700 mb-6 italic">"The vision and leadership shown here gives us hope for better infrastructure and policies."</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-users h-6 w-6 text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Sarah Okonkwo</p>
                        <p class="text-sm text-gray-600">Fleet Manager</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 hover:shadow-lg transition-shadow duration-300 rounded-lg">
                <div class="flex mb-4">
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                    <i class="fas fa-star h-5 w-5 text-yellow-400 fill-current"></i>
                </div>
                <p class="text-gray-700 mb-6 italic">"Finally, a movement that truly understands the challenges we face as transport workers."</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-users h-6 w-6 text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Muhammad Bello</p>
                        <p class="text-sm text-gray-600">Logistics Coordinator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection